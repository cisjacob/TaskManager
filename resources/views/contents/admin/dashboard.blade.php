@extends('layouts.app')

@section('contents')

<div class="container py-4">

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-2">Add Task +</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    <div class="my-5">
        <table class="table-light" id="table_id">
            <thead>
                <tr>
                    <th>Task ID:</th>
                    <th>Assigned to:</th>
                    <th>Task Name:</th>
                    <th>Description:</th>
                    <th>Status</th>
                    <th>Assigned By:</th>
                    <th>Created At:</th>
                    <th>Actions:</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->assignee->name }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                            @switch($task->status)
                            @case("Pending")
                                <span class="badge text-bg-secondary">
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
                </td>
                    <td>{{ $task->creator->name }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td class="d-flex flex-row">
                        <a class="btn btn-primary m-1" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger m-1" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">There are no tasks yet..</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    

</div>

@endsection

@section('scripts')
<script>
        $('#table_id').DataTable();
</script>
@endsection