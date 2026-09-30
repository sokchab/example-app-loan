@extends('layouts.app')
@section('title','Schedule')
@section('loans', 'active')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content pt-3">
      <div class="row">
        <div class="col-sm-2 no-print">
            <div class="row mb-3">
                <div class="col-sm-6">    
                    <a href="{{ route('loans.index') }}" 
                        class="btn bg-gradient-primary d-block">
                        <i class="fas fa-reply mr-1"></i> Back
                    </a> 
                </div>
                <div class="col-sm-6">
                    <button type="button" onclick="window.print()"
                        class="btn bg-gradient-olive d-block">
                        <i class="fas fa-print mr-1"></i> Print
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ឯកសារ</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-inbox"></i> Inbox
                                <span class="badge bg-primary float-right">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i> Sent
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-file-alt"></i> Drafts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-filter"></i> Junk
                                <span class="badge bg-warning float-right">65</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-trash-alt"></i> Trash
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-10">
            <section class="content">
                <div class="container-fluid" style="color: black !important;">
                    @include('trans.inv.print.schedule')
                </div>
            </section>
            <!-- /.content -->
            <section class="content page-break">
                <div class="container-fluid" style="color: black !important;">
                    @include('trans.inv.print.contract')
                </div>
            </section>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('css')
    <style type="text/css">
        .sign-m{
            margin-top: 130px;
        }
        .text-18{
            font-size: 18px;
        }
        .mrl{
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }
        .un-line{
            text-decoration: underline;
        }
        .line-h{
            line-height: 1.7em;
        }
        .f_17{
            font-size: 16.5px;
        }
        .for-print-a4{
            max-width: 269mm;
            margin: 0 auto;
        }
        @media print {
            .page-break	{ 
                display: block; 
                page-break-before: always; 
            }
        }
    </style>
@endsection