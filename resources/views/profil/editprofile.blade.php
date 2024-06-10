@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Edit Profile</div>
    </div>
    <!-- * App Header -->
@endsection


@section('content')

<div class="section" style="margin-top: 50px;" id="user-section">
    <div class="container">
        <div class="profile-page">
            <div class="profile-info text-center mt-3">
                <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="Profile Picture" class="rounded-circle" width="70">
                {{-- <div id="user-info">
                    <h2 id="user-name">Dzikril Hakim</h2>
                    <span id="user-role">Technical Support</span>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<div class="section mt-3">
    <form>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="Dzikril Hakim" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="Technical Support" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="/profil" class="btn btn-secondary">Back</a>
    </form>
</div>

@endsection