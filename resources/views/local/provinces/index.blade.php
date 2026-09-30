@extends('layouts.app')
@section('title','Provinces')

@section('local.open','menu-open')
@section('local.active','active')
@section('local.province', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="__kh__">ព័ត៌មានខេត្ត</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                            <li class="breadcrumb-item active">ខេត្ត</li>
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
                        <h3 class="card-title __kh__">
                            <a href="{{ route('provinces.create') }}"><i class="fas fa-plus mr-1"></i> ព័ត៌មានខេត្តថ្មី</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="li_province" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="__kh__">អត្ថលេខ</th>
                                    <th class="__kh__">ខេត្ត</th>
                                    <th class="__kh__">ជាភាសាខ្មែរ</th>
                                    <th class="__kh__">កាលបរិច្ឆេទកែប្រែ</th>
                                    <th class="__kh__" width="130px">ព្រឹត្តិការណ៍</th>
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
        $('#li_province').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('provinces.fetch') }}",
            "columns": [
                { data: "province_id", name: "province_id" },
                { data: "province_en_name", name: "province_en_name" },
                { data: "province_kh_name", name: "province_kh_name", class: "__kh__" },
                { data: "modify_date", name: "modify_date" },
                { data: "action", name: "action", orderable: false, searchable: false, class: "text-center" }
            ],
            "order": [[ 0, "desc" ]]
        });

        @if (Session::has('message'))
        toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
