@extends('layouts.header')


@section('content')
    <div class="container">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="row mx-auto" style="width:50%">
                <div class="col-md-12">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" readonly class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                    
                </div>
                <div class="col-md-12">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" readonly class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" readonly class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                @foreach ($roles as $role)
                <div class="col-md-12 form-check mt-2">
                    <input type="radio" class="flat" name="role" id="role" value="{{ $role }}" 
                          {{ $user->role == $role ? 'checked' : '' }} >                    
                    <label class="form-check-label" for="role"> {{ $role }} </label>

                </div> 
                @endforeach
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Submit</button>
                </div>
                
            </div>
        
        </form>
    </div>
   
@endsection