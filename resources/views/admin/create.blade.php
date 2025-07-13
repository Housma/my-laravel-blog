@extends('layouts.mainapp')

@section('content')
<div class="container">
    <h2>Create New Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <button class="btn btn-success">Create Admin</button>
    </form>
</div>
@endsection
