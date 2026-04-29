<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::select(['id', 'name', 'email', 'phone', 'message', 'status', 'created_at']);
            
            return DataTables::of($contacts)
                ->addIndexColumn()
                ->addColumn('checkbox', function($contact) {
                    return '<input type="checkbox" class="contact-checkbox" value="'.$contact->id.'">';
                })
                ->addColumn('name', function($contact) {
                    return '<strong>'.$contact->name.'</strong>';
                })
                ->addColumn('message', function($contact) {
                    return \Illuminate\Support\Str::limit($contact->message, 50);
                })
                ->addColumn('status', function($contact) {
                    $badges = [
                        'unread' => 'danger',
                        'read' => 'warning',
                        'replied' => 'success'
                    ];
                    $color = $badges[$contact->status] ?? 'secondary';
                    return '<span class="badge bg-'.$color.'">'.ucfirst($contact->status).'</span>';
                })
                ->addColumn('created_at', function($contact) {
                    return $contact->created_at->format('Y-m-d H:i');
                })
                ->addColumn('action', function($contact) {
                    $viewBtn = '<button type="button" class="btn btn-sm btn-info view-contact me-1" data-id="'.$contact->id.'">
                                    <i class="fas fa-eye"></i>
                                </button>';
                    $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-contact" data-id="'.$contact->id.'">
                                    <i class="fas fa-trash"></i>
                                </button>';
                    return $viewBtn . $deleteBtn;
                })
                ->rawColumns(['checkbox', 'name', 'status', 'action'])
                ->make(true);
        }
        
        return view('admin.contacts.index');
    }
    
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact->status == 'unread') {
            $contact->status = 'read';
            $contact->save();
        }
        return response()->json($contact);
    }
    
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['success' => true, 'message' => 'Inquiry deleted successfully!']);
    }
    
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        Contact::whereIn('id', $ids)->delete();
        return response()->json(['success' => true, 'message' => 'Selected inquiries deleted successfully!']);
    }
}