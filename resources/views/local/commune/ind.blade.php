@extends('layouts.app')
@section('title','Communes')

@section('local.open','menu-open')
@section('local.active','active')
@section('local.commune', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="__kh__">ឃុំ/សង្កាត់</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                            <li class="breadcrumb-item active">ឃុំ/សង្កាត់</li>
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
                            <a href="{{ route('communes.create') }}"><i class="fas fa-plus mr-1"></i> ឃុំ/សង្កាត់ថ្មី</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="province_id">ខេត្ត</label>
                                    <select name="province_id" id="province_id" class="form-control select2 __kh__" style="width: 100%;">
                                        <option selected>--ជ្រើសរើស--</option>
                                        @foreach ($province as $item)
                                            <option value="{{ $item->province_id }}">{{ $item->province_kh_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="district_id">ស្រុក/ខណ្ឌ/ក្រុង</label>
                                    <select name="district_id" id="district_id" class="form-control select2 __kh__" style="width: 100%;">
                                        <option selected>--ជ្រើសរើស--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="li_province" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="__kh__">អត្ថលេខ</th>
                                    <th class="__kh__">ឃុំ/សង្កាត់</th>
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
        $('.select2').select2();
        
        $('#province_id').on('change', function() {
            $('#li_province').DataTable().destroy();

            var provinceID = $(this).val();

            $.ajax({
                url: "{{ route('communes.fetch.district','') }}/" + encodeURI(provinceID),
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#district_id').empty();
                    $('#district_id').append('<option value="__none__" selected>--ជ្រើសរើស--</option>');
                    $.each(data, function(key, value) {
                        $('#district_id').append('<option value="'+ value.id +'">'+ value.text +'</option>');
                    });
                }
            });
        });

        $('#district_id').on('change', function(){
            var districtId = $(this).val();

            $('#li_province').DataTable().destroy();

            if(districtId){
                $('#li_province').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('communes.fetch','') }}/" + encodeURI(districtId),
                    "columns": [
                        { data: "com_id", name: "com_id" },
                        { data: "commune_name", name: "commune_name" },
                        { data: "commune_namekh", name: "commune_namekh", class: "__kh__" },
                        { data: "modify_date", name: "modify_date" },
                        { data: "action", name: "action", orderable: false, searchable: false, class: "text-center" }
                    ],
                    "order": [[ 0, "desc" ]]
                });
            }
        });

        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
