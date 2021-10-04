@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }}</div>

                    <div class="card-body">
                    <form action="{{ route('employee.categories.store') }}" method="POST">
                            @csrf
                            {{ method_field('POST') }}
                        
                            <div class="row mx-auto" style="width:50%">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">Naziv</label>
                                    <input type="text" id="name" name="name" 
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">Odaberite tip:</label>
                                        <select class="form-control" id="type" name="type">
                                        @foreach ($types as $type)
                                            <option value="{{  $type }}">{{ $type }}</option>
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
                </div>
            </div>
        </div>
    </div>
   
@endsection

        