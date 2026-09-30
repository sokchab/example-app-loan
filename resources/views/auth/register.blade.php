

@extends('layouts.app')
@section('title','Auth')
@section('auth', 'active')    
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span>New User</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">Authentication</span></li>
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{ route('auth.index') }}"><i class="fas fa-reply mr-1"></i>Back</a>
                        </h3>
                    </div>
                    <form action="{{ route('auth.register') }}" method="POST"> @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                        <option value="1" {{ old('gender', true) ? 'selected' : '' }}>Male</option>
                                        <option value="0" {{ !old('gender', true) ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>

                            

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="is_admin">Type</label>
                                    <select id="is_admin" type="text" class="form-control @error('is_admin') is-invalid @enderror" name="is_admin">
                                        <option value="1" {{ old('is_admin', true) ? 'selected' : '' }}>Administrator</option>
                                        <option value="0" {{ !old('is_admin', true) ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" 
                                        name="username" value="{{ old('username') }}" required autocomplete="username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    
                                  </div>
                            </div>


                            
                        </div>
                       
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn bg-gradient-olive"><i class="fas fa-save mr-1"></i> Submit</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
