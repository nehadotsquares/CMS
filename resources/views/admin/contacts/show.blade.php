@extends('admin.layouts.admin')

@section('title', 'View Inquiry')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Inquiry Details</h2>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Personal Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name:</th>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $contact->phone }}</td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{ $contact->created_at->format('F d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $contact->status == 'unread' ? 'danger' : 'success' }}">
                                    {{ $contact->status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Message</h5>
                    <div class="alert alert-info">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this inquiry?')">Delete Inquiry</button>
                </form>
                <button class="btn btn-success" onclick="window.location.href='mailto:{{ $contact->email }}'">Reply via Email</button>
            </div>
        </div>
    </div>
</div>
@endsection 