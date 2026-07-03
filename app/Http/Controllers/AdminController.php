<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectGallery;
use App\Models\ProjectProgress;
use App\Models\ProjectProgressImage;
use App\Models\ProjectDocument;
use App\Models\ProjectMeeting;
use App\Models\ProjectComment;
use App\Models\ProjectApproval;
use App\Models\Article;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Notification;

class AdminController extends Controller
{
    // 1. Dashboard & General
    public function dashboard()
    {
        $totalProjects = Project::count();
        $totalClients = User::where('role', 'client')->count();
        $totalArticles = Article::count();
        $totalMessages = Message::count();
        
        $unreadMessages = Message::where('is_read', false)->latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();
        
        // Progress statistics
        $ongoingProjects = Project::where('status', 'ongoing')->count();
        $completedProjects = Project::where('status', 'completed')->count();
        $planningProjects = Project::where('status', 'planning')->count();

        return view('admin.dashboard', compact(
            'totalProjects', 'totalClients', 'totalArticles', 'totalMessages',
            'unreadMessages', 'recentProjects', 'ongoingProjects', 'completedProjects', 'planningProjects'
        ));
    }

    // 2. Client Management (CRUD)
    public function clients()
    {
        $clients = User::where('role', 'client')->withCount('projects')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function createClient()
    {
        return view('admin.clients.create');
    }

    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'client',
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Akun Klien berhasil dibuat.');
    }

    public function editClient($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function updateClient(Request $request, $id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $client->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Akun Klien berhasil diperbarui.');
    }

    public function deleteClient($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Akun Klien berhasil dihapus.');
    }

    // 3. Project Management (CRUD)
    public function projects()
    {
        $projects = Project::with('client')->orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function createProject()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.create', compact('clients'));
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'nullable|exists:users,id',
            'category' => 'required|string',
            'status' => 'required|in:planning,ongoing,completed',
            'location' => 'required|string',
            'year' => 'required|string',
            'project_value' => 'nullable|integer',
            'scope' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('projects', 'public');
            $validated['cover_image'] = $path;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $project = Project::create($validated);

        // Upload Gallery Images if provided
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('projects/galleries', 'public');
                ProjectGallery::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'file_type' => 'image',
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function showProject($id)
    {
        $project = Project::with(['client', 'galleries', 'progress.images', 'documents', 'meetings', 'comments.user', 'approvals'])->findOrFail($id);
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.show', compact('project', 'clients'));
    }

    public function updateProjectProgress(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $validated = $request->validate([
            'percentage' => 'required|integer|min:0|max:100',
            'date' => 'required|date',
            'description' => 'required|string',
            'progress_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $progress = ProjectProgress::create([
            'project_id' => $project->id,
            'date' => $validated['date'],
            'percentage' => $validated['percentage'],
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('progress_images')) {
            foreach ($request->file('progress_images') as $image) {
                $path = $image->store('progress', 'public');
                ProjectProgressImage::create([
                    'project_progress_id' => $progress->id,
                    'file_path' => $path,
                ]);
            }
        }

        // Notify client if linked
        if ($project->client_id) {
            Notification::create([
                'user_id' => $project->client_id,
                'title' => 'Kemajuan Proyek Diperbarui',
                'message' => "Progres proyek \"{$project->title}\" telah diperbarui menjadi {$validated['percentage']}%.",
                'url' => route('client.dashboard') . '?project_id=' . $project->id,
            ]);
        }

        return back()->with('progress_success', 'Kemajuan proyek berhasil diperbarui.');
    }

    public function uploadProjectDocument(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_file' => 'required|file|max:51200', // 50MB max
        ]);

        $file = $request->file('document_file');
        $originalName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension());
        
        $path = $file->store('documents', 'public');
        $sizeBytes = $file->getSize();
        
        // Format size
        if ($sizeBytes >= 1048576) {
            $formattedSize = number_format($sizeBytes / 1048576, 1) . ' MB';
        } else {
            $formattedSize = number_format($sizeBytes / 1024, 0) . ' KB';
        }

        ProjectDocument::create([
            'project_id' => $project->id,
            'title' => $validated['title'],
            'file_path' => $path,
            'file_type' => $ext,
            'file_size' => $formattedSize,
            'uploaded_by' => 'admin',
        ]);

        // Notify client
        if ($project->client_id) {
            Notification::create([
                'user_id' => $project->client_id,
                'title' => 'Dokumen Proyek Baru Diunggah',
                'message' => "Dokumen \"{$validated['title']}\" telah diunggah oleh admin untuk proyek Anda.",
                'url' => route('client.dashboard') . '?project_id=' . $project->id,
            ]);
        }

        return back()->with('document_success', 'Dokumen proyek berhasil diunggah.');
    }

