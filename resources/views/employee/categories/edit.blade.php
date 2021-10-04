@extends('layouts.header')

@section('content')
    <div class="container">
        <form action="{{ route('employee.categories.update', $category->id ) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="row mx-auto" style="width:50%">
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ $category->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="type">Choose a type:</label>
                        <select class="form-control" id="type" name="type">
                        @foreach ($types as $type)
                            <option value="{{  $type }}"
                            {{ $category->type == $type ? 'selected' : '' }}> {{ $type }}</option>
                        @endforeach   
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Submit</button>
                </div>
                
            </div>
        
        </form>
    </div>
   
@endsection