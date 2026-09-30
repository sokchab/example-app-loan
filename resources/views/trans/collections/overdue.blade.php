@extends("layouts.app")

@section('title', 'Overdue')

@section('loans.overdue', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <button class="btn btn-outline-dark btn-sm" onclick="window.print()"><i class="fas fa-print mr-1"></i> Print</button>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Loan</li>
                            <li class="breadcrumb-item active text-primary">Overdue</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('public/template/images/hb-logo.svg') }}" 
                                            width="40px" class="mr-2"
                                            alt="logo"> 
                                        <b>ហាងលក់ម៉ូតូ  ហាក់ ប៊ុនជា</b>
                                        <span class="float-right">អតិថិជនយឺត</span>
                                    </div>
                                </div>
                                <small class="float-right">Print: {{ \Carbon\Carbon::now()->format('d-M-Y h:s A') }}</small>
                                <br>
                                @foreach($css as $cs)
                                    <div class="user-block mb-1 mt-4">
                                        <span class="username ml-0">
                                            <a href="{{ route("collection.return.search.ref",$cs->id) }}">
                                                <strong class="mr-4">{{ $cs->acc_number }}</strong>
                                            </a>

                                            <small class="mr-1">Client Key</small>
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
                                            {{-- ផ្លូវលេខ {{ $cs->getClient->street }}, &nbsp; --}}
                                            ក្រុម/ផ្លូវលេខ {{ $cs->getClient->group }}, &nbsp;
                                            ភូមិ {{ $cs->getClient->getVillage->village_namekh }}, &nbsp;
                                            ឃុំ/សង្កាត់ {{ $cs->getClient->getVillage->commune->commune_namekh }}, &nbsp;
                                            ស្រុក/ខណ្ឌ/ក្រុង {{ $cs->getClient->getVillage->commune->district->district_namekh }}, &nbsp;
                                            ខេត្ត/រាជធានី {{ $cs->getClient->getVillage->commune->district->province->province_kh_name }}
                                            <b class="ml-4">
                                                @php
                                                    $cols = $cs->getCollaterals;
                                                @endphp
                                                @if($cols->count() > 0)
                                                {{ $cols->first()->model }} 
                                                {{ $cols->first()->extra }} 
                                                {{ $cols->first()->year }} 
                                                {{ $cols->first()->color }} 
                                                {{ $cols->first()->iden }}
                                                @endif
                                            </b>
                                        </span>
                                    </div>

                                    <table class="table table-hover table-bordered border-black">
                                    <tbody>
                                    <tr class="mr__cus" style="font-size: 14px">
                                        <th class="text-center" width="40px">#</th>
                                        {{-- <th class="text-center">លេខគណនី</th>--}}
                                        {{-- <th class="text-center">ឈ្មោះអតិថិជន</th>--}}
                                        <th class="text-center" width="120px">Date</th>
                                        <th class="text-center" width="110px">Total</th>
                                        <th class="text-center" width="120px">Principal Due</th>
                                        <th class="text-center" width="120px">Interest Due</th>
                                        <th class="text-center" width="145px">Balance</th>
                                        <th class="text-center" width="110px">Penalty</th>
                                        <th class="text-center" width="110px">Late</th>
                                        <th class="text-center" width="110px">Other</th>
                                    </tr>
                                    @foreach( \Hel::overdues($cs->id) as $r)
                                    <tr class="mr__cus" style="font-size: 14px">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $r->getLoan->acc_number }}</td>--}}
                                        {{-- <td>{{ $r->getLoan->getClient->name }}</td>--}}
                                        <td class="text-center">
                                            <span>{{ \Carbon\Carbon::parse($r->date_pay)->format('d-m-Y') }}</span>
                                        </td>
                                        <td class="text-center">$ {{ number_format($r->amount) }}</td>
                                        <td class="text-center">$ {{ number_format($r->print_due_return) }}</td>
                                        <td class="text-center">$ {{ number_format($r->inter_due_return) }}</td>
                                        <td class="text-center">$ {{ number_format($r->balance) }}</td>
                                        <td class="text-center">$ {{ number_format($r->fee) }}</td>
                                        <td class="text-center">{{ $r->late }}</td>
                                        <td class="text-center">
                                            {{
                                                \Carbon\Carbon::parse($r->date_pay)->diffForHumans()
                                            }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endforeach
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
        @media print {
            .print_white{
                background-color: white !important;
            }
        } 
        /* @media print {
           @page {size: A4 landscape; }
        } */

        /*.mr__cus td,*/
        /*.mr__cus th{*/
        /*    padding-bottom: 8px !important;*/
        /*    padding-top: 8px !important;*/
        /*}*/
    </style>
@endsection
