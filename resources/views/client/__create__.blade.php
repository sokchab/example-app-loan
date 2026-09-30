@extends('layouts.app')
@section('title','Clients')

@section('client', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span>ព័ត៌មានអតិថិជនថ្មី</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានអតិថិជន</span></li>
                            <li class="breadcrumb-item active">ថ្មី</li>
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('clients.store') }}" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title __kh__">
                            <a href="javascript:window.history.back();"><i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="on__loan" value="{{ old('on__loan', request('on__loan')) }}">
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="last__name" class="__kh__">នាមត្រកូល</label>
                                    <input type="text" class="form-control __kh__ @error('last__name') is-invalid @enderror"
                                        name="last__name"
                                        value="{{ old('last__name') }}"
                                        id="last__name" placeholder="Last Name" required autofocus>
    
                                    @error('last__name')
                                        <label class="col-form-label text-danger" for="last__name">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="first__name" class="__kh__">នាមខ្លួន</label>
                                    <input type="text" class="form-control __kh__ @error('first__name') is-invalid @enderror"
                                        name="first__name"
                                        value="{{ old('first__name') }}"
                                        id="first__name" placeholder="First Name" required>
    
                                    @error('first__name')
                                        <label class="col-form-label text-danger" for="first__name">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>


                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="last__name_en__" class="__kh__">ជាអក្សរឡាតាំង</label>
                                    <input type="text" class="form-control __kh__ @error('last__name_en__') is-invalid @enderror"
                                        name="last__name_en__"
                                        value="{{ old('last__name_en__') }}"
                                        id="last__name_en__" placeholder="Last Name" required>
    
                                    @error('last__name_en__')
                                        <label class="col-form-label text-danger" for="last__name_en__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="first__name_en__" ><small>First Name</small></label>
                                    <input type="text" class="form-control @error('first__name_en__') is-invalid @enderror"
                                        name="first__name_en__"
                                        value="{{ old('first__name_en__') }}"
                                        id="first__name_en__" placeholder="First Name" required>
    
                                    @error('first__name_en__')
                                        <label class="col-form-label text-danger" for="first__name_en__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            
                           
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__gender__" class="__kh__">ភេទ</label>
                                    <select class="form-control __kh__ select2 @error('__gender__') is-invalid @enderror"
                                        name="__gender__"
                                        id="__kname__" style="width: 100%" data-minimum-results-for-search="Infinity">
                                        <option value="1" {{ old('__gender__') ? "selected" : "" }}>ប្រុស-Male</option>
                                        <option value="0" {{ !old('__gender__') ? "selected" : "" }}>ស្រី-Female</option>
                                    </select>
    
                                    @error('__gender__')
                                        <label class="col-form-label text-danger" for="__gender__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__dob__" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                                    <input type="date" class="form-control __kh__ @error('__dob__') is-invalid @enderror"
                                        name="__dob__"
                                        value="{{ old('__dob__') }}"
                                        id="__dob__" placeholder="Date of birth">
    
                                    @error('__dob__')
                                        <label class="col-form-label text-danger" for="__dob__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__id_type__" class="__id_type__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                                    <select class="form-control __kh__ select2 @error('__id_type__') is-invalid @enderror"
                                        name="__id_type__"
                                        id="__id_type__" style="width: 100%" data-minimum-results-for-search="Infinity">
                                        @foreach ($params['iden'] as $p)
                                            <option value="{{ $p->id }}" {{ old("__id_type__") == $p->id ? "selected":"" }}>{{ $p->name_kh }}</option>
                                        @endforeach
                                    </select>
    
                                    @error('__id_type__')
                                        <label class="col-form-label text-danger" for="__id_type__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__id_number__" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន</label>
                                    <input type="text" class="form-control __kh__ @error('__id_number__') is-invalid @enderror"
                                        name="__id_number__"
                                        value="{{ old('__id_number__') }}"
                                        id="__id_number__" placeholder="Identify Number" required>
    
                                    @error('__id_number__')
                                        <label class="col-form-label text-danger" for="__id_number__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__id_register__" class="__kh__">ចុះថ្ងៃទី</label>
                                    <input type="date" class="form-control __kh__ @error('__id_register__') is-invalid @enderror"
                                        name="__id_register__"
                                        value="{{ old('__id_register__') }}"
                                        id="__id_register__" placeholder="Register Date">
    
                                    @error('__id_register__')
                                        <label class="col-form-label text-danger" for="__id_register__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__occupation__">មុខរបរ</label>
                                    <input type="text" class="form-control __kh__ @error('__occupation__') is-invalid @enderror"
                                        name="__occupation__"
                                        value="{{ old('__occupation__') }}"
                                        id="__occupation__" placeholder="Occupation" required>
    
                                    @error('__occupation__')
                                        <label class="col-form-label text-danger" for="__occupation__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address_occupation">ទីតាំងមុខរបរ</label>
                                    <input type="text" class="form-control __kh__ @error('address_occupation') is-invalid @enderror"
                                        name="address_occupation"
                                        value="{{ old('address_occupation') }}"
                                        id="address_occupation" placeholder="Occupation Address">
    
                                    @error('address_occupation')
                                        <label class="col-form-label text-danger" for="address_occupation">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__phone__" class="__kh__">លេខទូរស័ព្ទ</label>
                                    <input type="text" class="form-control __kh__ @error('__phone__') is-invalid @enderror"
                                        name="__phone__"
                                        value="{{ old('__phone__') }}"
                                        data-inputmask='"mask": "999 999 9999"' data-mask
                                        id="__phone__" placeholder="Phone">
    
                                    @error('__phone__')
                                        <label class="col-form-label text-danger" for="__phone__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__phone__2" class="__kh__" style="color: white">-</label>
                                    <input type="text" class="form-control __kh__ @error('__phone__2') is-invalid @enderror"
                                        name="__phone__2"
                                        value="{{ old('__phone__2') }}"
                                        data-inputmask='"mask": "999 999 9999"' data-mask
                                        id="__phone__2" placeholder="Phone">
    
                                    @error('__phone__2')
                                        <label class="col-form-label text-danger" for="__phone__2">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>   
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title __kh__ text-danger">អាសយដ្ឋាន</h3>
                    </div> --}}
                    <div class="card-body" style="height: 457px">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__home__" class="__kh__">ផ្ទះលេខ</label>
                                    <input type="text" class="form-control __kh__ @error('__home__') is-invalid @enderror"
                                        name="__home__"
                                        value="{{ old('__home__') }}"
                                        id="__home__" placeholder="Enter ...">
        
                                    @error('__home__')
                                        <label class="col-form-label text-danger" for="__home__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__group__" class="__kh__">ក្រុមទី/ផ្លូវលេខ</label>
                                    <input type="text" class="form-control __kh__ @error('__group__') is-invalid @enderror"
                                        name="__group__"
                                        value="{{ old('__group__') }}"
                                        id="__group__" placeholder="Enter ...">
        
                                    @error('__group__')
                                        <label class="col-form-label text-danger" for="__group__">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                           
                        </div>

                        <div class="form-group">
                            <label for="__province__" class="__kh__">ខេត្ត</label>
                            <select class="form-control __kh__ select2 @error('__province__') is-invalid @enderror"
                                name="__province__"
                                id="__province__" style="width: 100%">
                                {{-- <option selected>--ជ្រើសរើស--</option> --}}
                                @foreach ($params['addr']['prov'] as $p)
                                    <option value="{{ $p->id }}">{{ $p->name.'-'.$p->name_en }}</option>
                                @endforeach
                            </select>

                            @error('__province__')
                                <label class="col-form-label text-danger" for="__province__">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="__district__" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</label>
                            <select name="__district__" 
                                id="__district__" 
                                class="form-control select2 __kh__" style="width: 100%;">
                                <option selected>--ជ្រើសរើស--</option>
                                @foreach ($params['addr']['dist'] as $dis)
                                    <option value="{{ $dis->id }}">{{ $dis->name.'-'.$dis->name_en }}</option>
                                @endforeach
                            </select>
                            
                            @error('__district__')
                                <label class="col-form-label text-danger" for="__district__">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="__commune__" class="__kh__">ឃុំ/សង្កាត់</label>
                            <select name="__commune__" 
                                id="__commune__" 
                                class="form-control select2 __kh__" style="width: 100%;">
                                <option selected>--ជ្រើសរើស--</option>
                            </select>

                            @error('__commune__')
                                <label class="col-form-label text-danger" for="__commune__">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="__village__" class="__kh__">ភូមិ</label>
                            <select name="__village__" 
                                id="__village__" 
                                class="form-control select2 __kh__" style="width: 100%;">
                                <option selected>--ជ្រើសរើស--</option>
                            </select>

                            @error('__village__')
                                <label class="col-form-label text-danger" for="__village__">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary __kh__"><i class="fas fa-save mr-2"></i>រក្សាទុក</button>

                        <div class="form-group mb-0 mt-2 float-right">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" 
                                    name="__new__"
                                    id="customSwitch3"
                                    {{ old('__new__') ? 'checked' : '' }}>
                                <label class="custom-control-label __kh__" for="customSwitch3">រក្សាទុកនិងបន្ថែមថ្មី</label>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
        </form>
    </section>
