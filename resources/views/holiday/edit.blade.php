@extends('layouts.app')
@section('title','Holiday')
@section('holiday', 'active')    
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    កែប្រែថ្ងៃឈប់សម្រាក
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('holiday.index') }}">ថ្ងៃឈប់សម្រាក</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{ route('holiday.index', [ 'quest'=> now()->format('Y') ]) }}">
                                <i class="fas fa-reply mr-1"></i>
                                ត្រឡប់ក្រោយ
                            </a>
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('holiday.edit', $holi->id) }}" method="post"> @csrf
                        <!-- /.card-header -->
                        @method('put')
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="dateHoliday">កាលបរិច្ឆេទ *</label>
                                    <input type="date" class="form-control @error('dateHoliday') is-invalid @enderror" 
                                        value="{{ old('dateHoliday', $holi->holiday) }}"
                                        name="dateHoliday" id="dateHoliday" 
                                        placeholder="Date" required autofocus>
                                    @error('dateHoliday')
                                        <label class="col-form-label text-danger" for="dateHoliday">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="description">បរិយាយ *</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" 
                                        value="{{ old('description', $holi->dsc) }}"
                                        name="description" id="description" placeholder="Description" required>
                                    @error('description')
                                        <label class="col-form-label text-danger" for="description">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.mail-box-messages -->
                        <br>
                        <div class="float-right">
                            <button type="submit" class="btn bg-gradient-primary">
                                <i class="far fa-save mr-1"></i> រក្សាទុក
                            </button>
                        </div>
                        </form>
                        <form action="{{ route('holiday.delete', $holi->id) }}" method="post">
                            @csrf 
                            @method('delete')
                            <button type="submit" class="btn bg-gradient-danger">
                                <i class="fas fa-trash mr-1"></i>លុប
                            </button>
                        </form>
                    </div>
                    <!-- /.card-body -->  
                    {{-- </form> --}}
{{-- 
                    <div class="card-footer">
                        <form action="{{ route('holiday.delete', $holi->id) }}" method="post">
                            @csrf 
                            @method('delete')
                            <button type="submit" class="btn bg-gradient-danger">
                                <i class="fas fa-trash mr-1"></i>លុប
                            </button>
                        </form>
                        
                    </div>
                    </form> --}}
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

@endsection
