@extends('layouts.app')
@section('title','Profile')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <span>Profile</span>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <span class="text-primary">Change</span>
                                </li>
                            </ol>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/template/images/captain-avatar.png') }}" alt="User">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ auth()->user()->name }}
                                </h3>

                                <p class="text-muted text-center">Administrator</p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <form action="{{ route("profile.update") }}" method="post">
                                @csrf
                                @method('put')
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        Profile
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                       value="{{ old('name', auth()->user()->name) }}" placeholder="Name"
                                                       id="name" name="name">
                                                @error('name')
                                                    <label for="name" class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                       value="{{ old('email', auth()->user()->email) }}"
                                                       id="email" name="email" readonly>

                                                @error('email')
                                                    <label for="email" class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="old_password">Old Password</label>
                                                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                                        placeholder="Old Password"
                                                       id="old_password" name="old_password">
                                                @error('old_password')
                                                    <label for="old_password" class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                                        placeholder="New Password"
                                                       id="new_password" name="new_password">
                                                @error('new_password')
                                                    <label for="new_password" class="text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="new-password-confirm">Confirm New Password</label>
                                                <input type="password" class="form-control" placeholder="Confirm New Password"
                                                       id="new-password-confirm" name="new_password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection