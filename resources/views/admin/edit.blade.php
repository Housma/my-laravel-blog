@extends('layouts.mainapp')

@section('content')
<div class="container">
    <h2>Edit Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $admin->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <button class="btn btn-primary">Update Admin</button>
    </form>
</div>
@endsection
