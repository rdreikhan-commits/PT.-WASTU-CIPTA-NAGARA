<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminTestimonialController;
use App\Http\Controllers\AdminFaqController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/portfolio', [PublicController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{slug}', [PublicController::class, 'projectDetail'])->name('portfolio.detail');
Route::get('/team', [PublicController::class, 'team'])->name('team');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PublicController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Client Portal Routes (Role: client)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::post('/client/projects/{project}/comments', [ClientController::class, 'postComment'])->name('client.comments.store');
    Route::post('/client/approvals/{approval}', [ClientController::class, 'updateApproval'])->name('client.approvals.update');
    Route::post('/client/notifications/{id}/read', [ClientController::class, 'markNotificationRead'])->name('client.notifications.read');
});

/*
|--------------------------------------------------------------------------
| Admin Portal Routes (Role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard, Profile & Backups
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/backup', [AdminController::class, 'backupDatabase'])->name('backup');
    
    // Website Global Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Message Inbox
    Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox.index');
    Route::get('/inbox/{id}', [AdminController::class, 'showMessage'])->name('inbox.show');
    Route::delete('/inbox/{id}', [AdminController::class, 'deleteMessage'])->name('inbox.destroy');

    // Clients CRUD
    Route::get('/clients', [AdminController::class, 'clients'])->name('clients.index');
    Route::get('/clients/create', [AdminController::class, 'createClient'])->name('clients.create');
    Route::post('/clients', [AdminController::class, 'storeClient'])->name('clients.store');
    Route::get('/clients/{id}/edit', [AdminController::class, 'editClient'])->name('clients.edit');
    Route::put('/clients/{id}', [AdminController::class, 'updateClient'])->name('clients.update');
    Route::delete('/clients/{id}', [AdminController::class, 'deleteClient'])->name('clients.destroy');

    // Admin (Staff) CRUD
    Route::get('/admins', [AdminController::class, 'admins'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'createAdmin'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admins.store');
    Route::get('/admins/{id}/edit', [AdminController::class, 'editAdmin'])->name('admins.edit');
    Route::put('/admins/{id}', [AdminController::class, 'updateAdmin'])->name('admins.update');
    Route::delete('/admins/{id}', [AdminController::class, 'deleteAdmin'])->name('admins.destroy');

    // Projects (Portfolio) Management
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects.index');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::get('/projects/{id}', [AdminController::class, 'showProject'])->name('projects.show');
    Route::get('/projects/{id}/edit', [AdminController::class, 'editProject'])->name('projects.edit');
    Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{id}', [AdminController::class, 'deleteProject'])->name('projects.destroy');

    // Project Detail Actions (Milestones, Drawings, Comments, Meetings)
    Route::post('/projects/{project}/progress', [AdminController::class, 'updateProjectProgress'])->name('projects.progress.store');
    Route::post('/projects/{project}/documents', [AdminController::class, 'uploadProjectDocument'])->name('projects.documents.store');
    Route::post('/projects/{project}/meetings', [AdminController::class, 'scheduleProjectMeeting'])->name('projects.meetings.store');
    Route::post('/projects/{project}/approvals', [AdminController::class, 'uploadProjectApproval'])->name('projects.approvals.store');
    Route::post('/projects/{project}/comments', [AdminController::class, 'postAdminComment'])->name('projects.comments.store');

    // Services CRUD (Resource-like)
    Route::get('/services', [AdminServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [AdminServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [AdminServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [AdminServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [AdminServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [AdminServiceController::class, 'destroy'])->name('services.destroy');

    // Team CRUD
    Route::get('/team', [AdminTeamController::class, 'index'])->name('team.index');
    Route::get('/team/create', [AdminTeamController::class, 'create'])->name('team.create');
    Route::post('/team', [AdminTeamController::class, 'store'])->name('team.store');
    Route::get('/team/{id}/edit', [AdminTeamController::class, 'edit'])->name('team.edit');
    Route::put('/team/{id}', [AdminTeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{id}', [AdminTeamController::class, 'destroy'])->name('team.destroy');

    // Articles CRUD
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

    // Testimonials CRUD
    Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [AdminTestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [AdminTestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/{id}/edit', [AdminTestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{id}', [AdminTestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{id}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // FAQ CRUD
    Route::get('/faqs', [AdminFaqController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/create', [AdminFaqController::class, 'create'])->name('faqs.create');
    Route::post('/faqs', [AdminFaqController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/{id}/edit', [AdminFaqController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{id}', [AdminFaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{id}', [AdminFaqController::class, 'destroy'])->name('faqs.destroy');
});

/*
|--------------------------------------------------------------------------
| Storage Image Fallback (Fix for Shared Hosting Symlink Issues)
|--------------------------------------------------------------------------
| This will automatically serve files from storage/app/public if the 
| symlink is missing or broken.
*/
Route::get('storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    
    $mimeType = \Illuminate\Support\Facades\File::mimeType($path);
    return response()->file($path, ['Content-Type' => $mimeType]);
})->where('filename', '.*');
