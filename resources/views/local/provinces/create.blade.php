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
                    <h1 class="__kh__">ព័ត៌មានខេត្តថ្មី</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right __kh__">
                        <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                        <li class="breadcrumb-item"><span class="text-primary">ខេត្ត</span></li>
                        <li class="breadcrumb-item active">ព័ត៌មានខេត្តថ្មី</li>
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
                            <a href="{{ route('provinces.index') }}"><i class="fas fa-reply mr-2"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('provinces.store') }}">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="province_en_name" class="__kh__">ឈ្មោះខេត្ត</label>
                                <input type="text" class="form-control @error('province_en_name') is-invalid @enderror" 
                                    name="province_en_name"
                                    value="{{ old('province_en_name') }}"
                                    id="province_en_name" placeholder="province's name" required autofocus>
                                @error('province_en_name')
                                <label class="col-form-label text-danger" for="province_en_name">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="province_kh_name" class="__kh__">ជាភាសាខ្មែរ</label>
                                <input type="text" class="form-control __kh__ @error('province_kh_name') is-invalid @enderror"
                                    name="province_kh_name"
                                    value="{{ old('province_kh_name') }}"
                                    id="province_kh_name" placeholder="province's name in khmer" required>
                                @error('province_kh_name')
                                <label class="col-form-label text-danger" for="province_kh_name">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                                @enderror
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
    @if (Session::has('message'))
    <script type="text/javascript">
        $(function() {
            toastr.success('{{ Session::get('message') }}');
        });
    </script>
    @endif
@endsection