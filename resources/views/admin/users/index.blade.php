@extends('layouts.header')

@section('content')
@include('partials.alert')
    <div class="container">
          <table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-primary float-left mr-2">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?');">Delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
            
          </tbody>
      </table>
    </div>
   
@endsection