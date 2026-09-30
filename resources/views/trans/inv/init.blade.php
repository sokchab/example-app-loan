@extends('layouts.app')
@section('title','Schedule')
@section('loans', 'active')
@section('content')
    <div class="content-wrapper print_white">
        <!-- Content Header (Page header) -->
        <section class="content-header print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="{{ route('loans.index') }}" class="btn bg-gradient-primary btn-sm">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>
                        <button onclick="window.print()" class="btn bg-gradient-olive btn-sm">
                            <i class="fas fa-print mr-1"></i> Print
                        </button>
                    </div>
                    <div class="col-sm-8">
                        <div class="float-sm-right">
                            <a href="{{ route('loans.schedule', $data->id) }}"​ 
                                class="{{ request('option') == null ? 'a-active' : '' }}">
                                ទាំងអស់
                            </a>

                            <a href="{{ route('loans.schedule', [$data->id, 'option' => 'schedule']) }}"​ 
                                class="ml-2 {{ request('option') == 'schedule' ? 'a-active' : '' }}">
                                តារាងសងប្រាក់
                            </a>

                            <a href="{{ route('loans.schedule', [$data->id, 'option' => 'agreement']) }}"​ 
                                class="ml-2 {{ request('option') == 'agreement' ? 'a-active' : '' }}">
                                កិច្ចសន្យា
                            </a>

                            <a href="{{ route('loans.schedule', [$data->id, 'option' => 'rent']) }}"​ 
                                class="ml-2 {{ request('option') == 'rent' ? 'a-active' : '' }}">
                                លិខិតជួល
                            </a>

                            <a href="{{ route('loans.schedule', [$data->id, 'option' => 'buy']) }}"​ 
                                class="ml-2 {{ request('option') == 'buy' ? 'a-active' : '' }}">
                                លិខិតទិញលក់
                            </a>

                            {{-- <a href="{{ route('loans.schedule', [$data->id, 'option' => 'payment']) }}"​ 
                                class="ml-2 {{ request('option') == 'payment' ? 'a-active' : '' }}">
                                បង្កាន់ដៃប្រគល់ប្រាក់
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        @if (request('option') == 'schedule')

            @include('trans.inv.print.schedule')

        @elseif(request('option') == 'agreement')

            @include('trans.inv.print.contract')

        @elseif(request('option') == 'rent')

            @include('trans.inv.print.rent')

        @elseif(request('option') == 'buy')

            @include('trans.inv.print.buy')

        {{-- @elseif(request('option') == 'payment')
            @include('trans.inv.print.payment') --}}
        @else
            @include('trans.inv.print.schedule')
            <!-- /.content -->
            @include('trans.inv.print.contract')

            @include('trans.inv.print.rent')

            @include('trans.inv.print.buy')

            {{-- @include('trans.inv.print.payment') --}}
        @endif
        
    </div>
@endsection
@section('css')
    <style>
         
        .sign-m{
            margin-top: 130px;
        }
        .text-18{
            font-size: 18px;
        }
        .mrl{
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }
        .un-line{
            text-decoration: underline;
        }
        .line-h{
            line-height: 1.7em;
        }
        .f_17{
            font-size: 16.5px;
        }
        .for-print-a4{
            max-width: 269mm;
            margin: 0 auto;
        }
        .a-active{
            text-decoration: underline;
            font-weight: bold;
        }

        .f_22px{
            font-size: 24px;
        }

        .image_logo{
            position: absolute;
            left: 5%;
        }

        .ptls{
            width: 100% !important;
        }

        @media print {
            /* @page {
                size: A4 portrait; 
            } */
            .page-break	{ 
                display: block; 
                page-break-before: always; 
            }
            .print_white{
                background-color: white !important;
            }
            .node-dsm{
                text-decoration: none !important;
            }
            .sxh{
                border-top: 1px dotted #000 !important;
            }
        }
    </style>
@endsection