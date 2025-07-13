@extends('layouts.mainapp')

@section('content')
<div class="container">
    <h2>Admin Management</h2>

    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary mb-3">Add Admin</a>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->role }}</td>
                <td>
                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
