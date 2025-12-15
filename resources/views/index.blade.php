@extends('layout')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-success" href="{{ route('todos.create') }}"> Create New Todo</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
            <td><img src="/images/{{ $todo->image }}" width="100px"></td>
            <td>{{ $todo->title }}</td>
            <td>{{ $todo->description }}</td>
            <td>
                <span class="badge bg-{{ $todo->status == 'completed' ? 'success' : 'warning' }}">
                    {{ ucfirst($todo->status) }}
                </span>
            </td>
            <td>
                <form action="{{ route('todos.destroy',$todo->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('todos.edit',$todo->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? You want to delete {{ $todo->title }}')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection