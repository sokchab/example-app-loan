@extends('layouts.app')
@section('title','Auth')
@section('auth', 'active')    
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span>Authentication</span>
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
                <div class="card card-solid">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{ route('auth.create') }}"><i class="fas fa-plus mr-1"></i>New User</a>
                        </h3>
                    </div>

                    <div class="card-body pb-0">
                        
                        <div class="row d-flex align-items-stretch">
                            @foreach ($user as $u)
                            
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                              <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                  {{ $u->is_admin ? "Administrator" : "User" }}
                                </div>
                                <div class="card-body pt-0">
                                  <div class="row">
                                    <div class="col-7">
                                      <h2 class="lead"><b>{{ $u->name }}</b></h2>
                                      <p class="text-muted text-sm"><b>Username: </b> {{ $u->email }} </p>
                                      @php
                                          $mx = $u->getPayments()->orderBy('created_at', 'desc')->first();
                                      @endphp
                                      @if($u->getPayments()->count() > 0)
                                      <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-arrow-right"></i></span> Last: {{ $mx->created_at }}</li>
                                        <li class="small">
                                            <span class="fa-li">
                                                <i class="fas fa-lg fa-arrow-right"></i>
                                            </span> Principal $: {{ number_format($mx->Principal) }}
                                        </li>

                                        <li class="small">
                                            <span class="fa-li">
                                                <i class="fas fa-lg fa-arrow-right"></i>
                                            </span> Interest $: {{ number_format($mx->Interest) }}
                                        </li>

                                        <li class="small">
                                            <span class="fa-li">
                                                <i class="fas fa-lg fa-arrow-right"></i>
                                            </span> Penalty $: {{ number_format($mx->Penalty) }}
                                        </li>
                                      </ul>
                                      @endif
                                    </div>
                                    <div class="col-5 text-center">
                                      <img src="{{ asset('public/template/images') }}/{{ $u->gender ? "male.png" : "female.png" }}" alt="" class="img-circle img-fluid">
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <div class="text-right">
                                    @if ($u->id == auth()->user()->id)
                                        <a href="{{ route('profile') }}" class="btn btn-sm bg-gradient-teal" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('auth.edit', $u->id) }}" class="btn btn-sm bg-gradient-teal" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if($u->is_active)
                                    <span class="btn btn-sm bg-gradient-primary">
                                      <i class="fas fa-user mr-1"></i> Active
                                    </span>
                                    @else
                                    <span class="btn btn-sm bg-gradient-dark">
                                        <i class="fas fa-user mr-1"></i> Disable
                                      </span>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                                                  
           
                        </div>
                    </div>

                    <div class="card-footer">
                       {{ $user->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
