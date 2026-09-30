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
                    <h1 class="__kh__">កែប្រែព័ត៌មានខេត្ត</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right __kh__">
                        <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                        <li class="breadcrumb-item"><span class="text-primary">ខេត្ត</span></li>
                        <li class="breadcrumb-item active">កែប្រែព័ត៌មានខេត្ត</li>
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
                    <form role="form" method="POST" action="{{ route('provinces.update', $province->province_id) }}">
                        <div class="card-body">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="province_en_name" class="__kh__">ឈ្មោះខេត្ត</label>
                                <input type="text" class="form-control @error('province_en_name') is-invalid @enderror" 
                                    name="province_en_name"
                                    value="{{ old('province_en_name', $province->province_en_name) }}"
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
                                    value="{{ old('province_kh_name', $province->province_kh_name) }}"
                                    id="province_kh_name" placeholder="province's name in khmer" required>
                                @error('province_kh_name')
                                <label class="col-form-label text-danger" for="province_en_name">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success __kh__"><i class="fas fa-save mr-2"></i>កែប្រែ</button>
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