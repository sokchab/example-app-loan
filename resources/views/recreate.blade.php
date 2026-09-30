@extends('layouts.app')
@section('title','Loans')
@section('loans.collection.return', 'active')    
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route("collection.return", [ "op" => "loan" ]) }}"
                        class="btn bg-gradient-olive btn-sm">
                        <i class="fas fa-reply mr-1"></i> ត្រឡប់ក្រោយ
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><span>កម្ចី</span></li>
                        <li class="breadcrumb-item active"><span>រំលស់ប្រាក់ដើម</span></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('re.store', $d->id) }}" class="prevent-submits" method="post">
                    @csrf     
                    <input type="hidden" name="_flag_recreate" value="{{ $n }}">                  
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">រំលស់ប្រាក់ដើម</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <span>គណនី: <br>
                                        <b>
                                            {{ $d->acc_number }}
                                        </b>
                                    </span>
                                </div>
                    
                                <div class="col-sm-4">
                                    <span>អតិថិជន: <br>
                                        <b>
                                            {{ $d->getClient->fullName() }}
                                        </b>
                                    </span>
                                </div>

                                <div class="col-sm-4">
                                    <span>សមតុល្យប្រាក់ដើម: <br>
                                        <b>
                                            {{ number_format($d->getCollection->sum('print_due_return'), 2) }} $
                                        </b>
                                    </span>
                                </div>
                            </div>
                            <hr>

                            @php
                                $date_first = $d->getCollection()
                                    ->orderBy('inter_due_return', 'desc')
                                    ->where('state', false)
                                    ->first()->date_pay;                                      
                                $val = $d->getCollection()->where('state', false)
                                    ->where('date_pay', '<=', \Carbon\Carbon::parse($date_first));
                                $inter = $val->sum('inter_due_return');
                                $prin = $val->sum('print_due_return');
                                    
                                $first_paid = $d->getCollection->max('amount') - $d->getCollection->max('inter_due_return');
                            @endphp
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="principal">ប្រាក់ដើមត្រូវបង់ ($)  *</label>
                                        <input type="number" class="form-control " 
                                            id="principal" 
                                            name="principal" 
                                            min="0" 
                                            value="{{ old('principal', $prin) }}"
                                            step="any"  
                                            placeholder="Enter ..." required readonly>

                                            @error('principal')
                                                <label class="col-form-label text-danger" for="principal">
                                                    <i class="far fa-times-circle"></i> {{ $message }}
                                                </label>
                                            @enderror
                                    </div>
                                </div>

                               

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="interest">ការប្រាក់ត្រូវបង់ ($)  *</label>
                                        <input type="number" 
                                            class="form-control " 
                                            id="interest" 
                                            name="interest" min="0" 
                                            step="any" 
                                            value="{{ old('interest', $inter) }}" 
                                            placeholder="Enter ..." required readonly>

                                            @error('interest')
                                            <label class="col-form-label text-danger" for="interest">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="penalty">ប្រាក់ពិន័យ ($)  *</label>
                                        <input type="number" class="form-control " 
                                            id="penalty" 
                                            name="penalty" 
                                            min="0" 
                                            step="any" 
                                            value="{{ old('penalty', $d->getCollection()->where('state', false)->max('fee')) }}" 
                                            placeholder="Enter ..." required>

                                            @error('penalty')
                                            <label class="col-form-label text-danger" for="penalty">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="late">ចំនួនថ្ងៃយឺត</label>
                                        <input type="number" class="form-control" 
                                            id="late" name="late" 
                                            value="{{ $d->getCollection()->where('state', false)->max('late') }}" 
                                            placeholder="Enter ..." readonly>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="Depreciation">ប្រាក់ដើមស្នើររំលស់ ($)  *</label>
                                        <input type="number" class="form-control " 
                                            id="Depreciation" 
                                            name="Depreciation" 
                                            min="0" 
                                            step="any" 
                                            value="{{ old('Depreciation', 300) }}" 
                                            placeholder="Enter ..." required>

                                            @error('Depreciation')
                                            <label class="col-form-label text-danger" for="Depreciation">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="paid_date">ថ្ងៃបង់ប្រាក់ * <small>(mm/dd/yyyy)</small></label>
                                        <input type="date" name="paid_date" id="paid_date"
                                            class="form-control "
                                            value="{{ old('paid_date', now()->toDateString()) }}"
                                            placeholder="Enter ..." required>

                                            @error('paid_date')
                                            <label class="col-form-label text-danger" for="paid_date">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pay_day">ថ្ងៃបង់ប្រាក់ដំបូង * <small>(mm/dd/yyyy)</small></label>
                                        <input type="date" name="pay_day" id="pay_day"
                                            class="form-control "
                                            value="{{ old('pay_day', $dd) }}"
                                            placeholder="Enter ..." required>

                                            @error('pay_day')
                                            <label class="col-form-label text-danger" for="pay_day">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="term">រយៈពេលបង់ប្រាក់ *</label>
                                        <input type="number" class="form-control" 
                                            id="term" name="term" 
                                            min="0" step="1"
                                            value="{{ old('term', $term) }}" 
                                            placeholder="Enter ..." required>

                                            @error('term')
                                            <label class="col-form-label text-danger" for="term">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>

                                @php
                                    $AmountToPay = 500 + $prin + $inter + $d->getCollection()->where('state', false)->max('fee');
                                @endphp

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="AmountToPay">សរុបប្រាក់ត្រូវបង់ ($)  *</label>
                                        <input type="number" class="form-control " 
                                            id="AmountToPay" 
                                            name="AmountToPay" 
                                            min="500" 
                                            step="1" 
                                            value="{{ old('AmountToPay', $AmountToPay) }}" 
                                            placeholder="Enter ..." required readonly>

                                            @error('AmountToPay')
                                            <label class="col-form-label text-danger" for="AmountToPay">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>


                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for="others">ផ្សេងៗ</label>
                                        <input type="text" class="form-control" 
                                            id="others" name="others" 
                                            value="{{ old('others') }}" 
                                            placeholder="Enter ...">

                                            @error('others')
                                            <label class="col-form-label text-danger" for="others">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="others23">អ្នកទទួលប្រាក់ (បេឡា)</label>
                                        <input type="text" class="form-control" 
                                            id="others23" name="others23" 
                                            value="{{ old('others23', auth()->user()->name) }}" 
                                            placeholder="Enter ..." readonly>

                                            @error('others23')
                                            <label class="col-form-label text-danger" for="others23">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                            @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="paid_by">អ្នកបង់ប្រាក់</label>
                                        <input type="text" class="form-control"
                                            id="paid_by" name="paid_by" 
                                            value="{{ old('paid_by', $d->getClient->fullName()) }}" 
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn bg-gradient-olive btn-prevent-submits">
                                    <i class="fas fa-save mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


@endsection


@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            let deb = $("#Depreciation");
            let pen = $("#penalty");
            let amt = $("#AmountToPay");
            let prin = $("#principal").val();
            let inte = $("#interest").val();
            //
            //
            deb.on('keyup change', function(e){
                e.preventDefault();
                //
                total = parseFloat(pen.val()) + parseFloat(prin) + parseFloat(inte) + parseFloat($(this).val());
                amt.val(total);
            });

            pen.on('keyup change', function(e){
                e.preventDefault();
                total = parseFloat(deb.val()) + parseFloat(prin) + parseFloat(inte) + parseFloat($(this).val());
                amt.val(total);
            });

            $('.prevent-submits').on('submit', function(){
                $('.btn-prevent-submits').attr('disabled', true);
            });
        });
    </script>
@endsection