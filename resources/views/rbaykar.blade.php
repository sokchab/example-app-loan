@extends('layouts.app')
@section('title', 'Financial')
@section('bank.open', 'menu-open')
@section('bank.active', 'active')
@section('cash.transection', 'active')
@section('content')
    <div class="content-wrapper print_white">
        <!-- Content Header (Page header) -->
        <section class="content-header print_white">
            <div class="container-fluid print_white">
                <div class="row1">
                    របាយការណ៍ទទួលប្រាក់
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
                        <div class="callout callout-info no-print">
                            <form action="{{ route('receive') }}" method="get">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="date" class="form-control" value="{{ request('from') }}" name="from" id="from">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" class="form-control" value="{{ request('to') }}" name="to" id="to">
                                    </div>

                                    <div class="col-6 text-left">
                                        <button type="submit" class="btn bg-gradient-danger">
                                            <i class="fas fa-filter mr-2"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3" style="color: black;">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="pb-3">
                                        <i class="fas fa-globe"></i> ហាងលក់ម៉ូតូ ហាក់ ប៊ុនជា
                                        <small class="float-right">
                                            របាយការណ៍ទទួលប្រាក់
                                        </small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <small class="mr-2">From : </small>  
                                        {{ \Carbon\Carbon::parse(request('from'))->format('d/m/Y') }}
                                    <small class="ml-5 mr-2">To : </small>  
                                        {{ \Carbon\Carbon::parse(request('to'))->format('d/m/Y') }}
                                </div>

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            {{-- @dd($payment) --}}
                            {{-- @php
                                $collection = $payments->groupBy(function($item) {
                                    return $item->user_id;
                                });
                            @endphp --}}
                            <!-- Table row -->
                            {{-- @dd($collections) --}}
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table mr__cus table-bordered border-black">
                                        <tbody>
                                            @foreach ($collections as $em => $rows)  
                                                <tr>
                                                    <td colspan="9">
                                                        <span class="mr-4">
                                                            <i class="fas fa-user mr-2"></i>អ្នកទទួលប្រាក់
                                                        </span> 
                                                        <b>
                                                            {{ $em }}
                                                        </b>
                                                    </td>
                                                </tr>
                                            
                                                <tr class="d-print__cus" style="font-size: 14px">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">កាលបរិច្ឆេទ</th>
                                                    <th class="text-center">ប្រាក់ដើមបានបង់</th>
                                                    <th class="text-center">ការប្រាក់បានបង់</th>
                                                    <th class="text-center">ប្រាក់ពិន័យបានបង់</th>
                                                    <th class="text-center">សរុបប្រាក់បានបង់</th>
                                                    <th class="text-center">អ្នកបង់ប្រាក់</th>
                                                    <th class="text-center">កូដបង្កាន់ដៃ</th>
                                                    <th class="text-center">ផ្សេងៗ</th>
                                                </tr>
                                                @foreach ($rows as $it)
                                                    <tr style="font-size: 14px">
                                                        <td class="text-center">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ \Carbon\Carbon::parse($it->paid_date)->format('d/m/Y') }}
                                                        </td>
                                                        <td>$
                                                            <span class="float-right">
                                                                {{ number_format($it->Principal) }}
                                                            </span>
                                                        </td>
                                                        <td>$
                                                            <span class="float-right">
                                                                {{ number_format($it->Interest) }}
                                                            </span>
                                                        </td>
                                                        <td>$
                                                            <span class="float-right">
                                                                {{ number_format($it->Penalty) }}
                                                            </span>
                                                        </td>
                                                        <td>$
                                                            <span class="float-right">
                                                                {{ number_format($it->hasPaid()) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $it->paid_by }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('loans.invoice', $it->id) }}">
                                                                {{  $it->withDate(). str_pad($it->getNest->votes, 5, "0", STR_PAD_LEFT)  }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{ $it->other }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        Total
                                                    </td>
                                                    <td>$
                                                        <b class="float-right">
                                                            {{ number_format($rows->sum("Principal")) }}
                                                        </b>
                                                    </td>
                                                    <td>$
                                                        <b class="float-right">
                                                            {{ number_format($rows->sum("Interest")) }}
                                                        </b>
                                                    </td>
                                                    <td>$
                                                        <b class="float-right">
                                                            {{ number_format($rows->sum("Penalty")) }}
                                                        </b>
                                                    </td>

                                                    <td>$
                                                        <b class="float-right">
                                                            {{ number_format($rows->sum("Principal") + $rows->sum("Interest") + $rows->sum("Penalty")) }}
                                                        </b>
                                                    </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.invoice -->
                    </div>
                </div>        
            </div>
        </section>
        
    </div>
@endsection
@section('css')
    <style>
    
        @media print {
            
            .page-break	{ 
                display: block; 
                page-break-before: always; 
            }
            .print_white{
                background-color: white !important;
            }
            
        }
    </style>
@endsection