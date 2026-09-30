@extends('layouts.app')
@section('title','Loans')
@section('loans', 'active')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route("loans.index") }}">
                            <i class="fas fa-reply mr-2"></i> ត្រឡប់ក្រោយ
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <ol class="breadcrumb float-sm-right __kh__">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('loans.schedule', $lns->id ) }}" class="btn bg-gradient-dark btn-sm">
                                        <i class="fas fa-print"></i> Print
                                    </a>
                                </li>
                            </ol>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    @include("trans.loans.edits.person")
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @include("trans.loans.edits.things")
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @include("trans.loans.edits.money")
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            @if (Session::has('message'))
                toastr.success('{{ Session::get('message') }}');
            @endif



        });


        function paymentCal(){
            let balance = $('#loan__balance').val();
            let rate = $('#loan__interest_rate').val();
            let ratePer = $('#loan__rate_per').val();
            let term = $('#loan__term').val();
            let result = 0;
            if(term > 0){
                result =  Math.ceil(balance/term) + Math.ceil(balance * (rate/100) * ratePer);
            }
            $('#loan__amount_pay').val(result);
        }

        function culLoan(){
            let book = $('#loan__booking').val();
            let price = $('#loan__amount_price').val();
            $('#loan__balance').val(price-book);

            paymentCal();
        }
    </script>
@endsection
