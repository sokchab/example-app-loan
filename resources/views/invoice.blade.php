@extends('layouts.app')
@section('title','Invoice')
@section('loans.collection.return', 'active')
@section('content')
    <div class="content-wrapper print_white">
        <!-- Content Header (Page header) -->
        <section class="content-header print_white">
            <div class="container-fluid print_white">
                <div class="row1">
                    <a href="{{ route("collection.return.search.ref",$data->getCollection->loan) }}" 
                        class="btn bg-gradient-primary btn-sm">
                        <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                    </a>
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

                        <div class="invoice p-3 mb-3 line-h">
                            @include('sub_invoice')
                        </div>
                       
                       
                        <div class="invoice p-3 mb-3 line-h sxh">
                            @include('sub_invoice')
                        </div>
        
                        
                    </div>   
                </div>        
            </div>
        </section>
        
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
            padding-left: 5% !important;
            padding-right: 5% !important;
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
                border-top: .5px dashed #000 !important;
            }
        }
    </style>
@endsection