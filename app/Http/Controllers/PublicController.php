<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Setting;

class PublicController extends Controller
{
    protected function getSettings()
    {
        return Setting::pluck('value', 'key')->all();
    }

    public function home()
    {
        $settings = $this->getSettings();
        $services = Service::orderBy('order')->take(6)->get();
        $projects = Project::where('is_featured', true)->orderBy('order')->take(4)->get();
        $testimonials = Testimonial::where('is_approved', true)->orderBy('order')->get();
        $faqs = Faq::orderBy('order')->get();

        return view('public.home', compact('services', 'projects', 'testimonials', 'faqs', 'settings'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        $team = TeamMember::orderBy('order')->get();
        return view('public.about', compact('team', 'settings'));
    }

    public function services()
    {
        $settings = $this->getSettings();
        $services = Service::orderBy('order')->get();
        return view('public.services', compact('services', 'settings'));
    }

    public function portfolio(Request $request)
    {
        $settings = $this->getSettings();
        $selectedCategory = $request->query('category');
        
        $query = Project::orderBy('order');
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }
        $projects = $query->get();

        // Get unique categories for filter tabs
        $categories = Project::select('category')->distinct()->pluck('category')->all();

        return view('public.portfolio', compact('projects', 'categories', 'selectedCategory', 'settings'));
    }

    public function projectDetail($slug)
    {
        $settings = $this->getSettings();
        $project = Project::where('slug', $slug)->with(['galleries', 'progress', 'documents'])->firstOrFail();
        
        // Fetch related projects
        $relatedProjects = Project::where('category', $project->category)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();

        return view('public.portfolio-detail', compact('project', 'relatedProjects', 'settings'));
    }

    public function team()
    {
        $settings = $this->getSettings();
        $team = TeamMember::orderBy('order')->get();
        return view('public.team', compact('team', 'settings'));
    }

    public function blog()
    {
        $settings = $this->getSettings();
        $articles = Article::where('is_published', true)->orderByDesc('created_at')->paginate(9);
        return view('public.blog', compact('articles', 'settings'));
    }

    public function blogDetail($slug)
    {
        $settings = $this->getSettings();
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $recentArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('public.blog-detail', compact('article', 'recentArticles', 'settings'));
    }

    public function contact()
    {
        $settings = $this->getSettings();
        return view('public.contact', compact('settings'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create($validated);

        return back()->with('success', 'Pesan Anda telah berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}
