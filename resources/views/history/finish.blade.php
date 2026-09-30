
@extends('layouts.app')
@section('title', 'History')
@section('loans.history.finish', 'active')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header pb-0">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <form action="{{ route("history.finish") }}" role="search" method="get">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="_search" class="form-control float-right"
                                               value="{{ old("_search", request("_search")) }}"
                                               placeholder="Search">
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search mr-1"></i> ស្វែងរក
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            
                            <li class="breadcrumb-item active text-primary">របាយការណ៍អតិថិជនបង់ផ្តាច់</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        {{-- @php
            $ds = $m->groupBy(function($q){
                return $q->client;
            });
        @endphp --}}
        <!-- Main content -->
        <div class="content print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped3 projects">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">
                                                #
                                            </th>
                                            <th style="width: 30%">
                                                កម្ចី 
                                            </th>
                                            <th style="width: 35%">
                                                អតិថិជន
                                            </th>
                                           
                                            <th>
                                                ផ្សេងៗ
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($m as $im => $s)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}.
                                                </td>
                                                <td>
                                                    <small>គណនី </small>
                                                    <a href="{{ route("loans.show", $s->getSheet->getLoan->id) }}">
                                                        <b class="mr-3">{{ $s->getSheet->getLoan->acc_number }}</b>
                                                    </a>
                                                    <small>កម្ចី </small>
                                                    <b>
                                                        $ {{ number_format($s->getSheet->getLoan->balance) }}
                                                    </b>
                                                    <br>
                                                    <small>កាលបរិច្ឆេទបង់ផ្តាច់</small>
                                                    <b>
                                                        {{ \Carbon::parse($s->created_at)->format('d-m-Y h:i A')  }}
                                                    </b>
                                                    <a href="{{ route("loans.invoice", $s->getSheet->getPayments->id) }}" class="ml-3" title="Invoice">
                                                        <i class="fas fa-print"></i> បង្កាន់ដៃ
                                                    </a>
                                                    <br>
                                                    @php $item = $s->getSheet->getLoan->getCollaterals();  @endphp
                                                    @if($item->count() > 0)
                                                    <small>
                                                        <b>
                                                            {{ $item->first()->model }} 
                                                            {{ $item->first()->extra }} 
                                                            {{ $item->first()->year }} 
                                                            {{ $item->first()->color }} 
                                                            {{ $item->first()->iden }}
                                                        </b>
                                                    </small>
                                                    @endif  
                                                </td>
                                                <td>
                                                    <a href="{{ route('clients.show', $s->getClient->id ) }}" class="mr-2">
                                                    <b>{{ $s->getClient->fullName() }}</b>
                                                    </a> {{ $s->getClient->cus_key }} 
                                                    <small class="ml-3"></small>
                                                    {{ $s->getClient->occupation }}
                                                    <br>
                                                    {{ \Hel::phoneDisplay($s->getClient->phone) }} , {{ \Hel::phoneDisplay($s->getClient->phone2) }}
                                                    <small class="ml-3"></small>
                                                    
                                                    <br>
                                                    <small>
                                                    {{ $s->getClient->address() }}
                                                    </small>
                                                </td>

                                                <td class="project_progress"> 
                                                    @if($s->getSheet->getLoan->join_with != null)
                                                    <div class="btn-group mr-1">
                                                        <span class="badge br-dark brr text-dark">
                                                        អ្នករួមខ្ចី
                                                        </span>
                                                        <span class="badge bg-gradient-dark text-sm brl">
                                                            {{ $s->getSheet->getLoan->getJoin->fullName() }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                    @if($s->getSheet->getLoan->guaranteed != null)
                                                    <div class="btn-group mr-1">
                                                        <span class="badge br-dark brr text-dark">
                                                        អ្នកធានា
                                                        </span>
                                                        <span class="badge bg-gradient-dark text-sm brl">
                                                            {{ $s->getSheet->getLoan->getGuaranteed->fullName() }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                    @if($s->getSheet->getLoan->guaranteed_join != null)
                                                    <div class="btn-group mr-1">
                                                        <span class="badge br-dark brr text-dark">
                                                        អ្នករួមធានា
                                                        </span>
                                                        <span class="badge bg-gradient-dark text-sm brl">
                                                            {{ $s->getSheet->getLoan->getGuaranteedJoin->fullName() }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach 
                                     
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>                          
                        
                        @if($m->hasPages())                
                            <div class="float-right">
                                {{ $m->links() }}
                            </div>
                        @endif
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


{{-- 
@section('content1')
    <div class="content-wrapper print_white">
        <!-- Content Header (Page header) -->
        <section class="content-header print_white">
            <div class="container-fluid print_white">
                <div class="row1">
                    របាយការណ៍អតិថិជនបង់ផ្តាច់
                    <div class="float-right">
                        <button onclick="window.print()" class="btn bg-gradient-olive btn-sm">
                            <i class="fas fa-print mr-1"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="content page-break print_white">
            <div class="container-fluid print_white" style="color: black !important;">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <b>អតិថិជនបង់ផ្តាច់</b>
                                        <form class="float-right no-print" action="{{ route("history.finish") }}" method="GET">
                                            <div class="input-group input-group-sm" style="width: 250px;">
                                                <input type="text" name="_search" value="{{ old("_search", request("_search")) }}" class="form-control float-right" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                                @php
                                    $ds = $m->groupBy(function($q){
                                        return $q->client;
                                    });
                                @endphp

                                @foreach ($ds as $im => $s)
                                    @php $cs = $s->first(); @endphp
                                    <div class="user-block mb-1 mt-4">
                                        <span class="username ml-0">
                                            <strong class="mr-1">{{ $loop->iteration }}.</strong>

                                            <small>Client Key</small>
                                                <b class="mr-4">{{ $cs->getClient->cus_key }}</b>

                                            <small class="mr-1">Client</small>
                                                <b>{{ $cs->getClient->fullName() }}</b>
                                                <small>-</small>
                                                <b class="mr-4">{{ $cs->getClient->fullNameEn() }}</b>
                                            <small class="mr-1">Occupation</small>
                                                <b class="mr-4">
                                                    {{ $cs->getClient->occupation }}    
                                                </b>    
                                            <small class="mr-1">Phone</small>
                                                <b>{{ \Hel::phoneDisplay($cs->getClient->phone) }} , {{ \Hel::phoneDisplay($cs->getClient->phone2) }}</b>
                                        </span>
                                        <span class="description ml-0 text-dark" style="margin-top: 2px;">
                                            Address &nbsp;
                                            ផ្ទះលេខ {{ $cs->getClient->home }}, &nbsp;
                                            ក្រុម/ផ្លូវលេខ {{ $cs->getClient->group }}, &nbsp;
                                            ភូមិ {{ $cs->getClient->getVillage->village_namekh }}, &nbsp;
                                            ឃុំ/សង្កាត់ {{ $cs->getClient->getVillage->commune->commune_namekh }}, &nbsp;
                                            ស្រុក/ខណ្ឌ/ក្រុង {{ $cs->getClient->getVillage->commune->district->district_namekh }}, &nbsp;
                                            ខេត្ត/រាជធានី {{ $cs->getClient->getVillage->commune->district->province->province_kh_name }}
                                            
                                        </span>
                                    </div>
                                    <table class="table table-hover table-bordered border-black">
                                        <tbody>
                                        <tr class="mr__cus" style="font-size: 14px">
                                            <th class="text-center" width="40px">#</th>
                                            <th class="text-center">Loan</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Disbursement Date</th>
                                            <th class="text-center">Paid Date</th>
                                            <th class="text-center">Teller</th>
                                            <th class="text-center">Paid Amount</th>
                                            <th class="text-center">Paid By</th>
                                            <th class="text-center">Asset</th>
                                        </tr>
                                        @foreach ($s as $it)
                                        <tr class="mr__cus" style="font-size: 14px">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            
                                            <td class="text-center">
                                                <a href="{{ route("loans.show",$it->getSheet->getLoan->id) }}">
                                                    <strong>{{ $it->getSheet->getLoan->acc_number }}</strong>
                                                </a>
                                            </td>

                                            <td>
                                                $ <span class="float-right">{{ number_format($it->getSheet->getLoan->balance) }}</span>
                                            </td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($it->getSheet->getLoan->date_disburst)->format('D d-m-Y') }}
                                            </td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($it->getSheet->getPayments->paid_date)->format('D d-m-Y') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $it->getSheet->getPayments->getUser->name }}
                                            </td>

                                            <td>
                                                $
                                                <span class="float-right">
                                                    {{ number_format($it->getSheet->getPayments->Principal + $it->getSheet->getPayments->Penalty + $it->getSheet->getPayments->Interest) }}
                                                    <a href="{{ route("loans.invoice", $it->getSheet->getPayments->id) }}" class="ml-3" title="Invoice"><i class="fas fa-print"></i></a>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                {{ $it->getSheet->getPayments->paid_by }}
                                            </td>

                                            <td>                                   
                                                @php
                                                    $cols = $it->getSheet->getLoan->getCollaterals;
                                                @endphp
                                                @if($cols->count() > 0)
                                                {{ $cols->first()->model }} 
                                                {{ $cols->first()->extra }} 
                                                {{ $cols->first()->year }} 
                                                {{ $cols->first()->color }} 
                                                {{ $cols->first()->iden }}        
                                                @endif               
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                            <!-- /.card-body getUser -->
                        </div>
                        <!-- /.card -->
                    </div>
                    @if($m->hasPages())                
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body nmb d-flex justify-content-end">
                                    {{ $m->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </div>        
            </div>
        </section>
        
    </div>
@endsection
 --}}

@section('css')
    <style>
        .nmb .pagination {
            margin-bottom: 0 !important;
        }
        @media print {
            
            .page-break	{ 
                display: block; 
                page-break-before: always; 
            }
            .print_white{
                background-color: white !important;
            }
            @page {
                size: A3 landscape
            }
            
        }
    </style>
@endsection