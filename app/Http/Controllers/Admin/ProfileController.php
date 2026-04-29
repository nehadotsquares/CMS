<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show admin profile form
     */
    public function index()
    {
        $admin = Auth::user();
        return view('admin.profile.index', compact('admin'));
    }

    /**
     * Update admin profile information
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);
        
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();
        
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Update admin password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        
        $admin = Auth::user();
        
        // Check current password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect!']);
        }
        
        // Update password
        $admin->password = Hash::make($request->new_password);
        $admin->save();
        
        return redirect()->route('admin.profile')->with('success', 'Password updated successfully!');
    }
    
    /**
     * Update admin profile picture
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $admin = Auth::user();
        
        // Delete old avatar if exists
        if ($admin->avatar && file_exists(public_path($admin->avatar))) {
            unlink(public_path($admin->avatar));
        }
        
        // Upload new avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/avatars'), $filename);
            $admin->avatar = 'uploads/avatars/' . $filename;
            $admin->save();
        }
        
        return redirect()->route('admin.profile')->with('success', 'Profile picture updated successfully!');
    }
    
    /**
     * Remove admin profile picture
     */
    public function removeAvatar(Request $request)
    {
        $admin = Auth::user();
        
        if ($admin->avatar && file_exists(public_path($admin->avatar))) {
            unlink(public_path($admin->avatar));
            $admin->avatar = null;
            $admin->save();
        }
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Profile picture removed successfully!']);
        }
        
        return redirect()->route('admin.profile')->with('success', 'Profile picture removed successfully!');
    }
}