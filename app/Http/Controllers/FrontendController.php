<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $services = Service::where('status', 'active')->take(6)->get();
        $galleries = Gallery::latest()->take(8)->get();
        return view('frontend.home', compact('services', 'galleries'));
    }
    
    public function services()
    {
        $services = Service::where('status', 'active')->paginate(9);
        return view('frontend.services', compact('services'));
    }
    
    public function serviceDetail($id)
    {
        $service = Service::findOrFail($id);
        return view('frontend.service-detail', compact('service'));
    }
    
    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);
        $categories = Gallery::distinct()->pluck('category');
        return view('frontend.gallery', compact('galleries', 'categories'));
    }
    
    public function galleryByCategory($category)
    {
        $galleries = Gallery::where('category', $category)->latest()->paginate(12);
        $categories = Gallery::distinct()->pluck('category');
        return view('frontend.gallery', compact('galleries', 'categories'));
    }
    
    public function about()
    {
        $aboutPage = Page::where('slug', 'about')->first();
        return view('frontend.about', compact('aboutPage'));
    }
    
    public function contact()
    {
        return view('frontend.contact');
    }
    
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string'
        ]);
        
        Contact::create($request->all());
        
        return redirect()->route('contact')->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
    
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'active')->firstOrFail();
        return view('frontend.page', compact('page'));
    }
}