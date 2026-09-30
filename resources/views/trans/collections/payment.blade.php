@extends("layouts.app")

@section('title', 'Payment')

@section('loans.collection.return', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route("collection.return.search.ref",$data->getLoan->id) }}" 
                            class="btn bg-gradient-primary btn-sm">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">កម្ចី</li>
                            <li class="breadcrumb-item active text-primary">បង់ប្រាក់</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('collection.create.__payment', $data->id) }}" 
                            method="post" class="prevent-submits">
                            @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">បង់ប្រាក់</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <span>គណនី: <br>
                                            <b>{{ $data->getLoan->acc_number }}</b>
                                        </span>
                                    </div>
                                    {{-- <div class="col-sm-2">
                                        <span>កូដអតិថិជន: <br>
                                            <b>{{ $data->getLoan->getClient->cus_key }}</b>
                                        </span>
                                    </div> --}}
                                    <div class="col-sm-3">
                                        <span>អតិថិជន: <br>
                                            <b>{{ $data->getLoan->getClient->fullName() }}</b>
                                        </span>
                                    </div>

                                    <div class="col-sm-2">
                                        <span>សមតុល្យប្រាក់ដើម: <br>
                                            <b>{{ number_format($data->balance,2) }} $</b>
                                        </span>
                                    </div>

                                    <div class="col-sm-3">
                                        <span>កាលបរិច្ឆេទបង់ប្រាក់: <br>
                                            <b>{{ \Carbon\Carbon::parse($data->date_pay)->format('d-M-Y') }}</b>
                                        </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="principal">ប្រាក់ដើមត្រូវបង់ ($)</label>
                                            <input type="number" class="form-control @error('principal') is-invalid @enderror"
                                                   id="principal" name="principal" min="0" step="0.001"
                                                   value="{{ old('principal', $data->print_due_return) }}"
                                                   placeholder="Enter ..." readonly>

                                            @error('principal')
                                                <label for="principal" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="interest">ការប្រាក់ត្រូវបង់ ($)</label>
                                            <input type="number" class="form-control @error('interest') is-invalid @enderror"
                                                   id="interest" name="interest" min="0" step="0.001"
                                                   value="{{ old('interest', $data->inter_due_return) }}"
                                                   placeholder="Enter ..." readonly>

                                            @error('interest')
                                                <label for="interest" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="penalty">ប្រាក់ពិន័យ ($)  *
                                    
                                            </label>
                                            <input type="number" class="form-control @error('penalty') is-invalid @enderror"
                                                   id="penalty" name="penalty" min="0" step="0.001"
                                                   value="{{ old('penalty', $data->fee) }}"
                                                   placeholder="Enter ..." required>

                                            @error('penalty')
                                                <label for="penalty" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="late1">ចំនួនថ្ងៃយឺត</label>
                                            <input type="number" class="form-control"
                                                   id="late1" name="late1"
                                                   value="{{ $data->late }}"
                                                   placeholder="Enter ..." readonly>
                                        </div>
                                    </div>

                                    @php
                                        $sub_total = old('interest', $data->inter_due_return) + old('principal', $data->print_due_return);
                                    @endphp
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="late23">សរុបប្រាក់ &nbsp; +</label>
                                            <input type="number" class="form-control"
                                                   id="late23" name="late23"
                                                   value="{{ $sub_total }}"
                                                   placeholder="Enter ..." readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="late3">ប្រាក់ពិន័យ &nbsp; =</label>
                                            <input type="number" class="form-control"
                                                   id="late3" name="late3"
                                                   value="{{ old('penalty', $data->fee) }}"
                                                   placeholder="Enter ..." readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="late">សរុបប្រាក់ត្រូវបង់ ($)</label>
                                            <input type="number" class="form-control"
                                                   id="late" name="late"
                                                   value="{{ $data->amountToPay() }}"
                                                   placeholder="Enter ..." readonly>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="paid">ប្រាក់បានបង់ ($)  *</label>
                                            <input type="number" class="form-control @error('paid') is-invalid @enderror"
                                                   id="paid" name="paid" min="0" step="0.001"
                                                   value="{{ old('paid', $data->amountToPay()) }}"
                                                   placeholder="Enter ..." required autofocus>

                                            @error('paid')
                                                <label for="paid" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="paid_date">ថ្ងៃបង់ប្រាក់  *</label>
                                            <input type="date" class="form-control @error('paid_date') is-invalid @enderror"
                                                   id="paid_date" name="paid_date" 
                                                   value="{{ old('paid_date', now()->toDateString()) }}"
                                                   placeholder="Enter ..." required>

                                            @error('paid_date')
                                                <label for="paid_date" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="others">ផ្សេងៗ</label>
                                            <input type="text" class="form-control @error('others') is-invalid @enderror"
                                                   id="others" name="others" 
                                                   value="{{ old('others') }}"
                                                   placeholder="Enter ...">

                                            @error('others')
                                                <label for="others" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="others1">បានទទួលប្រាក់ដោយ​ (បេឡា)</label>
                                            <input type="text" class="form-control"
                                                   id="others1" name="others1" 
                                                   value="{{ auth()->user()->name }}"
                                                   placeholder="Enter ..." readonly>

                                            
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="paid_by">បង់ប្រាក់ដោយ</label>
                                            <input type="text" class="form-control @error('paid_by') is-invalid @enderror"
                                                   id="paid_by" name="paid_by" 
                                                   value="{{ old('paid_by', $data->getLoan->getClient->fullName()) }}"
                                                   placeholder="Enter ...">

                                            @error('paid_by')
                                                <label for="paid_by" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-prevent-submits"  {{ $data->state == 0 ? "" : "disabled" }}>
                                        <i class="fas fa-save mr-2"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        </form>
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

@section('js')
    <script type="text/javascript">
        $(function () {
            $("#penalty").on('keyup change', function (){
                let result = 0;
                let penalty = $(this).val();
                let principal = $('#principal').val();
                let interest = $('#interest').val();

                result = parseInt(penalty) + parseInt(principal) + parseInt(interest);
            
               $('#late').val(result);
               $('#paid').val(result);

               $('#late3').val(penalty);
               
            });

            $('.prevent-submits').on('submit', function(){
                $('.btn-prevent-submits').attr('disabled', true);
            });
        });
    </script>
@endsection