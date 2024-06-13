@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Profile</div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')

<div class="section" style="margin-top: 50px;" id="user-section-second">
    <div class="container">
        <div class="profile-page">
            <div class="profile-info d-flex mt-3">
                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="Profile Picture" class="rounded-circle" width="70">
                <div id="user-info">
                    <h2 id="user-name">{{ $user->name }}</h2>
                    {{-- <span id="user-role">Technical Support</span> --}}
                    <span id="user-role">{{ $role->nama_role }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section mt-3">
    <div class="card" style=" margin-top: 20px;">
        <div class="list-group list-group-flush rounded">
            <a href="{{ route('updateprofil.view') }}" class="list-group-item list-group-item-action d-flex align-items-center rounded-top">
                <i class="fas fa-user-edit mr-2"></i> Edit Profile
            </a>
            <a href="{{ route('changepassword') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-lock mr-2"></i> Change Password
            </a>
            <div class="bold">
                <hr>
            </div>
            <div class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-moon mr-2"></i> Dark Mode
                <div class="custom-control custom-switch ml-auto">
                    <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodesidebar">
                    <label class="custom-control-label" for="darkmodesidebar"></label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section mt-3">
    <div class="card" style="margin-top: 20px;">
        <div class="list-group list-group-flush rounded">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action d-flex align-items-center rounded" style="color: red; background: none; border: none;">
                    <i class="fas fa-question-circle mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
