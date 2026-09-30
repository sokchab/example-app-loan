@extends('layouts.app')
@section('title','Districts')

@section('local.open','menu-open')
@section('local.active','active')
@section('local.district', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                            <li class="breadcrumb-item active">ស្រុក/ខណ្ឌ/ក្រុង</li>
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
                            <a href="{{ route('districts.create') }}"><i class="fas fa-plus mr-1"></i> ស្រុក/ខណ្ឌ/ក្រុងថ្មី</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="province_id">ខេត្ត</label>
                                    <select name="table_search" id="table_search" class="form-control float-right __kh__" style="width: 100%;">
                                        <option value="__all__"​ selected="selected">--ទាំងអស់--</option>
                                        @foreach ($province as $item)
                                            <option value="{{ $item->province_id }}">{{ $item->province_kh_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table id="li_province" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="__kh__">អត្ថលេខ</th>
                                    <th class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</th>
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
        $('#table_search').select2();
        fetchData($('#table_search').val());
        
        //
        $('#table_search').change(function(){
            $('#li_province').DataTable().destroy();
            fetchData($('#table_search').val());
        });

        @if (Session::has('message'))
        toastr.success('{{ Session::get('message') }}');
        @endif
    });


    function fetchData(value){
        $('#li_province').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('districts.fetch','') }}/" + value,
            "columns": [
                { data: "dis_id", name: "dis_id" },
                { data: "district_name", name: "district_name" },
                { data: "district_namekh", name: "district_namekh", class: "__kh__" },
                { data: "modify_date", name: "modify_date" },
                { data: "action", name: "action", orderable: false, searchable: false, class: "text-center" }
            ],
            "order": [[ 0, "desc" ]]
        });
    }
</script>
@endsection
