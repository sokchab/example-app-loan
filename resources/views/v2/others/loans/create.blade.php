@extends("layouts.app")
@section('title', 'V2.Loans')

@section('v2.other.loans', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('v2.others.loan.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>

                        <a href="{{ route('v2.others.loan.clients') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-user mr-1"></i>ជ្រើសពីអតិថិជន
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-primary">កម្ចីផ្សេងៗ</li>
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
                            <form method="POST" action="{{ route('v2.others.loan.create') }}" class="card-body">    
                                @csrf
                                <input type="hidden" name="key" value="{{ old('key', $cus->key) }}">
                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name">ឈ្មោះអ្នកខ្ចី</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                value="{{ old('name', $cus->name) }}"
                                                id="name" name="name"  placeholder="name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="gender">ភេទ</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="0" {{ old('gender', $cus->gender) == 0 ? 'selected' : '' }}>M</option>
                                                <option value="1" {{ old('gender', $cus->gender) == 1 ? 'selected' : '' }}>F</option>
                                            </select>
                                            @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="dob">ថ្ងៃខែឆ្នាំកំណើត</label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror" 
                                                value="{{ old('dob', $cus->dob) }}"
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
                                                value="{{ old('phone', $cus->phone) }}"
                                                id="phone" name="phone"  placeholder="phone">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="amount">ទំហំប្រាក់កម្ចី</label>
                                            <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                                min="0" step="any" value="{{ old('amount', $cus->amount) }}"
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
                                                value="{{ old('created_at', $cus->created_at->format('Y-m-d')) }}"
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
                                                value="{{ old('payment_date', $cus->payment_date) }}"
                                                id="payment_date" name="payment_date"  placeholder="PaymentDate">
                                            @error('payment_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description">ផ្សេងៗ</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" rows="3" 
                                                id="description" name="description"
                                                placeholder="description">{{ old('description', $cus->description) }}</textarea>
                                            
                                            @error('description')
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
