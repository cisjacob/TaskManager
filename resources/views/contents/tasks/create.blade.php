@extends('layouts.app')

@section('contents')

<div class="container py-4">

   <form action="{{ route('tasks.store') }}" method="POST">
      @csrf

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

         <div class="form-floating mb-3">
            <select class="form-select" name="assigned_user_id" id="assigned_user_id">
               @forelse($users as $id => $name)
                  <option value="{{ $id }}">{{ $name }}</option>
               @empty
                  <option disabled>No users..</option>
               @endforelse
            </select>
            <label for="assigned_user_id">User</label>
         </div>

         <div class="form-floating mb-3">
               <input type="text" class="form-control" id="name" name="name" placeholder="Task Name">
               <label for="name">Task Name</label>
         </div>

         <div class="form-floating mb-3">
               <input type="text" class="form-control" id="description" name="description" placeholder="Description">
               <label for="description">Description</label>
         </div>

         <div class="mb-3">
            <button type="submit" class="btn btn-primary">Add</button>
         </div>

         @include('components.form_errors')

      </div>

   </form>
    
</div>

@endsection