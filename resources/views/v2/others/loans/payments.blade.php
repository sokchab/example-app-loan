@extends("layouts.app")
@section('title', 'V2.Loans')

@section('v2.other.loans', 'active')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('v2.others.loan.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-primary">បង់ប្រាក់កម្ចី</li>
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
                            <div class="card-header">
                                <h3 class="card-title">
                                    បង់ប្រាក់កម្ចី
                                </h3>
                            </div>
                            <form method="POST" action="{{ route("v2.others.loan.payment", $cus->key) }}" class="card-body" id="payForm">
                                @csrf
                                <input type="hidden" name="key" value="{{ old('key', $cus->key) }}">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">ឈ្មោះអ្នកខ្ចី</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $cus->name) }}" readonly
                                                   id="name" name="name"  placeholder="name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="gender">ភេទ</label>
                                            <input class="form-control"
                                                   value="{{ old('gender', $cus->gender) ? "F" : "M" }}"
                                                   name="gender" id="gender" readonly type="text">
                                            @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="dob">ថ្ងៃខែឆ្នាំកំណើត</label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                   value="{{ old('dob', $cus->dob) }}" readonly
                                                   id="dob" name="dob"  placeholder="dob">
                                            @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="phone">លេខទូរសព្ទ</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone', $cus->phone) }}" readonly
                                                   id="phone" name="phone"  placeholder="phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="amount">ទំហំប្រាក់កម្ចី</label>
                                            <input type="text" class="form-control @error('amount') is-invalid @enderror"
                                                   value="{{ old('amount', $cus->amount) }} , (នៅសល់ {{ $payment_amount }})" readonly
                                                   id="amount" name="amount"  placeholder="amount">
                                            @error('amount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="created_at">ថ្ងៃខ្ចីប្រាក់</label>
                                            <input type="date" class="form-control @error('created_at') is-invalid @enderror"
                                                   value="{{ old('created_at', $cus->created_at->format('Y-m-d')) }}" readonly
                                                   id="created_at" name="created_at"  placeholder="created_at">
                                            @error('created_at')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="payment_date">ថ្ងៃបង់ប្រាក់សង</label>
                                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                                                   value="{{ old('payment_date', $cus->payment_date) }}" readonly
                                                   id="payment_date" name="payment_date"  placeholder="PaymentDate">
                                            @error('payment_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if($cus->status == 0)

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="payment_amount">សរុបប្រាក់ត្រូវសង</label>
                                            <input type="number" class="form-control @error('payment_amount') is-invalid @enderror"
                                                   value="{{ old('payment_amount', $payment_amount) }}" min="0" step="any"
                                                   id="payment_amount" name="payment_amount"  placeholder="payment Amount">
                                            @error('payment_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="new_payment_date">ថ្ងៃសងប្រាក់បន្ទាប់</label>
                                            <input type="date" class="form-control @error('new_payment_date') is-invalid @enderror"
                                                   value="{{ old('new_payment_date', $new_payment_date) }}"
                                                   id="new_payment_date" name="new_payment_date"  placeholder="payment Date">
                                            @error('new_payment_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="paid_by">អ្នកបង់ប្រាក់</label>
                                                <input type="text" class="form-control @error('paid_by') is-invalid @enderror"
                                                       value="{{ old('paid_by', $cus->name) }}"
                                                       id="paid_by" name="paid_by"  placeholder="paid by">
                                                @error('paid_by')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-sm btn-success float-right" id="btnSubForm">
                                            <i class="fas fa-save mr-1"></i> Submit
                                        </button>
                                    </div>

                                    @endif
                                </div>
                            </form>

                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    ប្រវត្តិបង់ប្រាក់
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>អ្នកបង់ប្រាក់</th>
                                            <th>ថ្ងៃបង់ប្រាក់</th>
                                            <th>ប្រាក់បានបង់</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cus->payments as $pay)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $pay->paid_by }}</td>
                                            <td>
                                               {{ \Carbon::parse($pay->created_at)->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                <span class="text-bold text-danger">{{ number_format($pay->amount) }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    </style>
@endsection


@section('js')
    <script>
        $(function () {
            @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
            @endif

            $("#payForm").submit(function () {
                // prevent duplicate form submissions
                $("#btnSubForm").attr('disabled', 'disabled');
            });
        });
    </script>
@endsection
