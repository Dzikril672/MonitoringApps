@extends('layouts.master')

@section('content')
<div class="container">
    <div class="edit-profile-page">
        <h1>Edit Profile</h1>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Jabatan</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <!-- Tambahkan input lain sesuai kebutuhan -->
            <div class="form-group">
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection