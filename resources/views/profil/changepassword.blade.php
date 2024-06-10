@extends('layouts.master')

@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="pageTitle">Change Password</div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')

<div class="section" style="margin-top: 70px;" id="change-password-section">
    <div class="container">
        <div class="change-password-page">
            <form>
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
                <a href="#" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection