@extends("layouts.app")
@section('title', 'Financial')
@section('bank.open', 'menu-open')
@section('bank.active', 'active')
@section('cash.in.install', 'active')



@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <span>Bank</span>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Bank</li>
                            <li class="breadcrumb-item active text-primary">Installment</li>
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Cash Flow</h3>
                            </div>
                            <form role="form" method="post" action="{{ route('bank.install.submit') }}"> @csrf
                                <div class="card-body" style="height: 238px !important;">
                                    <div class="form-group">
                                        <label for="cash__amount">Amount</label>
                                        <input type="number" min="0" step="0.1" name="cash__amount"
                                               value="{{ old('cash__amount') }}"
                                               class="form-control" id="cash__amount" placeholder="Enter ...">
                                        @error('cash__amount')
                                        <label for="cash__amount" class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input"
                                                   value="1"
                                                   type="radio" id="customRadio1" name="cash__status"
                                                    {{ old('cash__status', 1)==1 ? 'checked' : '' }}>
                                            <label for="customRadio1" class="custom-control-label">Deposit</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input"
                                                   value="2"
                                                   type="radio" id="customRadio2" name="cash__status"
                                                    {{ old('cash__status')==2 ? 'checked' : '' }}>
                                            <label for="customRadio2" class="custom-control-label">Withdrawal</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Financial</h3>
                            </div>
                            <div class="card-body" style="height: 300px !important;">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-success text-lg">
                                        <i class="fas fa-dollar-sign"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold text-lg">
                                      <i class="ion ion-android-arrow-up text-success mr-2"></i> {{ number_format($data->first()->bank_principle,2) }} $
                                    </span>
                                        <span class="text-muted">Capital Equity</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="text-warning text-lg">
                                        <i class="fas fa-dollar-sign"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right text-lg">
                                    <span class="font-weight-bold">
                                      <i class="ion ion-android-arrow-up text-warning mr-2"></i> {{ number_format($data->first()->bank_interest,2) }} $
                                    </span>
                                        <span class="text-muted">Interest Revenue</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
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
</style>
@endsection