    public function scheduleProjectMeeting(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $validated = $request->validate([
            'meeting_title' => 'required|string|max:255',
            'meeting_date' => 'required|date_format:Y-m-d\TH:i',
            'location_or_link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProjectMeeting::create([
            'project_id' => $project->id,
            'meeting_title' => $validated['meeting_title'],
            'meeting_date' => $validated['meeting_date'],
            'location_or_link' => $validated['location_or_link'],
            'description' => $validated['description'],
        ]);

        // Notify client
        if ($project->client_id) {
            $formattedDate = date('d M Y H:i', strtotime($validated['meeting_date']));
            Notification::create([
                'user_id' => $project->client_id,
                'title' => 'Jadwal Rapat Baru',
                'message' => "Rapat koordinasi baru \"{$validated['meeting_title']}\" telah dijadwalkan pada {$formattedDate}.",
                'url' => route('client.dashboard') . '?project_id=' . $project->id,
            ]);
        }

        return back()->with('meeting_success', 'Jadwal rapat berhasil ditambahkan.');
    }

    public function uploadProjectApproval(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'design_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:20480', // 20MB
        ]);

        $path = $request->file('design_file')->store('approvals', 'public');

        ProjectApproval::create([
            'project_id' => $project->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $path,
            'status' => 'pending',
        ]);

        // Notify client
        if ($project->client_id) {
            Notification::create([
                'user_id' => $project->client_id,
                'title' => 'Persetujuan Desain Baru Diminta',
                'message' => "Admin meminta persetujuan Anda untuk desain tata ruang: \"{$validated['title']}\".",
                'url' => route('client.dashboard') . '?project_id=' . $project->id,
            ]);
        }

        return back()->with('approval_success', 'Berkas persetujuan desain berhasil diunggah.');
    }

    public function postAdminComment(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $request->validate([
            'message' => 'required|string',
        ]);

        ProjectComment::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Notify client
        if ($project->client_id) {
            Notification::create([
                'user_id' => $project->client_id,
                'title' => 'Pesan Baru dari Admin',
                'message' => "Admin memberikan komentar pada proyek \"{$project->title}\".",
                'url' => route('client.dashboard') . '?project_id=' . $project->id,
            ]);
        }

        return back()->with('comment_success', 'Komentar berhasil dikirim.');
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.edit', compact('project', 'clients'));
    }

    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'nullable|exists:users,id',
            'category' => 'required|string',
            'status' => 'required|in:planning,ongoing,completed',
            'location' => 'required|string',
            'year' => 'required|string',
            'project_value' => 'nullable|integer',
            'scope' => 'nullable|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            // Delete old uploader file if exists
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $path = $request->file('cover_image')->store('projects', 'public');
            $validated['cover_image'] = $path;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    // 4. Contact Form Inbox
    public function inbox()
    {
        $messages = Message::latest()->get();
        return view('admin.inbox.index', compact('messages'));
    }

    public function showMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);
        return view('admin.inbox.show', compact('message'));
    }

    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.inbox.index')->with('success', 'Pesan berhasil dihapus.');
    }

    // 5. Settings Manager
    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->except('_token');
        foreach ($settings as $key => $value) {
            Setting::setKey($key, $value);
        }
        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }

    // 6. Database Backup Utilities (Pure PHP exporter for portability)
    public function backupDatabase()
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE', 'pt_wastu');
        $keyName = "Tables_in_" . $dbName;
        
        $sql = "-- Database Backup for PT. Wastu Cipta Nagara\n";
        $sql .= "-- Created: " . date('Y-m-d H:i:s') . "\n\n";
        
        foreach ($tables as $table) {
            $tableName = $table->$keyName;
            
            // Create table
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= $createTable[0]->{'Create Table'} . ";\n\n";
            
            // Get records
            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $rowArray = (array)$row;
                $keys = array_keys($rowArray);
                $escapedKeys = array_map(fn($k) => "`{$k}`", $keys);
                
                $values = array_values($rowArray);
                $escapedValues = array_map(function($v) {
                    if (is_null($v)) return 'NULL';
                    return "'" . addslashes($v) . "'";
                }, $values);
                
                $sql .= "INSERT INTO `{$tableName}` (" . implode(', ', $escapedKeys) . ") VALUES (" . implode(', ', $escapedValues) . ");\n";
            }
            $sql .= "\n\n";
        }

        $filename = "pt_wastu_backup_" . date('Ymd_His') . ".sql";
        
        return response($sql)
            ->header('Content-Type', 'application/sql')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
}
