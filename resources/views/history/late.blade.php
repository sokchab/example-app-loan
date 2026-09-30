@extends('layouts.app')
@section('title', 'History')
@section('loans.history.late', 'active')
@section('content')
    <div class="content-wrapper print_white">
        <!-- Content Header (Page header) -->
        <section class="content-header print_white">
            <div class="container-fluid print_white">
                <div class="row1">
                    ប្រវត្តិអតិថិជនយឺត
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
                                        <b>ប្រវត្តិអតិថិជនយឺត</b>
                                        <form class="float-right no-print" action="{{ route("history.late") }}" method="GET">
                                            <div class="input-group input-group-sm" style="width: 250px;">
                                                <input type="text" name="_search" value="{{ old("_search", request('_search')) }}" class="form-control float-right" placeholder="Search">
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
                                    
                                    <table class="table table-bordered border-black table-sm">
                                        <tbody>
                                        @php
                                            $loans = $s->groupBy('loan');
                                        @endphp
                                        @foreach ($loans as $x => $z)
                                            @php $loan = $z->first()->getSheet->getLoan; @endphp
                                            <tr style="font-size: 14px">
                                                <td colspan="8">
                                                    <a href="{{ route("loans.show", $loan->id) }}"><b class="mr-2">{{ $loan->acc_number }}</b></a>
                                                    ទំហំកម្ចី <b class="mr-2">$ {{ number_format($loan->balance) }}</b>
                                                    ថ្ងៃបើកប្រាក់ <b class="mr-2">{{ \Carbon::parse($loan->date_disburst)->format("d-m-Y") }}</b>
                                                    ប្រាក់ដើមក្នុងដៃអតិថិជន <b class="mr-4">$ {{ number_format($loan->getCollection()->sum('print_due_return')) }}</b>

                                                    <b>
                                                        @if($loan->getCollaterals()->count() > 0)
                                                        {{ $loan->getCollaterals()->first()->model }} 
                                                        {{ $loan->getCollaterals()->first()->extra }} 
                                                        {{ $loan->getCollaterals()->first()->year }} 
                                                        {{ $loan->getCollaterals()->first()->color }} 
                                                        {{ $loan->getCollaterals()->first()->iden }} 
                                                        @endif
                                                    </b>
                                                </td>
                                            </tr>
                                            <tr style="font-size: 14px">
                                                <th class="text-center" width="40px">#</th>
                                                <th class="text-center" width="100px">Schedule Date</th>
                                                <th class="text-center" width="100px">Pricipal</th>
                                                <th class="text-center" width="100px">Interest</th>
                                                <th class="text-center" width="100px">Penalty</th>
                                                <th class="text-center" width="100px">Total</th>
                                                <th class="text-center" width="100px">Late</th>
                                                <th>Other</th>
                                            </tr> 
                                            @php $flag = true; @endphp
                                            @foreach ($z as $y)
                                                <tr style="font-size: 14px">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        {{ \Carbon::parse($y->getSheet->date_pay)->format('D,  d/m/y') }}
                                                    </td>
                                                    <td>
                                                        $ <span class="float-right">
                                                            {{ number_format($y->getSheet->print_due) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        $ <span class="float-right">
                                                            {{ number_format($y->getSheet->inter_due) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        $ <span class="float-right">
                                                            {{ number_format($y->getSheet->kok) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        $ <span class="float-right">
                                                            {{ number_format($y->getSheet->kok + $y->getSheet->inter_due + $y->getSheet->print_due) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format($y->getSheet->late) }}
                                                    </td>


                                                    @if($y->getSheet->state == 1)
                                                        
                                                        @if($y->getSheet->getPayments()->count() <= 0)  
                                                            
                                                            @if($flag)
                                                                <td rowspan="{{ $loop->count - $loop->index - ($y->getSheet->is_finish ? 1 : 0) }}" style="vertical-align: middle;">
                                                                    
                                                                    @if($y->getSheet->is_finish)    

                                                                        <span class="badge bg-gradient-olive">
                                                                            បានបង់ផ្តាច់ 
                                                                        </span>
                                                                        
                                                                        @php $payment = $y->getSheet->where('state', true)->where('is_finish', true)->orderBy('id', 'desc')->first()->getPayments; @endphp
                                                                        @if($payment != null)
                                                                        <small class="ml-2">ប្រាក់បានបង់</small> $ {{ number_format($payment->hasPaid()) }} 
                                                                        
                                                                        <span class="ml-2">
                                                                            <small>អ្នកបង់ប្រាក់</small> {{ $payment->paid_by }}
                                                                        </span>

                                                                        <span class="ml-2">
                                                                            <small>ថ្ងៃបង់ប្រាក់</small> {{ \Carbon::parse($payment->paid_date)->format("d/m/y") }}
                                                                        </span>

                                                                        <a href="{{ route('loans.invoice',$payment->id) }}" class="float-right">
                                                                            <b>បង្កាន់ដៃ</b>
                                                                        </a>
                                                                        @endif
                                                                    @else
                                                                        <span class="badge bg-gradient-maroon">
                                                                            បានរំលស់ដើម 
                                                                        </span>      
                                                                    @endif
                                                                </td> 
                                                                @php $flag = false; @endphp
                                                            @endif
                                                        @else
                                                        <td> 
                                                            <span class="badge bg-gradient-success">
                                                                បានបង់
                                                            </span>
                                                            <small class="ml-2">ប្រាក់បានបង់</small> $ {{ number_format($y->getSheet->getPayments->hasPaid()) }} 
                                                            
                                                            <span class="ml-2">
                                                                <small>អ្នកបង់ប្រាក់</small> {{ $y->getSheet->getPayments->paid_by }}
                                                            </span>

                                                            <span class="ml-2">
                                                                <small>ថ្ងៃបង់ប្រាក់</small> {{ \Carbon::parse($y->getSheet->getPayments->paid_date)->format("d/m/y") }}
                                                            </span>

                                                            @if($y->getSheet->getPayments()->count() > 0)              
                                                                <a href="{{ route('loans.invoice', $y->getSheet->getPayments->id) }}" class="float-right">
                                                                    <b>បង្កាន់ដៃ</b>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        @endif
                                                                   
                                                    @elseif($y->getSheet->state == 0)
                                                        <td>
                                                            <span class="badge bg-gradient-danger">
                                                                មិនទាន់
                                                            </span>
                                                            <a href="{{ route('collection.return.search.__payment', $y->getSheet->id) }}" class="float-right">
                                                                <b style="text-decoration: underline; color:red;">បង់ប្រាក់</b>
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge bg-gradient-warning">
                                                                បង់ខ្វះ
                                                            </span>

                                                            <small class="ml-2">ប្រាក់បានបង់</small> $ {{ number_format($y->getSheet->getPayments->hasPaid()) }} 
                                                                
                                                            <span class="ml-2">
                                                                <small>អ្នកបង់ប្រាក់</small> {{ $y->getSheet->getPayments->paid_by }}
                                                            </span>

                                                            <span class="ml-2">
                                                                <small>ថ្ងៃបង់ប្រាក់</small> {{ \Carbon::parse($y->getSheet->getPayments->paid_date)->format("d/m/y") }}
                                                            </span>
                                                            @if($y->getSheet->getPayments()->count() > 0)              
                                                                <a href="{{ route('loans.invoice', $y->getSheet->getPayments->id) }}" class="float-right">
                                                                    <b>បង្កាន់ដៃ</b>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    @endif                                          
                                                </tr> 
                                            @endforeach  
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