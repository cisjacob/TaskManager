@extends('layouts.app')

@section('contents')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update-password') }}" method="POST">

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
                
                <h2 class="mb-4">Edit Password</h2>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current password" value="">
                    <label for="current_password">Current password</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="New password" value="">
                    <label for="password">New password</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" value="">
                    <label for="password_confirmation">Confirm password</label>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-secondary" href="">Change password</a>   
                </div>

                @include('components.form_errors')

            </form>
        </div>
    </div>
    
</div>

@endsection