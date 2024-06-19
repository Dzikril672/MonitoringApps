@extends('layouts.master')

@section('content')
    <div class="section full mt-2">
        <div class="wide-block">
            <!-- timeline -->
            <div class="timeline timed">
                <div class="item">
                    <span class="time">11:00 AM</span>
                    <div class="dot"></div>
                    <div class="content">
                        <h4 class="title">Call Amanda</h4>
                        <div class="text">Talk about the project</div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">1:30 PM</span>
                    <div class="dot bg-danger"></div>
                    <div class="content">
                        <h4 class="title">Meet up</h4>
                        <div class="text">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                            <img src="assets/img/favicon.png" alt="avatar" class="imaged w24 rounded">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">04:40 PM</span>
                    <div class="dot bg-warning"></div>
                    <div class="content">
                        <h4 class="title">Party Night</h4>
                        <div class="text">Get a ticket for party at tonight 9:00 PM</div>
                    </div>
                </div>
                <div class="item">
                    <span class="time">06:00 PM</span>
                    <div class="dot bg-info"></div>
                    <div class="content">
                        <h4 class="title">New Release</h4>
                        <div class="text">Export the version 2.3</div>
                    </div>
                </div>
            </div>
            <!-- * timeline -->
        </div>
    </div>
@endsection
