@extends("layouts.app")
@section('title', 'Return')
@section('loans.collection.return', 'active')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route("collection.return", [ "op" => "loan" ]) }}" class="btn bg-gradient-primary btn-sm">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">កម្ចី</li>
                            <li class="breadcrumb-item active text-primary">សងត្រឡប់</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-2 pb-2">
                                <h3 class="card-title mt-1">សងត្រឡប់</h3>
                                @if($data->getCollection->sum('print_due_return') > 0)
                                <div class="float-right">
                                    <a href="{{ route('collection.finish.loan', $data->id)  }}"
                                        class="btn bg-gradient-olive btn-sm">
                                        <i class="fas fa-clipboard-check mr-1"></i> បញ្ចប់កម្ចី
                                    </a>
                                </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <small>គណនី</small> <label class="text-primary">
                                            {{ $data->acc_number }}
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <small>កូដអតិថិជន</small> <label class="text-primary">
                                            {{ $data->getClient->cus_key }}
                                        </label>
                                    </div>
                                    <div class="col-sm-5">
                                        <small>អតិថិជន</small> <label class="text-primary">
                                            {{ $data->getClient->fullName() }} - {{ $data->getClient->fullNameEn() }}
                                        </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="float-right">
                                            <small>ទំហំកម្ចី</small>
                                            <label class="text-primary">
                                                {{ number_format($data->balance) }} $
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- @dd($data->getCollection()->isActive()->orderBy('date_pay', 'desc')->groupBy()->get()) --}}

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        @php
                                            $nest = $data->getCollection()
                                                         ->isActive()
                                                         //->orderBy('by_paid', 'desc')
                                                         ->orderBy('date_pay')
                                                         ->get()
                                                         ->groupBy(function($item) {
                                                             return $item->fee_return;
                                                         });
                                            // //dd($nest->count());
                                            // for ($i=0; $i < $nest->count(); $i++) { 
                                            //     echo 1;
                                            // }
                                        @endphp
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                            @foreach($nest as $d => $ds)
                                                <tr>
                                                    <td colspan="14">
                                                        <small class="mr-1">ទំហំកម្ចី</small> 
                                                        <b class="text-primary mr-3">
                                                        {{ number_format($ds->sum('print_due')) }} $
                                                        </b>

                                                        <small class="mr-1">ប្រាក់ដើមក្នុងដៃអតិថិជន</small>
                                                        <b>
                                                            {{ number_format($ds->sum('print_due_return')) }} $
                                                        </b>

                                                        <b class="ml-3">
                                                            @foreach ($ds->first()->getLoan->getCollaterals as $xs)
                                                                <span class="ml-2">
                                                                    {{ $xs->model }} 
                                                                    {{ $xs->extra }} 
                                                                    {{ $xs->year }} 
                                                                    {{ $xs->color }} 
                                                                    {{ $xs->iden }}
                                                                </span>
                                                            @endforeach
                                                        </b>
                                                    </td>
                                                </tr>
                                                <tr style="font-size: 12px">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">កាលបរិច្ឆេទ</th>
                                                    <th class="text-center">ប្រាក់ត្រូវបង់</th>
                                                    <th class="text-center">ប្រាក់ដើម</th>
                                                    <th class="text-center">ការប្រាក់</th>
                                                    <th class="text-center">សមតុល្យប្រាក់ដើម</th>
                                                    <th class="text-center">ពិន័យ</th>
                                                    <th class="text-center">ថ្ងៃយឺត</th>
                                                    <th class="text-center">ស្ថានភាព</th>
                                                    <th class="text-center">ប្រាក់បានបង់</th>
                                                    <th class="text-center">ថ្ងៃបង់ប្រាក់</th>
                                                    <th class="text-center">អ្នកទទួល</th>
                                                    <th class="text-center">បង់ដោយ</th>
                                                    <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                                                </tr>
                                                  
                                                @include('trans.collections.pay_list.list')
                                                
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('css')
    <style type="text/css">
        .pt-dd td{
            padding-bottom: 5px;
            padding-top: 5px;
        }
    </style>
@endsection