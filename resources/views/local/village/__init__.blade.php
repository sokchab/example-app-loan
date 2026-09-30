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
                    <h1 class="__kh__">ភូមិថ្មី</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                            <li class="breadcrumb-item active">ភូមិថ្មី</li>
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
                            <a href="{{ route('villages.index') }}"><i class="fas fa-reply mr-2"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('villages.store') }}">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="pro_id" class="__kh__">ខេត្ត</label>
                                        <select name="pro_id" id="pro_id" 
                                            class="form-control select2 __kh__ @error('pro_id') is-invalid @enderror" 
                                            style="width: 100%;">
                                            <option>--ជ្រើសរើស--</option>
                                            @foreach ($province as $item)
                                                <option value="{{ $item->id }}">{{ $item->text }}</option>
                                            @endforeach
                                        </select>

                                        @error('pro_id')
                                            <label class="col-form-label text-danger" for="pro_id">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="district_id" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</label>
                                        <select name="district_id" id="district_id" 
                                            class="form-control select2 __kh__" style="width: 100%;">
                                            <option selected>--ជ្រើសរើស--</option>
                                        </select>

                                        @error('district_id')
                                            <label class="col-form-label text-danger" for="district_id">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="commune_id" class="__kh__">ឃុំ/សង្កាត់</label>
                                        <select name="commune_id" 
                                            id="commune_id" 
                                            class="form-control select2 __kh__" style="width: 100%;">
                                            <option selected>--ជ្រើសរើស--</option>
                                        </select>

                                        @error('commune_id')
                                            <label class="col-form-label text-danger" for="commune_id">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="village_name" class="__kh__">ឈ្មោះភូមិ</label>
                                        <input type="text" 
                                            class="form-control @error('village_name') is-invalid @enderror" 
                                            name="village_name"
                                            value="{{ old('village_name') }}"
                                            id="village_name" placeholder="village's name" required autofocus>

                                        @error('village_name')
                                            <label class="col-form-label text-danger" for="village_name">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="village_namekh" class="__kh__">ជាភាសាខ្មែរ</label>
                                        <input type="text" 
                                            class="form-control __kh__ @error('commune_namekh') is-invalid @enderror"
                                            name="village_namekh"
                                            value="{{ old('village_namekh') }}"
                                            id="village_namekh" placeholder="village's name in khmer" required>
        
                                        @error('village_namekh')
                                            <label class="col-form-label text-danger" for="village_namekh">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" 
                                        name="__new__"
                                        id="customSwitch3"
                                        {{ old('save__new__opt') ? 'checked' : '' }}>
                                    <label class="custom-control-label __kh__" for="customSwitch3">រក្សាទុកនិងបន្ថែមថ្មី</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary __kh__"><i class="fas fa-save mr-2"></i>រក្សាទុក</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            //Initialize Select2
            $('.select2').select2();

            //Province Change
            $('#pro_id').on('change', function() {

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

            //District Change
            $('#district_id').on('change', function(){
                var dis_id = $(this).val();
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


            @if (Session::has('message'))
                toastr.success('{{ Session::get('message') }}');
            @endif
        });
    </script>
@endsection