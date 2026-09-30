@extends('layouts.app')
@section('title','Villages')

@section('local.open','menu-open')
@section('local.active','active')
@section('local.village', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="__kh__">ភូមិ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                            <li class="breadcrumb-item active">ភូមិ</li>
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
                            <a href="{{ route('villages.create') }}"><i class="fas fa-plus mr-1"></i> ភូមិថ្មី</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="province_id">ខេត្ត</label>
                                    <select name="province_id" id="province_id" class="form-control select2 __kh__" style="width: 100%;">
                                        <option selected>--ជ្រើសរើស--</option>
                                        @foreach ($province as $pv)
                                            <option value="{{ $pv->id }}">{{ $pv->text }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="district_id">ស្រុក/ខណ្ឌ/ក្រុង</label>
                                    <select name="district_id" id="district_id" class="form-control select2 __kh__" style="width: 100%;">
                                        <option selected>--ជ្រើសរើស--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="commune_id">ឃុំ/សង្កាត់</label>
                                    <select name="commune_id" id="commune_id" class="form-control select2 __kh__" style="width: 100%;">
                                        <option selected>--ជ្រើសរើស--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="li_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="__kh__" width="10%">អត្ថលេខ</th>
                                    <th class="__kh__" width="310px">ភូមិ</th>
                                    <th class="__kh__">ជាភាសាខ្មែរ</th>
                                    <th class="__kh__" width="17%">កាលបរិច្ឆេទកែប្រែ</th>
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
            //$('#li_table').DataTable().destroy();

            var provinceID = $(this).val();

            $.ajax({
                url: "{{ route('communes.fetch.district','') }}/" + encodeURI(provinceID),
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#district_id').empty();
                    $('#district_id').append('<option selected>--ជ្រើសរើស--</option>');

                    $('#commune_id').empty();
                    $('#commune_id').append('<option selected>--ជ្រើសរើស--</option>');

                    $.each(data, function(key, value) {
                        $('#district_id').append('<option value="'+ value.id +'">'+ value.text +'</option>');
                    });
                }
            });
        });

        $('#district_id').on('change', function(){
            var dis_id = $(this).val();
            //$('#li_table').DataTable().destroy();

            $.ajax({
                url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
                type: "GET",
                dataType: "json",
                success: function(data){
                    $('#commune_id').empty();
                    $('#commune_id').append('<option selected>--ជ្រើសរើស--</option>');
                    $.each(data, function(key, value) {
                        $('#commune_id').append('<option value="'+ value.id +'">'+ value.text +'</option>');
                    });
                }
            });
        });

        $('#commune_id').on('change', function(){
            var comm_id = $(this).val();

            $('#li_table').DataTable().destroy();

            if(comm_id){
                $('#li_table').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('villages.fetch','') }}/" + encodeURI(comm_id),
                    "columns": [
                        { data: "id", name: "id" },
                        { data: "name", name: "name" },
                        { data: "name_kh", name: "name_kh", class: "__kh__" },
                        { data: "modify", name: "modify" },
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
