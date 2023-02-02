@extends('layouts.app')

@section('contents')

<div class="container py-4">

   <form action="{{ route('tasks.update-status', ['task' => $task]) }}" method="POST">
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

         <div class="form-floating mb-3">

            <select class="form-select" name="status" id="assigned_user_id">
               <option value="Pending">Pending</option>
               <option value="Processing">Processing</option>
               <option value="Done">Done</option>
            </select>
            <label for="assigned_user_id">Status</label>
         </div>

         <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
         </div>

         @include('components.form_errors')

      </div>

   </form>
    
</div>

@endsection