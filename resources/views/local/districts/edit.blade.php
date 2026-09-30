@extends('layouts.app')
@section('title','Districts')

@section('local.open','menu-open')
@section('local.active','active')
@section('local.district', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="__kh__">កែប្រែស្រុក/ខណ្ឌ/ក្រុង</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right __kh__">
                        <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទីតាំង</span></li>
                        <li class="breadcrumb-item active">កែប្រែស្រុក/ខណ្ឌ/ក្រុង</li>
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
                            <a href="{{ route('districts.index') }}"><i class="fas fa-reply mr-2"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('districts.update', $district->dis_id) }}">
                        <div class="card-body">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="pro_id" class="__kh__">ឈ្មោះខេត្ត</label>
                                <select name="pro_id" id="pro_id" class="form-control __kh__ @error('pro_id') is-invalid @enderror">
                                    @foreach ($province as $item)
                                        <option value="{{ $item->province_id }}" {{ old("pro_id", $district->pro_id) == $item->province_id ? "selected":"" }}>{{ $item->province_kh_name }}</option>
                                    @endforeach
                                </select>

                                @error('pro_id')
                                    <label class="col-form-label text-danger" for="pro_id">
                                        <i class="far fa-times-circle"></i> {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="district_name" class="__kh__">ឈ្មោះស្រុក/ខណ្ឌ/ក្រុង</label>
                                <input type="text" class="form-control @error('district_name') is-invalid @enderror" 
                                    name="district_name"
                                    value="{{ old('district_name', $district->district_name) }}"
                                    id="district_name" placeholder="district's name" required autofocus>

                                @error('district_name')
                                    <label class="col-form-label text-danger" for="district_name">
                                        <i class="far fa-times-circle"></i> {{ $message }}
                                    </label>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="district_namekh" class="__kh__">ជាភាសាខ្មែរ</label>
                                <input type="text" class="form-control __kh__ @error('district_namekh') is-invalid @enderror"
                                    name="district_namekh"
                                    value="{{ old('district_namekh', $district->district_namekh) }}"
                                    id="district_namekh" placeholder="district's name in khmer" required>

                                @error('district_namekh')
                                    <label class="col-form-label text-danger" for="district_namekh">
                                        <i class="far fa-times-circle"></i> {{ $message }}
                                    </label>
                                @enderror
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
            $('#pro_id').select2();

            @if (Session::has('message'))
                toastr.success('{{ Session::get('message') }}');
            @endif
        });
    </script>
@endsection