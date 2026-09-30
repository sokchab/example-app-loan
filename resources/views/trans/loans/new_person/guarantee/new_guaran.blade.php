@extends('layouts.app')
@section('title','Loans | Guarantee')
@section('loans', 'active')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="javascript:window.history.back();">
                            <i class="fas fa-reply mr-2"></i> ត្រឡប់ក្រោយ
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <ol class="breadcrumb float-sm-right __kh__">
                                <li class="breadcrumb-item"><span class="text-dark">ព័ត៌មានកម្ចី</span></li>
                                <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានអ្នកធានា</span></li>
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
                                <span><i class="fas fa-user mr-1"></i>ព័ត៌មានអ្នកធានា</span>
                            </h3>
                        </div>
                        <form id="loan_form_client" class="prevent-submits" method="post" action="{{ route("fix.loan.CustGuaranNewStore") }}">
                            <div class="card-body">
                                @csrf 
    
                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__last_name" class="__kh__">នាមត្រកូល *</label>
                                            <input type="text" class="form-control @error('cus__last_name') is-invalid @enderror"
                                                   value="{{ old('cus__last_name',$data->last_name) }}"
                                                   name="cus__last_name" id="cus__last_name" placeholder="Last name" required autofocus>

                                            @error('cus__last_name')
                                            <label class="col-form-label text-danger" for="cus__last_name">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__first_name" class="__kh__">នាមខ្លួន *</label>
                                            <input type="text" class="form-control @error('cus__first_name') is-invalid @enderror"
                                                   value="{{ old('cus__first_name',$data->first_name) }}"
                                                   name="cus__first_name" id="cus__first_name" placeholder="First Name" required>

                                            @error('cus__first_name')
                                            <label class="col-form-label text-danger" for="cus__first_name">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    
                                    


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__last_name_en" class="__kh__">អក្សរឡាតាំង last Name *</label>
                                            <input type="text" class="form-control @error('cus__last_name_en') is-invalid @enderror"
                                                   value="{{ old('cus__last_name_en',$data->last_name_en) }}"
                                                   name="cus__last_name_en" id="cus__last_name_en" placeholder="Last name" required="">
                                            @error('cus__last_name_en')
                                            <label class="col-form-label text-danger" for="cus__last_name_en">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__first_name_en" class="__kh__">First Name * </label>
                                            <input type="text" class="form-control @error('cus__first_name_en') is-invalid @enderror"
                                                   value="{{ old('cus__first_name_en',$data->first_name_en) }}"
                                                   name="cus__first_name_en" id="cus__first_name_en" placeholder="First name" required="">
                                            @error('cus__first_name_en')
                                            <label class="col-form-label text-danger" for="cus__first_name_en">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cus__name_en" class="__kh__">ភេទ</label>
                                            <select name="cus__gender" id="cus__gender" class="form-control __kh__">
                                                <option value="1" {{ old('cus__gender',$data->gender)==1 ? "selected":"" }}>ប្រុស</option>
                                                <option value="0" {{ old('cus__gender',$data->gender)==0 ? "selected":"" }}>ស្រី</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cus__dob" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                                            <input type="date" class="form-control @error('cus__dob') is-invalid @enderror"
                                                   value="{{ old('cus__dob',$data->dob) }}"
                                                   name="cus__dob" id="cus__dob" placeholder="Enter ...">
                                            @error('cus__dob')
                                            <label class="col-form-label text-danger" for="cus__dob">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__mstatus" class="__kh__">ស្ថានភាពគ្រួសារ</label>
                                            <select name="cus__mstatus" id="cus__mstatus" class="form-control">
                                                @foreach($msta as $i)
                                                    <option value="{{ $i->id }}" {{ old('cus__mstatus', $data->getJoin->status)==$i->id ? "selected":"" }}>
                                                        {{ $i->name_kh.'-'.$i->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <input type="hidden" name="cus__id" value="{{ old('cus__id', $data->id) }}">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__id_type" class="__kh__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                                            <select name="cus__id_type" id="cus__id_type" class="form-control">
                                                @foreach($iden as $i)
                                                    <option value="{{ $i->id }}" {{ old('cus__id_type', $data->it)==$i->id ? "selected":"" }}>
                                                        {{ $i->name_kh }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__id_number" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន *</label>
                                            <input type="text" class="form-control @error('cus__id_number') is-invalid @enderror"
                                                   value="{{ old('cus__id_number',$data->it_no) }}"
                                                   name="cus__id_number" id="cus__id_number" placeholder="Enter ..." required="">
                                            @error('cus__id_number')
                                            <label class="col-form-label text-danger" for="cus__id_number">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="cus__id_register" class="__kh__">ចុះថ្ងៃទី</label>
                                            <input type="date" class="form-control @error('cus__id_register') is-invalid @enderror"
                                                   value="{{ old('cus__id_register',$data->it_date) }}"
                                                   name="cus__id_register" id="cus__id_register" placeholder="Enter ...">
                                            @error('cus__id_register')
                                            <label class="col-form-label text-danger" for="cus__id_register">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cus__type" class="__kh__">ត្រូវជាអ្វីនឹងអ្នកខ្ចី</label>
                                            <input type="text" class="form-control @error('cus__type') is-invalid @enderror"
                                                   value="{{ old('cus__type',$data->jx_type) }}"
                                                   name="cus__type" id="cus__type" placeholder="Enter ...">
                                            @error('cus__type')
                                            <label class="col-form-label text-danger" for="cus__type">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cus__occupation" class="__kh__">មុខរបរ *</label>
                                            <input type="text" class="form-control @error('cus__occupation') is-invalid @enderror"
                                                   value="{{ old('cus__occupation',$data->occupation) }}"
                                                   name="cus__occupation" id="cus__occupation" placeholder="Enter ..." required="">
                                            @error('cus__occupation')
                                            <label class="col-form-label text-danger" for="cus__occupation">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cus__occupation_add" class="__kh__">ទីតាំងមុខរបរ</label>
                                            <input type="text" class="form-control @error('cus__occupation_add') is-invalid @enderror"
                                                   value="{{ old('cus__occupation_add',$data->occ_address) }}"
                                                   name="cus__occupation_add" id="cus__occupation_add" placeholder="Enter ...">
                                            @error('cus__occupation_add')
                                            <label class="col-form-label text-danger" for="cus__occupation_add">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__phone" class="__kh__">លេខទូរស័ព្ទ *</label>
                                            <input type="text" class="form-control @error('cus__phone') is-invalid @enderror"
                                                   value="{{ old('cus__phone',$data->phone) }}"
                                                   data-inputmask='"mask": "999 999 9999"' data-mask
                                                   name="cus__phone" id="cus__phone" placeholder="Enter ..." required="">
                                            @error('cus__phone')
                                            <label class="col-form-label text-danger" for="cus__phone">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__phone2" class="__kh__" style="color: white">*</label>
                                            <input type="text" class="form-control @error('cus__phone2') is-invalid @enderror"
                                                   value="{{ old('cus__phone2',$data->phone2) }}"
                                                   data-inputmask='"mask": "999 999 9999"' data-mask
                                                   name="cus__phone2" id="cus__phone2" placeholder="Enter ...">
                                            @error('cus__phone2')
                                            <label class="col-form-label text-danger" for="cus__phone2">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__home" class="__kh__">លេខផ្ទះ</label>
                                            <input type="text" class="form-control __kh__"
                                                   value="{{ old('cus__home',$data->home) }}"
                                                   name="cus__home" id="cus__home" placeholder="Enter ...">
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__group" class="__kh__">ក្រុមទី/លេខផ្លូវ</label>
                                            <input type="text" class="form-control __kh__"
                                                   value="{{ old('cus__group',$data->group) }}"
                                                   name="cus__group" id="cus__group" placeholder="Enter ...">
                                        </div>
                                    </div>

                            

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__province" class="__kh__">ខេត្ត *</label>
                                            <select class="form-control select2" name="cus__province" id="cus__province">
                                                @foreach($prov as $p)
                                                    <option value="{{ $p->province_id }}"
                                                        {{ old('cus__province') == $p->province_id ? "selected": "" }}>
                                                        {{ $p->province_kh_name . '-' . $p->province_en_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__district" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង *</label>
                                            <select name="cus__district" id="cus__district" class="form-control select2">
                                                @foreach($dist as $d)
                                                    <option value="{{ $d->dis_id }}"
                                                        {{ old('cus__district') == $d->dis_id ? "selected": "" }}>
                                                        {{ $d->district_namekh . '-' . $d->district_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__commune" class="__kh__">ឃុំ/សង្កាត់ *</label>
                                            <select name="cus__commune" id="cus__commune" class="form-control select2">
                                                @foreach($comm as $c)
                                                    <option value="{{ $c->com_id }}"
                                                        {{ old('cus__commune') == $c->com_id ? "selected": "" }}>
                                                        {{ $c->commune_namekh . '-' . $c->commune_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="cus__village" class="__kh__">ភូមិ *</label>
                                            <select name="cus__village" id="cus__village" class="form-control select2">
                                                @foreach($vill as $v)
                                                    <option value="{{ $v->vill_id }}"
                                                        {{ old('cus__village') == $v->vill_id ? "selected": "" }}>
                                                        {{ $v->village_namekh . '-' . $v->village_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-prevent-submits">
                                        <i class="fas fa-save mr-1"></i>
                                        រក្សាទុក
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
<!-- InputMask -->
<script src="{{ asset('public/template') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('public/template') }}/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.select2').select2();
            $('[data-mask]').inputmask();
            $('#cus__province').on('change', function() {
                var provinceID = $(this).val();
                $.ajax({
                    url: "{{ route('communes.fetch.district','') }}/" + encodeURI(provinceID),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('#cus__district').empty(); $('#cus__district').append('<option selected>--ជ្រើសរើស--</option>');
                        $('#cus__commune').empty(); $('#cus__commune').append('<option selected>--ជ្រើសរើស--</option>');
                        $('#cus__village').empty(); $('#cus__village').append('<option selected>--ជ្រើសរើស--</option>');

                        $.each(data, function(key, value) {
                            $('#cus__district').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
                        });
                    }
                });
            });

            //District Change
            $('#cus__district').on('change', function(){
                var dis_id = $(this).val();
                $.ajax({
                    url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data){

                        $('#cus__commune').empty(); $('#cus__commune').append('<option selected>--ជ្រើសរើស--</option>');
                        $('#cus__village').empty(); $('#cus__village').append('<option selected>--ជ្រើសរើស--</option>');

                        $.each(data, function(key, value) {
                            $('#cus__commune').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
                        });
                    }
                });
            });

            //Commune Change
            $('#cus__commune').on('change', function(){
                var com = $(this).val();
                $.ajax({
                    url: "{{ route('clients.fetch.village', '') }}/" + encodeURI(com),
                    type: "GET",
                    dataType: "json",
                    success: function(data){

                        $('#cus__village').empty(); $('#cus__village').append('<option selected>--ជ្រើសរើស--</option>');

                        $.each(data, function(key, value) {
                            $('#cus__village').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
                        });
                    }
                });
            });

            $('.prevent-submits').on('submit', function(){
                $('.btn-prevent-submits').attr('disabled', true);
            });

            @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
            @endif
        });
    </script>
@endsection
