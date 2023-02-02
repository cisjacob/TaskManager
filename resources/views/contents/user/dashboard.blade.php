@extends('layouts.app')

@section('contents')

<div class="container py-4">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <img src="{{ asset('images/usericon.png') }}" style="width: 150px;" class="mb-2">
            <h4>{{ $user->name }}</h4>
            <h6>{{ $user->email }}</h6>
            <a class="btn btn-default" href="{{ route('user.edit-profile') }}" style="background-color: #c8c5c0;">Edit profile</a>
        </div>
    </div>
    <div class="row my-4">

        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
            <div class="card text-bg-primary p-3">
                <div class="card-body text-center">
                    <h2>{{ $taskStatus['sumCount'] }}</h2>
                    <p class="fst-italic opacity-50">All Tasks</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
            <div class="card text-bg-secondary p-3">
                <div class="card-body text-center">
                    <h2>{{ $taskStatus['pending'] }}</h2>
                    <p class="fst-italic opacity-50">Pending Tasks</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
            <div class="card text-bg-warning p-3">
                <div class="card-body text-center">
                    <h2>{{ $taskStatus['processing'] }}</h2>
                    <p class="fst-italic opacity-50">Processing Tasks</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
            <div class="card text-bg-success p-3">
                <div class="card-body text-center">
                    <h2>{{ $taskStatus['done'] }}</h2>
                    <p class="fst-italic opacity-50">Done Tasks</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection