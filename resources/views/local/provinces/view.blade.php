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
                    <ol class="breadcrumb float-sm-right __kh__">
                        <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                        <li class="breadcrumb-item"><span class="text-primary">ខេត្ត</span></li>
                        <li class="breadcrumb-item active">ព័ត៌មានខេត្ត</li>
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
                    <div class="card-body">
                        <div class="form-group">
                            <label for="province_en_name" class="__kh__">ឈ្មោះខេត្ត</label>
                            <input type="text" class="form-control @error('province_en_name') is-invalid @enderror" 
                                name="province_en_name"
                                value="{{ old('province_en_name', $province->province_en_name) }}"
                                id="province_en_name" placeholder="province's name" readonly>
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
                                id="province_kh_name" placeholder="province's name in khmer" readonly>
                            @error('province_kh_name')
                            <label class="col-form-label text-danger" for="province_en_name">
                                <i class="far fa-times-circle"></i> {{ $message }}
                            </label>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('provinces.edit', $province->province_id) }}" class="btn btn-success __kh__"><i class="fas fa-edit mr-2"></i>កែប្រែ</a>
                        {{-- <button type="button" data-toggle="modal" data-target="#modal-default-delete"
                            class="btn btn-danger __kh__">
                            <i class="fas fa-trash mr-2"></i>លុប
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-default-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('provinces.destroy', $province->province_id) }}" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title __kh__">លុបខេត្ត <span class="text-primary">{{ $province->province_kh_name }}</span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @csrf
                        @method('delete')
                        <h5 class="__kh__ mb-4 mt-4">តើអ្នកប្រាកដដែរឬទេ ?</h5>
                    </div>
                    <div class="modal-footer __kh__">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i> បោះបង់</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-square"></i> យល់ព្រម</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection