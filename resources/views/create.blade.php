@extends('layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Add New Todo</h4>
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

        <form action="{{ route('todos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Title">
            </div>
            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Enter Description"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image:</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection