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
                    <h1 class="__kh__">ឃុំ/សង្កាត់ថ្មី</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                            <li class="breadcrumb-item active">ឃុំ/សង្កាត់ថ្មី</li>
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
                            <a href="{{ route('communes.index') }}"><i class="fas fa-reply mr-2"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('communes.store') }}">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pro_id" class="__kh__">ខេត្ត</label>
                                        <select name="pro_id" id="pro_id" class="form-control select2 __kh__ @error('pro_id') is-invalid @enderror" style="width: 100%;">
                                            <option>--ជ្រើសរើស--</option>
                                            @foreach ($province as $item)
                                                <option value="{{ $item->province_id }}">{{ $item->province_kh_name }}</option>
                                            @endforeach
                                        </select>

                                        @error('pro_id')
                                            <label class="col-form-label text-danger" for="pro_id">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pro_id" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</label>
                                        <select name="district_id" id="district_id" class="form-control select2 __kh__" style="width: 100%;">
                                            <option selected>--ជ្រើសរើស--</option>
                                        </select>

                                        @error('district_id')
                                            <label class="col-form-label text-danger" for="district_id">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="commune_name" class="__kh__">ឈ្មោះឃុំ/សង្កាត់</label>
                                        <input type="text" class="form-control @error('commune_name') is-invalid @enderror" 
                                            name="commune_name"
                                            value="{{ old('commune_name') }}"
                                            id="commune_name" placeholder="commune's name" required autofocus>

                                        @error('commune_name')
                                            <label class="col-form-label text-danger" for="commune_name">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="commune_namekh" class="__kh__">ជាភាសាខ្មែរ</label>
                                        <input type="text" class="form-control __kh__ @error('commune_namekh') is-invalid @enderror"
                                            name="commune_namekh"
                                            value="{{ old('commune_namekh') }}"
                                            id="commune_namekh" placeholder="commune's name in khmer" required>
        
                                        @error('commune_namekh')
                                            <label class="col-form-label text-danger" for="commune_namekh">
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
                                        name="save__new__opt"
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
            $('.select2').select2();


            $('#pro_id').on('change', function() {

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



            @if (Session::has('message'))
                toastr.success('{{ Session::get('message') }}');
            @endif
        });
    </script>
@endsection