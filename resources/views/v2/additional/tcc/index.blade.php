@extends("layouts.app")
@section('title', 'V2.Others')
{{-- @section('bank.open', 'menu-open')
@section('bank.active', 'active') --}}
@section('v2.other', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('v2.another.createForm') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i>បន្ថែមថ្មី</a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-primary">កម្ចីដៃគូរ</li>
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
                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox pt-1">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="customCheckbox1">
                                            <label for="customCheckbox1" class="custom-control-label">ស្វែងរកតាមគណនី</label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="card-body table-responsive p-2">    
                                <table id="datatables" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="se">
                                            <th>គណនី</th>
                                            <th>ឈ្មោះអតិថិជន</th>
                                            <th>លេខទូរសព្ទ</th>
                                            <th>ថ្ងៃបង់ប្រាក់</th>
                                            <th>ប្រាក់សរុបត្រូវបង់</th>
                                            <th>MFI ដៃគូរ</th>
                                            <th>ផ្សេងៗ</th>
                                            <th>រយៈពេលបង់រំលស់</th>
                                            <th>ការប្រាក់/ខែ</th>
                                            <th>ថ្ងៃបង់ប្រាក់ដំបូង</th>
                                            <th>ថ្ងៃបញ្ចប់កម្ចី</th>
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
                    url: "{{ route('v2.another.fetch') }}",
                    data: function (da) {
                        da.search = $('input[type="search"]').val();
                        da.__by = $('#customCheckbox1')[0].checked
                    },
                    error : function(err){
                        console.log(err);
                    }
            },
            "columns": [
                { data: "acc_no", name: "acc_no", class: "custom" },
                { data: "cus_name", name: "cus_name", class: "custom" },
                { data: "cus_phone", name: "cus_phone", class: "custom" },
                { data: "pay_day", name: "pay_day", class: "custom" },
                { data: "amount_pay", name: "amount_pay", class: "custom" },
                { data: "c_mfi", name: "c_mfi", class: "custom" },
                { data: "others", name: "others", class: "custom" },
                { data: "ln_term", name: "ln_term", class: "custom" },
                { data: "ln_rate", name: "ln_rate", class: "custom" },
                { data: "first_pay_date", name: "first_pay_date", class: "custom" },
                { data: "end_pay_date", name: "end_pay_date", class: "custom" },
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
