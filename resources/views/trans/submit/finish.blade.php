@extends("layouts.app")
@section('title', 'Loan Finish')
@section('loans.collection.return', 'active')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route("collection.return.search.ref",$data->id) }}"
                            class="btn bg-gradient-olive btn-sm">
                            <i class="fas fa-reply mr-1"></i> ត្រឡប់ក្រោយ
                        </a>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">កម្ចី</li>
                            <li class="breadcrumb-item active text-primary">បញ្ចប់</li>
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
                        <div class="card">
                            <div class="card-header">
                                បញ្ចប់កម្ចី
                            </div>
                            <form action="{{ route('collection.finish.payment', $data->id) }}"  
                                class="prevent-submits"
                                method="POST">
                                
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <span>គណនី:
                                                <b>{{  $data->acc_number }}</b>
                                            </span>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <span>អតិថិជន:
                                                <b>{{ $data->getClient->fullName() }}</b>
                                            </span>
                                        </div>

                                        <div class="col-sm-5">
                                            <span>កម្ចី:
                                                <b>{{ number_format($data->balance,2) }} $</b>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="principal">ប្រាក់ដើមត្រូវបង់ ($)</label>
                                                <input type="number" class="form-control " 
                                                    id="principal" 
                                                    name="principal" 
                                                    min="0" 
                                                    step="0.001" 
                                                    value="{{ $data->getCollection->sum('print_due_return') }}" 
                                                    placeholder="Enter ..." readonly>
                                            </div>
                                        </div>

                                        @php
                                            $tmp = $data->getCollection->where('state', 0)->where('date_pay', '<=', now());

                                            if($tmp->count() > 0)
                                                $int = $tmp->sum('inter_due_return');
                                            else 
                                                $int = $data->getCollection->max('inter_due_return');

                                        @endphp
                                       
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="interest">ការប្រាក់ត្រូវបង់ ($)</label>
                                                <input type="number" class="form-control " 
                                                    id="interest" 
                                                    name="interest" 
                                                    min="0" step="0.001" 
                                                    value="{{ $int }}" 
                                                    placeholder="Enter ..." readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="late">ពិន័យប្រាក់យឺត ($)  *</label>
                                                <input type="number" class="form-control " 
                                                    id="late" 
                                                    name="late" 
                                                    min="0" 
                                                    step="0.001" 
                                                    value="{{ old('late', $data->getCollection->sum('fee')) }}" 
                                                    placeholder="Enter ..." required>

                                                    @error('late')
                                                    <label class="col-form-label text-danger" for="late">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="penalty">ពិន័យបង់មុនកំណត់ ($) *</label>
                                                <input type="number" class="form-control" 
                                                    id="penalty" 
                                                    name="penalty" 
                                                    step="0.001" 
                                                    min="0"
                                                    value="{{ old('penalty', $penalty) }}" 
                                                    placeholder="Enter ..." required>

                                                    @error('penalty')
                                                    <label class="col-form-label text-danger" for="penalty">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>

                                        @php
                                        $total = $data->getCollection->max('inter_due_return') + $data->getCollection->sum('print_due_return') + $penalty + $data->getCollection->sum('fee');
                                        @endphp

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="totals">សរុបប្រាក់ត្រូវបង់ ($)</label>
                                                <input type="number" class="form-control" 
                                                    id="totals" 
                                                    name="totals" 
                                                    step="0.001" 
                                                    min="0"
                                                    value="{{ old('totals', $total) }}" 
                                                    placeholder="Enter ..." readonly required>

                                                    @error('totals')
                                                    <label class="col-form-label text-danger" for="totals">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>                       

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="paid_date">ថ្ងៃបង់ប្រាក់ *</label>
                                                <input type="date" class="form-control" 
                                                    id="paid_date" 
                                                    name="paid_date" 
                                                    
                                                    value="{{ old('paid_date', now()->toDateString()) }}" 
                                                    placeholder="Enter ..." required>

                                                    @error('paid_date')
                                                    <label class="col-form-label text-danger" for="paid_date">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="others">ផ្សេងៗ</label>
                                                <input type="text" class="form-control" 
                                                    id="others" 
                                                    name="others" 
                                                    
                                                    value="{{ old('others') }}" 
                                                    placeholder="Enter ..." >

                                                    @error('others')
                                                    <label class="col-form-label text-danger" for="others">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="other22s">អ្នកទទួលប្រាក់ (បេឡា)</label>
                                                <input type="text" class="form-control" 
                                                    id="other22s" 
                                                    name="other22s" 
                                                    
                                                    value="{{ old('other22s', auth()->user()->name) }}" 
                                                    placeholder="Enter ..." readonly>

                                                    @error('other22s')
                                                    <label class="col-form-label text-danger" for="other22s">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="paid_by">អ្នកបង់ប្រាក់</label>
                                                <input type="text" class="form-control" 
                                                    id="paid_by" 
                                                    name="paid_by" 
                                                    
                                                    value="{{ old('paid_by', $data->getClient->fullName()) }}" 
                                                    placeholder="Enter ...">

                                                    @error('paid_by')
                                                    <label class="col-form-label text-danger" for="paid_by">
                                                        <i class="far fa-times-circle"></i> {{ $message }}
                                                    </label>
                                                    @enderror
                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn bg-gradient-olive btn-prevent-submits">
                                            <i class="fas fa-save mr-1"></i>  Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
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

@section('js')
    <script type="text/javascript">
        $(function () {
            $("#penalty").on('keyup change', function (){
                let result = 0;
                let penalty = $(this).val();
                let late = $('#late').val();
                let principal = $('#principal').val();
                let interest = $('#interest').val();

                result = parseInt(late) + parseInt(penalty) + parseInt(principal) + parseInt(interest);
            
                $('#totals').val(result);
            });

            $('#late').on('keyup change', function(){
                let result = 0;
                let penalty = $('#penalty').val();
                let late = $(this).val();
                let principal = $('#principal').val();
                let interest = $('#interest').val();

                result = parseInt(late) + parseInt(penalty) + parseInt(principal) + parseInt(interest);
            
                $('#totals').val(result);
            });

            $('.prevent-submits').on('submit', function(){
                $('.btn-prevent-submits').attr('disabled', true);
            });
        });
    </script>
@endsection