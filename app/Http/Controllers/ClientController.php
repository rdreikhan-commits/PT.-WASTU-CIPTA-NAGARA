<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectComment;
use App\Models\ProjectApproval;
use App\Models\Notification;
use App\Models\User;

class ClientController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $projects = $user->projects;

        // If the client has no projects
        if ($projects->isEmpty()) {
            return view('client.dashboard', [
                'projects' => $projects,
                'project' => null,
                'notifications' => $user->notifications()->latest()->take(5)->get()
            ]);
        }

        // Set active project
        $projectId = $request->query('project_id');
        $project = $projectId 
            ? $projects->where('id', $projectId)->first() 
            : $projects->first();

        if (!$project) {
            $project = $projects->first();
        }

        // Load project relations
        $project->load(['galleries', 'progress.images', 'documents', 'meetings', 'comments.user', 'approvals']);

        $notifications = $user->notifications()->latest()->take(10)->get();

        return view('client.dashboard', compact('projects', 'project', 'notifications'));
    }

    public function postComment(Request $request, $projectId)
    {
        $user = Auth::user();
        
        // Secure project ownership
        $project = $user->projects()->findOrFail($projectId);

        $request->validate([
            'message' => 'required|string',
        ]);

        ProjectComment::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        // Send a notification to Admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Komentar Baru dari Klien',
                'message' => "Klien {$user->name} memberikan komentar pada proyek \"{$project->title}\".",
                'url' => route('admin.projects.show', $project->id) . '#comments',
            ]);
        }

        return back()->with('comment_success', 'Komentar berhasil dikirim.');
    }

    public function updateApproval(Request $request, $approvalId)
    {
        $user = Auth::user();
        $approval = ProjectApproval::findOrFail($approvalId);
        
        // Secure project ownership
        $project = $user->projects()->findOrFail($approval->project_id);

        $request->validate([
            'status' => 'required|in:approved,revision_requested',
            'revision_notes' => 'required_if:status,revision_requested|nullable|string',
        ]);

        $statusText = $request->status === 'approved' ? 'Disetujui' : 'Revisi Diminta';

        $approval->update([
            'status' => $request->status,
            'revision_notes' => $request->status === 'revision_requested' ? $request->revision_notes : null,
        ]);

        // Send a notification to Admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => "Approval Desain: {$statusText}",
                'message' => "Klien {$user->name} mengubah status desain \"{$approval->title}\" menjadi {$statusText}.",
                'url' => route('admin.projects.show', $project->id) . '#approvals',
            ]);
        }

        return back()->with('approval_success', 'Status persetujuan desain berhasil diperbarui.');
    }

    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
