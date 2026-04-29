<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::select(['id', 'title', 'description', 'image', 'status', 'created_at']);
            
            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('image', function($service) {
                    if ($service->image && file_exists(public_path($service->image))) {
                        return '<img src="'.asset($service->image).'" height="50" width="50" class="img-thumbnail" style="object-fit: cover;">';
                    }
                    return '<span class="text-muted">No image</span>';
                })
                ->addColumn('description', function($service) {
                    return Str::limit($service->description, 80);
                })
                ->addColumn('status', function($service) {
                    if ($service->status == 'active') {
                        return '<span class="badge bg-success">Active</span>';
                    }
                    return '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function($service) {
                    $editBtn = '<button type="button" class="btn btn-sm btn-warning edit-service me-1" data-id="'.$service->id.'">
                                    <i class="fas fa-edit"></i>
                                </button>';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-service" data-id="'.$service->id.'">
                                    <i class="fas fa-trash"></i>
                                </button>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
        
        return view('admin.services.index');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);
        
        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->status = $request->status;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $filename);
            $service->image = 'uploads/services/' . $filename;
        }
        
        $service->save();
        
        return response()->json(['success' => true, 'message' => 'Service created successfully!']);
    }
    
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }
    
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);
        
        $service->title = $request->title;
        $service->description = $request->description;
        $service->status = $request->status;
        
        if ($request->hasFile('image')) {
            if ($service->image && file_exists(public_path($service->image))) {
                unlink(public_path($service->image));
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $filename);
            $service->image = 'uploads/services/' . $filename;
        }
        
        $service->save();
        
        return response()->json(['success' => true, 'message' => 'Service updated successfully!']);
    }
    
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }
        
        $service->delete();
        
        return response()->json(['success' => true, 'message' => 'Service deleted successfully!']);
    }
}