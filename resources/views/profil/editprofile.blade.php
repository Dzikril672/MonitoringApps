<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Dashboard</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/icon/192x192.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="manifest" href="{{asset('__manifest.json')}}">
</head>

<body style="background-color:#e9ecef;">
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('profil.profile') }}" class="headerButton goBack">
                <
            </a>
        </div>
        <div class="pageTitle">Edit Profile</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

    <div id="appCapsule">
        <div class="section mt-5" id="user-section-second">
            <div class="container">
                <div class="profile-page">
                    <div class="profile-info text-center mt-3">
                        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="Profile Picture" class="rounded-circle" width="70">
                    </div>
                </div>
            </div>
        </div>

        <div class="section mt-3" id="presence-section">
            <form method="POST" action="{{ route('updateprofil') }}">
                @csrf
                @method('PUT')
                <div class="form-group mt-2">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">Jabatan</label>
                    <input type="text" id="role" name="role" value="No Role Assigned" class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('profil.profile') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</body>
