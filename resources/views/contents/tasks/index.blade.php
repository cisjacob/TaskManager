@extends('layouts.app')

@section('contents')

<div class="container py-4">

    @forelse($tasks as $task)
    <div class="card mb-3 w-100">
        <div class="card-header d-flex flex-row">
            <div class="me-auto">
                Assigned by: {{ $task->creator->name }}
            </div>
            <div class="">
                <a href="{{ route('tasks.edit-status', $task->id) }}" class="btn btn-primary">Edit Status</a>
            </div>


        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $task->name }}
                    @switch($task->status)
                        @case("Pending")
                            <span class="badge text-bg-secondary"">
                            @break
                        @case("Processing")
                            <span class="badge text-bg-warning">
                            @break
                        @case("Done")
                            <span class="badge text-bg-success">
                            @break
                        @default
                            <span class="badge text-bg-primary">
                    @endswitch
                    {{$task->status}}
                    </span>
            </h5>
            <p class="card-text">{{ $task->description }}</p>
            <p class="card-text">{{ $task->created_at }}</p>
        </div>
    </div>
    @empty
    <h1 class="text-center">You don't have any tasks at the moment..</h1>
    @endforelse

    
</div>

@endsection