@extends('layouts.master')

{{-- @section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Profile</div>
    </div>
    <!-- * App Header -->
@endsection --}}

@section('content')
<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar mt-2">
            <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="avatar" class="imaged w64 rounded">
        </div>
        <div id="user-info" style="color:white;" class="mt-3">
            <h2 id="user-name">{{ $user->name }}</h2>
            <span id="user-role">{{ $role->nama_role }}</span>
        </div>
    </div>
</div>

<div class="section mt-3" id="presence-section">
    <div class="card" style=" margin-top: 20px;">
        <div class="list-group list-group-flush rounded">
            <a href="{{ route('updateprofil.view') }}" class="list-group-item list-group-item-action d-flex align-items-center rounded-top">
                <ion-icon name="person-outline" class="mr-2"></ion-icon> Edit Profile
            </a>
            <a href="{{ route('changepassword') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                <ion-icon name="lock-closed-outline" class="mr-2"></ion-icon> Ganti Password
            </a>
            <div class="bold">
                <hr>
            </div>
            <div class="list-group-item list-group-item-action d-flex align-items-center">
                <ion-icon name="moon-outline" class="mr-2"></ion-icon> Dark Mode
                <div class="custom-control custom-switch ml-auto">
                    <input type="hidden" class="custom-control-input dark-mode-switch" id="darkmodesidebar">
                    <label class="custom-control-label" for="darkmodesidebar"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: 20px;">
        <div class="list-group list-group-flush rounded">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action d-flex align-items-center rounded" style="color: red; background: none; border: none;">
                    <ion-icon name="log-out-outline" class="mr-2"></ion-icon> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<div class="section" id="presence-section">
    
</div>

@endsection
