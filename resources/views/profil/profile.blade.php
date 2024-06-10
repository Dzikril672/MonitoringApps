@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Profile</div>
    </div>
    <!-- * App Header -->
@endsection


@section('content')

<div class="section" style="margin-top: 50px;" id="user-section">
    <div class="container">
        <div class="profile-page">
            <div class="profile-info d-flex mt-3">
                <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="Profile Picture" class="rounded-circle" width="70">
                <div id="user-info">
                    <h2 id="user-name">Dzikril Hakim</h2>
                    <span id="user-role">Technical Support</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section mt-3">
    <div class="card" style="width: 22rem; margin-top: 20px;">
        <div class="list-group list-group-flush rounded">
            <a href="/updateprofil" class="list-group-item list-group-item-action d-flex align-items-center rounded-top">
                <i class="fas fa-user-edit mr-2"></i> Edit Profile
            </a>
            <a href="/changepassword" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-lock mr-2"></i> Change Password
            </a>
            <div class="bold">
                <hr>
            </div>
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                <i class="fas fa-cog mr-2"></i> Mode Gelap
            </a>
        </div>
    </div>
</div>

<div class="section mt-3">
    <div class="card" style="width: 22rem; margin-top: 20px;">
        <div class="list-group list-group-flush rounded">
            <a href="#" class="list-group-item list-group-item-action d-flex align-items-center rounded">
                <i class="fas fa-question-circle mr-2"></i> Logout
            </a>
        </div>
    </div>
</div>


@endsection