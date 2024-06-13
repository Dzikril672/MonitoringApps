@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Edit Profile</div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')

<div class="section" style="margin-top: 50px;" id="user-section-second">
    <div class="container">
        <div class="profile-page">
            <div class="profile-info text-center mt-3">
                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="Profile Picture" class="rounded-circle" width="70">
            </div>
        </div>
    </div>
</div>

<div class="section mt-3">
    <form method="POST" action="{{ route('updateprofil') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Jabatan</label>
            <input type="text" id="role" name="role" value="No Role Assigned" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="{{ route('profil.profile') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

@endsection
