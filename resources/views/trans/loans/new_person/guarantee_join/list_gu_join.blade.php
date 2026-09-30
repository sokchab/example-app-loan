@extends('layouts.app')
@section('title','Loans')

@section('loans', 'active')    


@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('loans.create') }}" class="btn bg-gradient-primary btn-sm">
                        <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានកម្ចី</span></li>
                            <li class="breadcrumb-item"><span class="text-primary">ថ្មី</span></li>
                            <li class="breadcrumb-item active">ជ្រើសអ្នករួមធានា</li>
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
                            <a href="{{ route("fix.loan.KOKFormNew") }}"><i class="fas fa-plus mr-1"></i>ព័ត៌មានអ្នករួមធានា</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        
                        <table id="choose_guaran_join" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ឈ្មោះអ្នករួមធានា</th>
                                    <th>ជាអក្សរឡាតាំង</th>
                                    <th>ភេទ</th>
                                    <th>ផ្សេងៗ</th>
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

@section('js')
<script>
    $(function () {
        $('#choose_guaran_join').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": false,
            "serverSide": true,
            "ajax": {
                url: "{{ route('fix.loan.fetchGuaranteeJoinFix') }}",
                data: function (da) {
                    da.search = $('input[type="search"]').val()
                }
            },
            "columns": [
                { data: "action", name: "action", class: "text-center" },
                // { data: "__key__", name: "__key__" },
                { data: "full_name", name: "full_name" },
                { data: "name_full_en", name: "name_full_en" },
                { data: "gender", name: "gender" },
                //{ data: "__dob__", name: "__dob__"},
                { data: "activation", name: "activation", orderable: false, searchable: false }
            ],
            "order": [[ 0, "desc" ]]
        });

        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