</div>
@endsection

@section('js')
<!-- InputMask -->
<script src="{{ asset('public/template') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('public/template') }}/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<script>
    $(function () {
        $('.select2').select2();
        $('[data-mask]').inputmask();

        //Province Change
        $('#__province__').on('change', function() {
            var provinceID = $(this).val();
            $.ajax({
                url: "{{ route('communes.fetch.district','') }}/" + encodeURI(provinceID),
                type: "GET",
                dataType: "json",
                success:function(data) {
                    
                    $('#__district__').empty(); $('#__district__').append('<option selected>--ជ្រើសរើស--</option>');
                    $('#__commune__').empty(); $('#__commune__').append('<option selected>--ជ្រើសរើស--</option>');
                    $('#__village__').empty(); $('#__village__').append('<option selected>--ជ្រើសរើស--</option>');

                    $.each(data, function(key, value) {
                        $('#__district__').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
                    });
                }
            });
        });

        //District Change
        $('#__district__').on('change', function(){
            var dis_id = $(this).val();
            $.ajax({
                url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
                type: "GET",
                dataType: "json",
                success: function(data){

                    $('#__commune__').empty(); $('#__commune__').append('<option selected>--ជ្រើសរើស--</option>');
                    $('#__village__').empty(); $('#__village__').append('<option selected>--ជ្រើសរើស--</option>');
                    
                    $.each(data, function(key, value) {
                        $('#__commune__').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
                    });
                }
            });
        });

        //Commune Change
        $('#__commune__').on('change', function(){
            var com = $(this).val();
            $.ajax({
                url: "{{ route('clients.fetch.village', '') }}/" + encodeURI(com),
                type: "GET",
                dataType: "json",
                success: function(data){

                    $('#__village__').empty(); $('#__village__').append('<option selected>--ជ្រើសរើស--</option>');
                    
                    $.each(data, function(key, value) {
                        $('#__village__').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
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
