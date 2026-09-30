@extends("layouts.app")
@section('title', 'V2.Others')
{{-- @section('bank.open', 'menu-open')
@section('bank.active', 'active') --}}
@section('v2.other', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('v2.another.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-primary">កម្ចីដៃគូរ</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <form method="POST" action="{{ route('v2.another.create') }}" class="card-body">    
                                @csrf
                                <input type="hidden" name="id" value="{{ old('id', $cus->id) }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="accNo">លេខគណនី</label>
                                            <input type="text" class="form-control @error('accNo') is-invalid @enderror" 
                                                value="{{ old('accNo', $cus->acc_no) }}"
                                                id="accNo" name="accNo"  placeholder="accNo">
                                            @error('accNo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cusName">ឈ្មោះអតិថិជន</label>
                                            <input type="text" class="form-control @error('cusName') is-invalid @enderror" 
                                                value="{{ old('cusName', $cus->cus_name) }}"
                                                id="cusName" name="cusName"  placeholder="cusName">
                                            @error('cusName')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cusPhone">លេខទូរសព្ទ</label>
                                            <input type="text" class="form-control @error('cusPhone') is-invalid @enderror" 
                                                value="{{ old('cusPhone', $cus->cus_phone) }}"
                                                id="cusPhone" name="cusPhone"  placeholder="cusPhone">
                                            @error('cusPhone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cusPhone">ប្រាក់សរុបត្រូវបង់</label>
                                            <input type="number" class="form-control @error('monthlyPayment') is-invalid @enderror" 
                                                min="0" step="any" value="{{ old('monthlyPayment', $cus->amount_pay) }}"
                                                id="monthlyPayment" name="monthlyPayment"  placeholder="monthlyPayment">
                                            @error('monthlyPayment')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cMFI">C.MFI</label>
                                            <input type="text" class="form-control @error('cMFI') is-invalid @enderror" 
                                                value="{{ old('cMFI', $cus->c_mfi) }}"
                                                id="cMFI" name="cMFI"  placeholder="cMFI">
                                            @error('cMFI')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="others">ផ្សេងៗ</label>
                                            <input type="text" class="form-control @error('others') is-invalid @enderror" 
                                                value="{{ old('others', $cus->others) }}"
                                                id="others" name="others"  placeholder="others">
                                            @error('others')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="loanTerm">រយៈពេលបង់រំលស់</label>
                                            <input type="number" class="form-control @error('loanTerm') is-invalid @enderror" 
                                                value="{{ old('loanTerm', $cus->ln_term) }}" min="0" step="any"
                                                id="loanTerm" name="loanTerm"  placeholder="loanTerm">
                                            @error('loanTerm')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="interestRate">ការប្រាក់/ខែ</label>
                                            <input type="number" class="form-control @error('interestRate') is-invalid @enderror" 
                                                value="{{ old('interestRate', $cus->ln_rate) }}" min="0" step="any"
                                                id="interestRate" name="interestRate"  placeholder="interestRate">
                                            @error('interestRate')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="firsPaymentDate">ថ្ងៃបង់ប្រាក់ដំបូង</label>
                                            <input type="date" class="form-control @error('firsPaymentDate') is-invalid @enderror" 
                                                value="{{ old('firsPaymentDate', $cus->first_pay_date) }}"
                                                id="firsPaymentDate" name="firsPaymentDate"  placeholder="firsPaymentDate">
                                            @error('firsPaymentDate')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="endPaymentDate">ថ្ងៃបញ្ចប់កម្ចី</label>
                                            <input type="date" class="form-control @error('endPaymentDate') is-invalid @enderror" 
                                                value="{{ old('endPaymentDate', $cus->end_pay_date) }}"
                                                id="endPaymentDate" name="endPaymentDate"  placeholder="endPaymentDate">
                                            @error('endPaymentDate')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="status">ស្ថានភាព</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="0" {{ old('status', $cus->status) == 0 ? 'selected' : '' }}>មិនទាន់បង់ចប់</option>
                                                <option value="1" {{ old('status', $cus->status) == 1 ? 'selected' : '' }}>បានបង់ចប់</option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary float-right">
                                            <i class="fas fa-save mr-1"></i> រក្សាទុក
                                        </button>
                                    </div>
                                    
                                </div>
                            </form> 
                          
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
</style>
@endsection


@section('js')
<script>
    $(function () {
        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
