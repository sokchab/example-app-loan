@extends('layouts.app')
@section('title','Loans')

@section('loans', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span>ព័ត៌មានកម្ចី</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានកម្ចី</span></li>
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
                            <a href="{{ route('loans.create') }}">
                                <i class="fas fa-plus mr-1"></i>
                                បន្ថែមកម្ចី
                            </a>
                        </h3>
                    </div>
                    <div class="card-body">
                        
                        <table id="li_province454" class="table no-border--top1 table-bordered xsm--cus11">
                            <thead>
                                <tr>
                                    <th width="147px">#</th>

                                    <th>គណនី</th>
                                    <th>ព័ត៌មានអតិថិជន</th>
                                    
                                    <th width="400px">ព័ត៌មានកម្ចី</th>
                                      
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
    <style type="text/css">
        .xsm--cus tr td{
            padding-top: 5px !important;
            padding-bottom: 7px !important;
        }
    </style>
@endsection

@section('js')
<script>
    $(function () {
        $('#li_province454').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": false,
            "serverSide": true,          
            "ajax": {
                url: "{{ route('loans.fetch') }}",
                data: function (da) {
                    da.q = $('input[type="search"]').val()
                }
            },
            "columns": [
                // { data: "acc_number id", name: "id", className: "text-center" },
                { data: "button1", name: "button1" },

                { data: "acc_number", name: "acc_number", className: "text-center"  },

                { data: "clients", name: "clients" },

                { data: "balance", name: "balance" },
                
                // { data: "sub_action", name: "sub_action", orderable: false, searchable: false , className: "project_progress" },
                // { data: "action", name: "action", orderable: false, searchable: false }
            ],
            "order": [
                [ 0, "desc" ]
            ]
        });

        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
