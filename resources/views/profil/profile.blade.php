@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Profile</div>
    </div>
    <!-- * App Header -->
@endsection


@section('content')

<div class="section" style="margin-top: 70px;" id="user-section">
    <div class="container">
        <div class="profile-page">
            <div class="profile-info d-flex">
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
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <h3>Edit Profile</h3>
                    </div>
                        <span class="badge bg-belum">Juni 2024</span>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="section mt-3">
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <h3>Delete Account</h3>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="section mt-3">
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <h3>Mode Gelap</h3>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                      </div>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="section mt-3">
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        <h3>Log Out</h3>
                    </div>
                        <span class="badge bg-belum">Juni 2024</span>
                </div>
            </div>
        </li>
    </ul>
</div>

@endsection