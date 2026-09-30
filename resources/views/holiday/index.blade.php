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
                    ថ្ងៃឈប់សម្រាក
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ទំព័រដើម</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
{{--             
            <div class="col-sm-2">
                <a href="{{ route('holiday.create') }}" class="btn bg-gradient-primary btn-block mb-3">
                    <i class="fas fa-plus mr-2"></i>
                    បន្ថែមថ្មី
                </a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            ឆ្នាំ
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @foreach ($data as $item)
                            <li class="nav-item">
                                <a href="{{ route('holiday.index', [ 'quest' => $item->first()->year ] ) }}" 
                                    class="nav-link {{ request()->query()['quest']==$item->first()->year ? 'in-active' : '' }}">
                                    <i class="fas fa-calendar mr-1"></i> {{ $item->first()->year }}
                                    <span class="badge bg-gradient-olive float-right mt-1">
                                        {{ $item->count() }} ថ្ងៃ
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        
                    </div>
                    <!-- /.card-body -->
                </div>
            </div> 
            --}}
            <!-- /.col -->
            <div class="col-sm-12">
                <div class="card card-primary card-outline">
                    <div class="card-header pt-2 pb-1">
                        <h3 class="card-title mt-2" style="height: 24px;">
                            <a href="{{ route('holiday.create') }}">
                                <i class="fas fa-plus mr-1"></i> បន្ថែមថ្មី
                            </a>
                        </h3>
                        <div class="float-right dd-no">
                            @foreach ($data as $item)
                            <a href="{{ route('holiday.index', [ 'quest' => $item->first()->year ] ) }}"
                                class="btn btn-xs {{ request()->query()['quest']==$item->first()->year ? 'bg-gradient-navy' : 'bg-gradient-olive' }}">
                                {{ $item->first()->year }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive mailbox-messages">
                            <table class="table">
                                <tbody>
                                    @foreach ($rows as $it)
                                    <tr>                      
                                        <td class="mailbox-subject">
                                            <b>{{ \Carbon\Carbon::parse($it->holiday)->format('d-M-Y') }}</b> 
                                            - {{ $it->dsc }}
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('holiday.show', $it->id) }}" title="Edit">
                                                    <i class="fas fa-edit mr-1"></i> កែប្រែ
                                                </a> 
                                                {{-- 
                                                    &nbsp; &nbsp;
                                                    <a href="javascript:destroy({{ $it->id }})"><i class="far fa-trash-alt"></i></a> 
                                                --}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <!-- /.table -->
                            <div class="float-right mt-3 mr-3">
                                {{ $rows->appends(['quest' => request()->query()['quest']])->links() }}
                            </div>
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->  
                    
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

@endsection

@section('css')
    <style type="text/css">
        .in-active{
            color: #e83e8c !important;
        }
        .dd-no .pagination{
            margin-bottom: 0 !important;
        }
    </style>
@endsection