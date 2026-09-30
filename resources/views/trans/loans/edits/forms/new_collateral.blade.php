@extends('layouts.app')
@section('title','Loans | Collateral | New')
@section('loans', 'active')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('loans.show', $data ) }}">
                            <i class="fas fa-reply mr-2"></i> ត្រឡប់ក្រោយ
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <ol class="breadcrumb float-sm-right __kh__">
                                <li class="breadcrumb-item"><span class="text-dark">ព័ត៌មានកម្ចី</span></li>
                                <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានទ្រព្យបញ្ចាំថ្មី</span></li>
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
                                <span>ព័ត៌មានទ្រព្យបញ្ចាំថ្មី</span>
                            </h3>
                        </div>
                        <form id="loan_form_client" method="post" action="{{ route('loans.addCollateral', $data) }}">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__model" class="__kh__">ក្រុមហ៊ុនផលិត *</label>
                                            <input type="text" class="form-control @error('col__model') is-invalid @enderror"
                                                   value="{{ old('col__model') }}"
                                                   name="col__model" id="col__model" placeholder="Enter ..." required autofocus>

                                            @error('col__model')
                                            <label class="col-form-label text-danger" for="col__model">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__extra" class="__kh__">ម៉ូដែល *</label>
                                            <input type="text" class="form-control @error('col__extra') is-invalid @enderror"
                                                   value="{{ old('col__extra') }}"
                                                   name="col__extra" id="col__extra" placeholder="Enter ..." required>
                                            @error('col__extra')
                                            <label class="col-form-label text-danger" for="col__extra">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__color" class="__kh__">ពណ៌ *</label>
                                            <input type="text" class="form-control @error('col__color') is-invalid @enderror"
                                                   value="{{ old('col__color') }}"
                                                   name="col__color" id="col__color" placeholder="Enter ..." required="">
                                            @error('col__color')
                                            <label class="col-form-label text-danger" for="col__color">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__body" class="__kh__">លេខតួ *</label>
                                            <input type="text" class="form-control @error('col__body') is-invalid @enderror"
                                                   value="{{ old('col__body') }}"
                                                   name="col__body" id="col__body" placeholder="Enter ..." required="">
                                            @error('col__body')
                                            <label class="col-form-label text-danger" for="col__body">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__machine" class="__kh__">លេខម៉ាស៊ីន *</label>
                                            <input type="text" class="form-control @error('col__machine') is-invalid @enderror"
                                                   value="{{ old('col__machine') }}"
                                                   name="col__machine" id="col__machine" placeholder="Enter ..." required="">
                                            @error('col__machine')
                                            <label class="col-form-label text-danger" for="col__machine">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__year" class="__kh__">ឆ្នាំផលិត *</label>
                                            <input type="text" class="form-control @error('col__year') is-invalid @enderror"
                                                   value="{{ old('col__year') }}"
                                                   name="col__year" id="col__year" placeholder="Enter ..." required="">
                                            @error('col__year')
                                            <label class="col-form-label text-danger" for="col__year">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="col__plate" class="__kh__">ផ្លាកលេខ</label>
                                            <input type="text" class="form-control @error('col__plate') is-invalid @enderror"
                                                   value="{{ old('col__plate') }}"
                                                   name="col__plate" id="col__plate" placeholder="Enter ...">
                                            @error('col__plate')
                                            <label class="col-form-label text-danger" for="col__plate">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group __kh__">
                                            <label for="col__type">ប្រភេទយានយន្ត</label>
                                            <select class="form-control"
                                                   name="col__type"
                                                   id="col__type">
                                                <option value="1" {{ old('col__type',1)==1 ? "selected" : "" }}>ម៉ូតូ</option>
                                                <option value="2" {{ old('col__type',1)==2 ? "selected" : "" }}>ឡាន</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">
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
    <script type="text/javascript">
        $(function () {
            @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
            @endif
        });
    </script>
@endsection
