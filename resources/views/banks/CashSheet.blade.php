@extends("layouts.app")
@section('title', 'Financial')
@section('bank.open', 'menu-open')
@section('bank.active', 'active')
@section('cash.in.bank', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <button class="btn btn-outline-dark btn-sm" onclick="window.print()"><i class="fas fa-print mr-1"></i> Print</button>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Bank</li>
                            <li class="breadcrumb-item active text-primary">Financial Statement</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    <div class="col-sm-6">
                        @include("banks.summary.WeeklyCashFlow")
                    </div>
                    <div class="col-sm-6">
                        @include("banks.summary.MonthlyCashFlow")
                    </div>
                    <div class="col-sm-12">
                        @include("banks.summary.FinancialStatements")
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('css')
    <style type="text/css">
        .cus .pagination {
            margin-bottom: 0 !important;
        }

        @media print {
            .print_white{
                background-color: white !important;
            }
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('public/template') }}/plugins/chart.js/Chart.min.js"></script>
    <script type="text/javascript">
        $(function () {
            'use strict';
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            };
            var mode      = 'index';
            var intersect = true;
            @include("banks.js.salesChart")
            @include("banks.js.visitorsChart")
        });
    </script>
@endsection
