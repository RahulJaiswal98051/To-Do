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
            <th width="50px" height="50px">S.N</th>
            <th width="120px" height="50px">Image</th>
            <th width="150px">Title</th>
            <th>Description</th>
            <th width="100px">Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($todos as $todo)
        <tr style="height: 50px;">
            <td>{{ $todos->firstItem() + $loop->index }}</td>
            <td><img src="/images/{{ $todo->image }}" width="50px" height="50px"></td>
            <td>{{ $todo->title }}</td>
            <td>{{ $todo->description }}</td>
            <td>
                <span class="badge bg-{{ $todo->status == 'completed' ? 'success' : 'warning' }}">
                    {{ ucfirst($todo->status) }}
                </span>
            </td>
            <td>
                <a class="btn btn-primary" href="{{ route('todos.edit',$todo->id) }}">Edit</a>
                @if($todo->status != 'completed')
                <form action="{{ route('todos.complete',$todo->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Complete</button>
                </form>
                @endif
                <form action="{{ route('todos.destroy',$todo->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? You want to delete {{ $todo->title }}')">Delete</button>
                </form>
        </tr>
        @endforeach
    </table>
    {!! $todos->links() !!}
@endsection