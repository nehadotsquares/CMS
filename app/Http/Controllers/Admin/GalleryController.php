<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $galleries = Gallery::select(['id', 'title', 'category', 'image', 'description', 'finish_type', 'created_at']);
            
            return DataTables::of($galleries)
                ->addIndexColumn()
                ->addColumn('image', function($gallery) {
                    if ($gallery->image && file_exists(public_path($gallery->image))) {
                        return '<img src="'.asset($gallery->image).'" height="60" width="60" class="img-thumbnail" style="object-fit: cover;">';
                    }
                    return '<span class="text-muted">No image</span>';
                })
                ->addColumn('title', function($gallery) {
                    return '<strong>'.$gallery->title.'</strong>';
                })
                ->addColumn('category', function($gallery) {
                    return $gallery->category ? '<span class="badge bg-info">'.$gallery->category.'</span>' : '—';
                })
                ->addColumn('finish_type', function($gallery) {
                    if ($gallery->finish_type) {
                        $colors = [
                            'gold' => 'warning',
                            'silver' => 'secondary',
                            'brown' => 'dark',
                            'marble' => 'info'
                        ];
                        $color = $colors[$gallery->finish_type] ?? 'primary';
                        return '<span class="badge bg-'.$color.'">'.ucfirst($gallery->finish_type).'</span>';
                    }
                    return '—';
                })
                ->addColumn('description', function($gallery) {
                    return Str::limit($gallery->description, 60);
                })
                ->addColumn('action', function($gallery) {
                    $viewBtn = '<button type="button" class="btn btn-sm btn-info view-btn me-1" data-id="'.$gallery->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                    <i class="fas fa-eye"></i>
                                </button>';
                    $editBtn = '<button type="button" class="btn btn-sm btn-warning edit-gallery me-1" data-id="'.$gallery->id.'">
                                    <i class="fas fa-edit"></i>
                                </button>';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-gallery" data-id="'.$gallery->id.'">
                                    <i class="fas fa-trash"></i>
                                </button>';
                    return $viewBtn . $editBtn . $deleteBtn;
                })
                ->rawColumns(['image', 'title', 'category', 'finish_type', 'action'])
                ->make(true);
        }
        
        return view('admin.galleries.index');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'nullable|string',
            'finish_type' => 'nullable|string|max:50'
        ]);
        
        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->category = $request->category;
        $gallery->description = $request->description;
        $gallery->finish_type = $request->finish_type;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $filename);
            $gallery->image = 'uploads/gallery/' . $filename;
        }
        
        $gallery->save();
        
        return response()->json(['success' => true, 'message' => 'Image added successfully!']);
    }
    
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return response()->json($gallery);
    }
    
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return response()->json($gallery);
    }
    
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'nullable|string',
            'finish_type' => 'nullable|string|max:50'
        ]);
        
        $gallery->title = $request->title;
        $gallery->category = $request->category;
        $gallery->description = $request->description;
        $gallery->finish_type = $request->finish_type;
        
        if ($request->hasFile('image')) {
            if ($gallery->image && file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $filename);
            $gallery->image = 'uploads/gallery/' . $filename;
        }
        
        $gallery->save();
        
        return response()->json(['success' => true, 'message' => 'Gallery updated successfully!']);
    }
    
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }
        
        $gallery->delete();
        
        return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
    }
}