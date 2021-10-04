@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                <a href="{{ route('employee.categories.create') }}" class="btn btn-primary mt-2 mb-4">Add new category</a>
                        <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Edit</th>
                            <th scope="col  ">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->type }}</td>
                            <td>
                                <a href="{{ route('employee.categories.edit',$category->id) }}" class="btn btn-outline-warning btn-sm float-left mr-4">Edit</a>
                            </td>
                            <td>
                            <form action="{{ route('employee.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection