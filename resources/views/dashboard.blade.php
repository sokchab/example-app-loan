@extends('layouts.app')
@section('title','Dashboard')
@section('dashboard', 'active')    
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    ទំព័រដើម
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ទំព័រដើម</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-olive">
                    <div class="inner">
                        <h3>
                            {{ \App\Helpers\Helper::shortNumeric($Disbursement,2) }}<sup style="font-size: 20px"> $</sup>
                        </h3>
                        <p>{{ number_format($Disbursement) }} $</p>
                        <p>ប្រាក់បានដាក់កម្ចី</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-comment-dollar"></i>
                    </div>
                    <a href="{{ route('loans.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-cyan">
                        <div class="inner">
                            <h3>
                                {{ \App\Helpers\Helper::shortNumeric($Outstanding,2) }}<sup style="font-size: 20px"> $</sup>
                            </h3>
                            <p>{{ number_format($Outstanding) }} $</p>
                            <p>ប្រាក់ក្នុងដៃអតិថិជន</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <a href="{{ route('bank.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-blue">
                        <div class="inner">
                            <h3>
                                {{ number_format($Clients) }}
                            </h3>
                            <p>អតិថិជន</p>
                            <p>ទាំងអស់</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="{{ route('clients.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-danger">
                        <div class="inner">
                            <h3>
                                {{ \App\Helpers\Helper::shortNumeric($Collection,0) }} <sup style="font-size: 20px"> $</sup>
                            </h3>
                            <p>{{ number_format($Collection) }} $</p>
                            <p>ប្រាក់ត្រូវប្រមូល</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="{{ route('collection.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-blue">
                        <div class="inner">
                            <h3>
                                {{ number_format($AllMisFi) }}
                            </h3>
                            <p>អតិថិជនកំពុងកម្ចី</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('clients.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-blue">
                        <div class="inner">
                            <h3>
                                {{ number_format($Finish) }}
                            </h3>
                            <p>អតិថិជនបង់ផ្តាច់</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('history.finish') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-blue">
                        <div class="inner">
                            <h3>
                                {{ number_format($Late) }}
                            </h3>
                            <p>អតិថិជនយឺត</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('history.late') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
            </div>



            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                To Do List
                            </h3>
                            <div class="card-tools pr-2">
                                <button type="button" class="btn bg-gradient-olive btn-xs" onclick="__modal()">
                                    <i class="fas fa-plus"></i> Add plan
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-1 pb-1">
                            <table id="tb-plan" class="table no-border">
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5">
                    <!-- Calendar -->
                    <div class="card bg-gradient-olive">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt mr-1"></i>
                                Calendar
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="to-do-list">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" id="frm-do-list">
                <div class="modal-header">
                    <h5 class="modal-title">Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Plan *</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1" placeholder="Enter ..." required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-1"></i> Save</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times mr-1"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('css')
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/template') }}/plugins/daterangepicker/daterangepicker.css">

    <style type="text/css">
        #tb-plan .sorting_disabled{
            display: none !important;
        }
        .p--cs{
            padding: 2px 0 !important;
        }
    </style>
@endsection

@section('js')
    <!-- daterangepicker -->
    <script src="{{ asset('public/template') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('public/template') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('public/template') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script type="text/javascript">
        @include("layouts.ajaxSetup")
                var table;
                var method, plan_id;

        $(function () {
            'use strict';
            // The Calender
            $('#calendar').datetimepicker({
                format: 'L',
                inline: true
            });
            
            
            $("#frm-do-list").submit(function (e) {
                e.preventDefault();  //plan.create
                let uri = method ? '{{ route("plan.create") }}' : '{{ route('plan.edit','') }}/' + plan_id;
                $.ajax({
                   type: 'post',
                   dataType: 'json',
                   data: $(this).serialize(),
                   url: uri,
                   success: res => {
                       $("#to-do-list").modal("hide");
                       table.ajax.reload(false,null);
                       console.log(res);
                   },
                   error: err => console.log(err)
                });
            });


            table = $('#tb-plan').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('plan.get') }}",
                "columns": [
                    { data: "plan", name: "plan", orderable: false, searchable: false, className: 'p--cs'}
                ]
            });
        });

        function __modal() {
            method = true;
            $("#to-do-list").modal("show");
            $(".modal-title").text('New Plan');
            $("#frm-do-list")[0].reset();
        }

        function __finish(val) {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{ route("plan.finish", "") }}/' + val,
                success: res => {
                    table.ajax.reload(false,null);
                    console.log(res);
                },
                error: err => console.log(err)
            });
        }

        function __edit(val,dsc) {
            method = false;
            $("#frm-do-list")[0].reset();
            $("input[name='description']").val(dsc);
            plan_id = val;
            $("#to-do-list").modal("show");
            $(".modal-title").text('Edit Plan');
        }

        function __delete(val) {
            if(confirm('Are you sure ?')){
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route("plan.delete", "") }}/' + val,
                    success: res => {
                        table.ajax.reload(false,null);
                        console.log(res);
                    },
                    error: err => console.log(err)
                });
            }
        }
    </script>
@endsection
{{-- @dd(\Notify::getData()[0]->balance) --}}