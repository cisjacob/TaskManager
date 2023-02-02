@extends('layouts.app')

@section('contents')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4">Edit Profile</h2>
            <form action="{{ route('user.update-profile') }}" method="POST">

                @csrf
                @method('PUT')

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="{{ $user->name }}">
                    <label for="name">Full name</label>
                </div>

                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-secondary" href="{{ route('user.edit-password') }}">Change password</a>
                </div>

                @include('components.form_errors')

            </form>
        </div>
    </div>
    
</div>

@endsection