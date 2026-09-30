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
                            <a href="{{ route('villages.index') }}"><i class="fas fa-reply mr-2"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="province_id" class="__kh__">ខេត្ត</label>
                                    <input type="text" class="form-control __kh__" 
                                        name="province_id"
                                        value="{{ $objs->commune->district->province->province_kh_name }}"
                                        id="province_id" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="district_id" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</label>
                                    <input type="text" class="form-control __kh__" 
                                        name="district_id"
                                        value="{{ $objs->commune->district->district_namekh }}"
                                        id="district_id" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="commune_name" class="__kh__">ឃុំ/សង្កាត់</label>
                                    <input type="text" class="form-control" 
                                        name="commune_name"
                                        value="{{ $objs->commune->commune_namekh }}"
                                        id="commune_name" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="village_name" class="__kh__">ភូមិ</label>
                                    <input type="text" class="form-control" 
                                        name="village_name"
                                        value="{{ $objs->village_name }}"
                                        id="village_name" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="village_namekh" class="__kh__">ជាភាសាខ្មែរ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="village_namekh"
                                        value="{{ $objs->village_namekh }}"
                                        id="village_namekh" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('villages.edit', $objs->vill_id) }}" 
                            class="btn btn-success __kh__"><i class="fas fa-edit mr-2"></i>កែប្រែ
                        </a>
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
                <form action="{{ route('villages.destroy', $objs->vill_id) }}" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title __kh__">លុបភូមិ <span class="text-primary">{{ $objs->village_namekh }}</span></h4>
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
