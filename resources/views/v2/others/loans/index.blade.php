@extends("layouts.app")
@section('title', 'Others.Loan')

@section('v2.other.loans', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('v2.others.loan.createForm') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i>បន្ថែមថ្មី</a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-primary">កម្ចីផ្សេងៗ</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header p-2 pt-0">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-group input-group-sm">
                                            <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                                        </div>
                                    </div>
                                   
                                </div>
                            
                            </div>
                            <div class="card-body table-responsive p-2">    
                                <table id="datatables" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="se">
                                            <th>អត្ថលេខ</th>
                                            <th>ឈ្មោះអ្នកខ្ចី</th>
                                            <th>ភេទ</th>
                                            <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                                            <th>លេខទូរសព្ទ</th>
                                            <th>ថ្ងៃខ្ចីប្រាក់</th>
                                            <th>ថ្ងៃបង់ប្រាក់</th>
                                            <th>ទំហំប្រាក់កម្ចី</th>
                                            {{-- <th>ផ្សេងៗ</th> --}}
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                          
                        </div>
                        <!-- /.card -->
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
    .custom {
        padding-bottom: 9px !important;
        padding-top: 9px !important;
        font-size: 14px;
    }

    .se .custom {
        font-size: 12px !important;
        border-top-width: 0 !important;
    }

    @media print {
        .print_white{
            background-color: white !important;
        }
    }
</style>
@endsection


@section('js')
<script>
    $(function () {
        var table = $('#datatables').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": false,
            "serverSide": true,
            "ajax": {
                    url: "{{ route('v2.others.loan.fetch') }}",
                    data: function (da) {
                        da.search = $('input[type="search"]').val();
                    },
                    error : function(err){
                        console.log(err);
                    }
            },
            "columns": [
                { data: "key", name: "key", class: "custom" },
                { data: "name", name: "name", class: "custom" },
                { data: "gender", name: "gender", class: "custom" },
                { data: "dob", name: "dob", class: "custom" },
                { data: "phone", name: "phone", class: "custom" },
                // { data: "description", name: "description", class: "custom" },
                { data: "created_at", name: "created_at", class: "custom" },
                { data: "payment_date", name: "payment_date", class: "custom" },
                { data: "amount", name: "amount", class: "custom" },
                { data: "action", name: "action", orderable: true, searchable: false, class: "custom" }
            ],
            "order": [[ 0, "desc" ]]
        });

        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif

        $('#search').on('keyup change', function(e){
            e.preventDefault();
            table.draw(); 
        });
    });
</script>
@endsection
