@extends('layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Edit Todo</h4>
        <a class="btn btn-primary" href="{{ route('todos.index') }}"> Back</a>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('todos.update',$todo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title:</label>
                <input type="text" name="title" value="{{ $todo->title }}" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea class="form-control" style="height:150px" name="description">{{ $todo->description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image:</label><br>
                <img src="/images/{{ $todo->image }}" width="100px" class="mb-2">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="pending" {{ $todo->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $todo->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection