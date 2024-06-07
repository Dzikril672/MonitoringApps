@extends('layouts.master')

@section('content')
<div class="container">
    <div class="profile-page">
        <h1>Profile</h1>
        <div class="profile-info">
            <img src="" alt="Profile Picture">
            <h2>name</h2>
            <p>jabatan</p>
        </div>
        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}">Edit Profile</a>
        </div>
    </div>
</div>

@endsection