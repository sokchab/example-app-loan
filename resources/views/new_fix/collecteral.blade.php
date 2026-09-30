@extends('layouts.app')
@section('title','Loans')

@section('loans', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('loans.create') }}" class="btn bg-gradient-primary btn-sm">
                        <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានកម្ចី</span></li>
                            <li class="breadcrumb-item active">ទ្រព្យបញ្ចាំ</li>
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('fix.coll.saveOrNewCollec') }}" class="prevent-submits" method="POST"> 
            @csrf
              
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__model">ក្រុមហ៊ុនផលិត <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                               name="collateral__model"  value="{{ old('collateral__model', $cols->model) }}"
                                               id="collateral__model" placeholder="Enter ..." required autofocus>
                                        @error('collateral__model')
                                            <label>{{ $message }}</label>
                                        @enderror       
                                        
                                    </div>
                                </div>
            
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__extra">ម៉ូដែល <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                               name="collateral__extra" value="{{ old('collateral__extra', $cols->extra) }}"
                                               id="collateral__extra" placeholder="Enter ..." required>
                                        @error('collateral__extra')
                                            <label>{{ $message }}</label>
                                        @enderror 
                                    </div>
                                </div>
            
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__color">ពណ៍ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                               name="collateral__color" value="{{ old('collateral__color', $cols->color) }}"
                                               id="collateral__color" placeholder="Enter ..." required>

                                               @error('collateral__color')
                                               <label>{{ $message }}</label>
                                           @enderror        
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__body">លេខតួ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                               name="collateral__body"  value="{{ old('collateral__body', $cols->body) }}"
                                               id="collateral__body" placeholder="Enter ..." required>


                                               @error('collateral__body')
                                               <label>{{ $message }}</label>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__machine">លេខម៉ាស៊ីន <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                               name="collateral__machine" value="{{ old('collateral__machine', $cols->marchine) }}"
                                               id="collateral__machine" placeholder="Enter ..." required>

                                               @error('collateral__machine')
                                               <label>{{ $message }}</label>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__year">ឆ្នាំផលិត <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                               name="collateral__year" value="{{ old('collateral__year', $cols->year) }}"
                                               id="collateral__year" placeholder="Enter ..." required>


                                               @error('collateral__year')
                                               <label>{{ $message }}</label>
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group __kh__">
                                        <label for="collateral__number">ផ្លាក់លេខ/ប័ណ្ណសម្គាល់</label>
                                        <input type="text" class="form-control"
                                               name="collateral__number" value="{{ old('collateral__number', $cols->iden) }}"
                                               id="collateral__number" placeholder="Enter ...">

                                               @error('collateral__number')
                                               <label>{{ $message }}</label>
                                           @enderror
                                    </div>
                                </div>
            
                                
            
                                <div class="col-sm-4">
                                    <div class="form-group __kh__">
                                        <label for="collateral__type">ប្រភេទយានយន្ត</label>
                                        <select class="form-control"
                                               name="collateral__type"
                                               id="collateral__type">
                                            <option value="1" {{  old('collateral__type', $cols->type) == 1 ? "selected" : "" }}>ម៉ូតូ</option>
                                            <option value="2" {{  old('collateral__type', $cols->type) == 2 ? "selected" : "" }}>ឡាន</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="__colecteral_value" value="{{ old('__colecteral_value', $cols->id) }}">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-prevent-submits">
                                <i class="fas fa-save mr-1"></i>រក្សាទុក
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            
            {{-- end row --}}
        </form>
    </section>
</div>
@endsection