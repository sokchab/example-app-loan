@extends("layouts.app")
@section('title', 'Financial | Report')
@section('bank.open', 'menu-open')
@section('bank.active', 'active')
@section('cash.in.bank', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route("bank.index") }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-reply mr-2"></i> Back
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('bank.index') }}">Financial</a></li>
                            <li class="breadcrumb-item active">Cash Flow</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info no-print">
                            <form action="{{ route("bank.report.flows_by_day") }}" method="get">

                                <div class="row">
                                    <div class="col-3">
                                        <input type="date" class="form-control"
                                               value="{{ old('filter', $filter) }}"
                                               name="filter" id="filter">
                                    </div>

                                    <div class="col-9 text-left">
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-filter mr-2"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Main content -->
                        <div class="invoice p-3" style="color: black;">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="pb-3">
                                        <i class="fas fa-globe"></i> ហាងលក់ម៉ូតូ ហាក់ ប៊ុនជា
                                        <small class="float-right">{{ \Carbon\Carbon::create($filter)->format('l d-M-Y') }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <small>Print Date</small>  {{ \Carbon\Carbon::now()->format('d-M-Y - h:i A') }}
                                    <small class="ml-3">Page {{ $data->currentPage() }} of {{ $data->lastPage() }}</small>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table mr__cus table-bordered border-black">
                                        <tbody>
                                        <tr class="d-print__cus">
                                            <th class="text-center">#</th>
                                            <th width="180px" class="text-center">Date</th>
                                            <th width="150px" class="text-center">In Flow</th>
                                            <th width="150px" class="text-center">Out Flow</th>
                                            <th class="text-center">Description</th>
                                            <th width="150px" class="text-center">Other</th>
                                        </tr>

                                        @foreach($data as $d)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                    {{-- $loop->iteration+$data->perPage()*($data->currentPage()-1) --}}
                                                </td>
                                                <td>{{ $d->created_at->format('d-M-Y - h:i A') }}</td>
                                                <td>$
                                                    <span class="float-right">{{ number_format($d->in_flow,2) }}</span>
                                                </td>
                                                <td>$
                                                    <span class="float-right">{{ number_format($d->out_flow,2) }}</span>
                                                </td>
                                                <td>{{ $d->dsc }}</td>
                                                <td></td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-sm-6">
                                    <p class="lead mb-1">Summery</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered border-black">
                                            <tbody>
                                            <tr>
                                                <th>Deposit</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($deposit , 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Withdrawal</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($withdrawal, 2) }}
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th width="50%">Disbursement</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($disbursement, 2) }}
                                                    </span>
                                                </td>
                                            </tr>

                                            {{-- <tr>
                                                <th>Collection</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($collection, 2) }}
                                                    </span>
                                                </td>
                                            </tr> --}}

                                            {{-- <tr>
                                                <th>Loan Reject</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($loanReject, 2) }}
                                                    </span>
                                                </td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col LoanReject -->
                                <div class="col-sm-6">
                                    <p class="lead mb-1" style="color: white;">&nbsp;</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered border-black">
                                            <tbody>

                                            <tr>
                                                <th>Collection</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($collection, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="50%">Earning from Interest</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($earningInterest, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Earning from Penalty</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($earningPenalty, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td colspan="2">Lifetime</td>
                                            </tr>
                                            <tr>
                                                <th>Balance</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($balance, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Interest</th>
                                                <td>$
                                                    <span class="float-right">
                                                        {{ number_format($interest, 2) }}
                                                    </span>
                                                </td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->


                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <p class="lead mb-1">Lifetime</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered border-black">
                                            <tbody>                                     
                                            <tr>
                                                <th>Principal</th>
                                                <td>$
                                                    <span class="float-right">{{ number_format($balance,2) }}</span>
                                                </td>
                                            </tr>
                                            <tr>                                                
                                                <th>Interest</th>
                                                <td>$
                                                    <span class="float-right">{{ number_format($interest,2) }}</span>
                                                </td>
                                            </tr>

                                            <tr>                                                
                                                <th>Penalty</th>
                                                <td>$
                                                    <span class="float-right">{{ number_format($Penalty,2) }}</span>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <p class="lead mb-1" style="color: white;">&nbsp;</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered border-black">
                                            <tbody>

                                            <tr>
                                            
                                                <th>Disbursement</th>
                                                <td>$
                                                    <span class="float-right">{{ number_format($DisbursementAll,2) }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                
                                                <th>Outstanding</th>
                                                <td>$
                                                    <span class="float-right">{{ number_format($Outstandings,2) }}</span>
                                                </td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                            </div>
                            <!-- /.row -->
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-sm-8">
                                    {{ $data->appends(["filter" => old('filter', $filter)])->links() }}
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-dark float-right" onclick="window.print()"><i class="fas fa-print mr-2"></i> Print</button>
                                    <a href="{{ route("bank.exports.by.day", $filter) }}" class="btn btn-default float-right mr-2">
                                        <i class="fas fa-file-excel mr-2"></i> Export Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
{{--
@section('css')
    <style type="text/css">

        @media print {
            th div, td div {
                margin-top:-8px;
                padding-top:8px;
                page-break-inside:avoid;
            }

            @page {
                /*size: A4 portrait;*/
            }
        }
    </style>
@endsection
--}}

@section('css')
<style type="text/css">

    @media print {
        .print_white{
            background-color: white !important;
        }
    }
</style>
@endsection
