@extends('layouts.app')

@section('contents')

<div class="container py-4 vw-50">
  <div class="card p-5 shadow p-3 mb-5 bg-body-tertiary rounded">
      <div class="card-body">
        <h5 class="card-title mb-3">Sign Up</h5>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('auth.sign-up.store') }}" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                <label for="name">Full Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
            <div class="mb-3">
                <a class="text-dark fst-italic" href="{{ route('auth.login') }}">Already have an account?</a>
            </div>
            
        </form>
        @include('components.form_errors')

      </div>
    </div>
</div>

@endsection