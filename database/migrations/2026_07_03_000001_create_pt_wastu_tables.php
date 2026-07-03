<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Services
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable(); // bootstrap icon class name
            $table->text('description');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 2. Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // Architecture, Interior, Exterior, Commercial, Residential, etc.
            $table->string('status')->default('planning'); // planning, ongoing, completed
            $table->string('location');
            $table->string('year');
            $table->bigInteger('project_value')->nullable();
            $table->text('scope')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->timestamps();
        });

        // 3. Project Galleries
        Schema::create('project_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_type')->default('image'); // image, video
            $table->timestamps();
        });

        // 4. Project Progress Tracker
        Schema::create('project_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->date('date');
            $table->integer('percentage');
            $table->text('description');
            $table->timestamps();
        });

        // 5. Project Progress Images
        Schema::create('project_progress_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_progress_id')->constrained('project_progress')->cascadeOnDelete();
            $table->string('file_path');
            $table->timestamps();
        });

        // 6. Project Documents
        Schema::create('project_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('title');
            $table->string('file_path');
            $table->string('file_type'); // pdf, dwg, zip, docx, xlsx
            $table->string('file_size')->nullable();
            $table->string('uploaded_by')->default('admin');
            $table->timestamps();
        });

        // 7. Project Meetings
        Schema::create('project_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('meeting_title');
            $table->text('description')->nullable();
            $table->dateTime('meeting_date');
            $table->string('location_or_link')->nullable();
            $table->timestamps();
        });

        // 8. Project Comments (Chat log)
        Schema::create('project_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('message');
            $table->timestamps();
        });

        // 9. Project Design/Layout Approvals & Revisions
        Schema::create('project_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status')->default('pending'); // pending, approved, revision_requested
            $table->text('revision_notes')->nullable();
            $table->timestamps();
        });

        // 10. Team Members
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('skills')->nullable();
            $table->string('certificate')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->text('description')->nullable();
            $table->string('photo_path')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 11. Articles (Blog)
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->string('category')->nullable();
            $table->string('tags')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 12. Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_company')->nullable();
            $table->integer('rating')->default(5);
            $table->text('testimonial');
            $table->string('photo_path')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 13. Message Inbox
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 14. FAQs
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 15. Dynamic Settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // 16. Notifications System
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->string('url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('project_approvals');
        Schema::dropIfExists('project_comments');
        Schema::dropIfExists('project_meetings');
        Schema::dropIfExists('project_documents');
        Schema::dropIfExists('project_progress_images');
        Schema::dropIfExists('project_progress');
        Schema::dropIfExists('project_galleries');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('services');
    }
};
