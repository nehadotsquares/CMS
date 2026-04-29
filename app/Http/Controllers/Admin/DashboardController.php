<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalGalleries = Gallery::count();
        $totalContacts = Contact::count();
        $recentContacts = Contact::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalServices', 'totalGalleries', 'totalContacts', 'recentContacts'));
    }
}