@extends('layouts.app')
@section('title','Loans')

@section('loans', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('loans.index') }}" class="btn bg-gradient-primary btn-sm">
                        <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានកម្ចី</span></li>
                            <li class="breadcrumb-item active">ថ្មី</li>
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('loans.store') }}" class="prevent-submits" method="POST" id="fr_losnd"> 
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            ព័ត៌មានអតិថិជន
                            <div class="card-tools">
                                <a href="{{ route("fix.loan.client.list12") }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-user-circle mr-1"></i>អតិថិជន</a>
                                <a href="{{ route("fix.loan.join.list12") }}" class="btn btn-outline-success btn-sm"><i class="fas fa-user-circle mr-1"></i>អ្នករួមខ្ចី</a>
                                <a href="{{ route("fix.loan.CustGuaranNewReque") }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-user-circle mr-1"></i>អ្នកធានា</a>
                                <a href="{{ route("fix.loan.KOKList") }}" class="btn btn-outline-info btn-sm"><i class="fas fa-user-circle mr-1"></i>អ្នករួមធានា</a>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-0" style="min-height: 60px;">
                            {{-- <div class="mt-3 text-right mb-2">
                                
                            </div> --}}
                            <table class="table table-condensed not-top" id="table_tmp12">
                                @foreach ($data['cusTmp'] as $e)
                                    <tr>
                                        <td>
                                            @if($e->numbers == 1)
                                                <label class='text-dark mb-0'>
                                                    <i class="fas fa-user mr-2"></i>{{ $e->getClient->fullName() }}
                                                </label>
                                            @elseif($e->numbers == 2)
                                                <label class='text-dark mb-0'>
                                                    <i class="fas fa-user mr-2"></i> {{ $e->getJoin->fullName() }}
                                                </label>
                                            @elseif($e->numbers == 3)
                                                <label class='text-dark mb-0'>
                                                    <i class="fas fa-user mr-2"></i>{{ $e->getGuarantee->fullName() }}
                                                </label>
                                            @else
                                                <label class='text-dark mb-0'>
                                                    <i class="fas fa-user mr-2"></i>{{ $e->getGuaranteeJoin->fullName() }}
                                                </label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($e->numbers ==1 )
                                               
                                                <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">លេខកូដ</span>
                                                            </div>
                                                            <input type="text"
                                                                name="jx_type_cus_key"
                                                                value="{{ $e->getClient->cus_key }}"
                                                                class="form-control" placeholder="លេខកូដ" readonly>
                                                        </div>

                                            @elseif($e->numbers ==2)
                                                <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">ត្រូវជា</span>
                                                            </div>
                                                            <input type="text"
                                                                name="jx_type"
                                                                value="{{ old('jx_type', $e->extra) }}"
                                                                class="form-control" placeholder="ត្រូវជា">
                                                        </div>
                                            @elseif($e->numbers ==3)
                                                <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">ត្រូវជា</span>
                                                            </div>
                                                            <input type="text"
                                                                name="gx_type"
                                                                value="{{ old("gx_type", $e->extra) }}"
                                                                class="form-control" placeholder="ត្រូវជា">
                                                        </div>
                                            @else
                                                <div class="input-group input-group-sm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">ត្រូវជា</span>
                                                            </div>
                                                            <input type="text"
                                                                name="gxj_type"
                                                                value="{{ old("gxj_type", $e->extra) }}"
                                                                class="form-control" placeholder="ត្រូវជា">
                                                        </div>
                                            @endif   
                                        </td>
                                        <td>
                                            @if($e->numbers == 1)
                                                <input type="hidden" name="loan__client" value="{{ $e->client }}">
                                                <label class="text-primary mb-0">អ្នកខ្ចី</label>
                                            @elseif($e->numbers == 2)
                                                <input type="hidden" name="loan__client_join" value="{{ $e->join }}">
                                                <label class="text-success mb-0">អ្នករួមខ្ចី</label>
                                            @elseif($e->numbers == 3)
                                                <input type="hidden" name="loan__client_guarantee" value="{{ $e->guarantee }}">
                                                <label class="text-dark mb-0">អ្នកធានា</label>
                                            @else
                                                <input type="hidden" name="loan__client_guarantee_join" value="{{ $e->guarantee_join }}">
                                                <label class="text-info mb-0">អ្នករួមធានា</label>
                                            @endif           
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route("fix.loan.delete.tmp.row", $e->id) }}"
                                                onclick="return confirm('Are you sure ?');"
                                                class="btn btn-outline-danger btn-xs">
                                                <i class="fas fa-trash mr-1"></i> លុបចេញ
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="row">
                            @error('loan__client')
                                <div class="col-sm-12">
                                <label class="col-form-label text-danger" for="loan__client">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label>
                                </div>
                            @enderror

                            @error('loan__client_join')
                                <div class="col-sm-12"><label class="col-form-label text-danger" for="loan__client_join">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label></div>
                            @enderror

                            @error('loan__client_guarantee')
                                <div class="col-sm-12"><label class="col-form-label text-danger" for="loan__client_guarantee">
                                    <i class="far fa-times-circle"></i> {{ $message }}
                                </label></div>
                            @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                @include("new_fix.list_collect")

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                ព័ត៌មានកម្ចី
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__price">តម្លៃម៉ូតូ/ឡាន ($) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('loan__price') is-invalid @enderror"
                                               name="loan__price" min="0" step="1"  value="{{old('loan__price')}}"
                                               onchange="culLoan()"
                                               onkeyup="culLoan()"
                                               onmouseup="culLoan()"
                                               id="loan__price" placeholder="Enter ..." required>
                                        @error('loan__price')
                                            <label class="col-form-label text-danger" for="loan__price">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__investment">ប្រាក់បង់មុន ($) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('loan__investment') is-invalid @enderror"
                                               name="loan__investment" min="0" step="1" value="{{old('loan__investment')}}"
                                               onchange="culLoan()"
                                               onkeyup="culLoan()"
                                               onmouseup="culLoan()"
                                               id="loan__investment" placeholder="Enter ..." required autofocus>
                                        @error('loan__investment')
                                            <label class="col-form-label text-danger" for="loan__investment">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__balance">ទំហំទឹកប្រាក់កម្ចី ($) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('loan__balance') is-invalid @enderror"
                                               onkeyup="paymentCal()"
                                               onmouseup="paymentCal()"
                                               name="loan__balance" min="0" step="1" value="{{old('loan__balance')}}"
                                               id="loan__balance" placeholder="Enter ..." required>
                                        @error('loan__balance')
                                            <label class="col-form-label text-danger" for="loan__price">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__date_disburse">កាលបរិច្ឆេទបើកប្រាក់ <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('loan__date_disburse') is-invalid @enderror"
                                               name="loan__date_disburse" value="{{old('loan__date_disburse')}}"
                                               id="loan__date_disburse" placeholder="Enter ..." required>
                                        @error('loan__date_disburse')
                                            <label class="col-form-label text-danger" for="loan__price">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__interest_rate">អត្រាការប្រាក់ (%) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('loan__interest_rate') is-invalid @enderror"
                                               onkeyup="paymentCal()"
                                               onmouseup="paymentCal()"
                                               name="loan__interest_rate" min="0" step="0.001" value="{{old('loan__interest_rate')}}"
                                               id="loan__interest_rate" placeholder="Enter ..." required>
                                        @error('loan__interest_rate')
                                            <label class="col-form-label text-danger" for="loan__interest_rate">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__interest_rate_per">ក្នុងមួយ <span class="text-danger">*</span></label>
                                        <select class="form-control @error('loan__interest_rate_per') is-invalid @enderror"
                                               name="loan__interest_rate_per"
                                               onchange="paymentCal()"
                                               id="loan__interest_rate_per">
                                               <option value="1" {{ old('loan__interest_rate_per')==1 ? 'selected': '' }}>ខែ</option>
                                               <option value="4" {{ old('loan__interest_rate_per')==4 ? 'selected': '' }}>សប្តាហ៍</option>
                                               <option value="30" {{ old('loan__interest_rate_per')==30 ? 'selected': '' }}>ថ្ងៃ</option>
                                        </select>
                                        @error('loan__interest_rate_per')
                                            <label class="col-form-label text-danger" for="loan__interest_rate_per">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                ព័ត៌មានកម្ចី
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            
                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__term">រយៈពេលខ្ចី <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('loan__term') is-invalid @enderror"
                                               onkeyup="paymentCal()"
                                               onmouseup="paymentCal()"
                                               onchange="paymentCal()"
                                               name="loan__term" min="1" value="{{old('loan__term')}}"
                                               id="loan__term" placeholder="Enter ..." required>
                                        @error('loan__term')
                                            <label class="col-form-label text-danger" for="loan__term">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__purpose_description">ប្រាក់បង់ប្រចាំខែ ($)</label>
                                        <input type="text" class="form-control @error('loan__need_pay') is-invalid @enderror"
                                               name="loan__need_pay" value="{{old('loan__need_pay')}}"
                                               id="loan__need_pay" placeholder="Enter ..." readonly>
                                        @error('loan__need_pay')
                                            <label class="col-form-label text-danger" for="loan__need_pay">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            
                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__purpose">គោលបំណង <span class="text-danger">*</span></label>
                                        <div class="row mt-2 pl-2">
                                            <div class="custom-control custom-radio mr-3">
                                                <input class="custom-control-input" value="1" type="radio" id="loan__purpose1" name="loan__purpose" checked>
                                                <label for="loan__purpose1" class="custom-control-label">ទិញម៉ូតូ</label>
                                            </div>
                                            <div class="custom-control custom-radio mr-3">
                                                <input class="custom-control-input" value="2" type="radio" id="loan__purpose2" name="loan__purpose">
                                                <label for="loan__purpose2" class="custom-control-label">ឡាន</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" value="3" type="radio" id="loan__purpose3" name="loan__purpose">
                                                <label for="loan__purpose3" class="custom-control-label">ផ្សេងៗ</label>
                                            </div>
                                        </div>
                                        @error('loan__purpose')
                                        <label class="col-form-label text-danger" for="loan__purpose">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group __kh__">
                                        <label for="loan__first_date_pay">កាលបរិច្ឆេទបងប្រាក់ដំបូង <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('loan__first_date_pay') is-invalid @enderror"
                                               name="loan__first_date_pay" value="{{old('loan__first_date_pay')}}"
                                               id="loan__first_date_pay" placeholder="Enter ..." required>
                                        @error('loan__first_date_pay')
                                            <label class="col-form-label text-danger" for="loan__first_date_pay">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-7">
                                    <div class="form-group __kh__">
                                        <label for="loan__pay_place">កន្លែងបង់ប្រាក់ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('loan__pay_place') is-invalid @enderror"
                                               name="loan__pay_place" value="{{old('loan__pay_place', 'ហាក់ ប៊ុនជា ទិញ លក់ និងបង់រំលស់ម៉ូតូនិងឡាន')}}"
                                               id="loan__pay_place" placeholder="Enter ...">
                                        @error('loan__pay_place')
                                            <label class="col-form-label text-danger" for="loan__pay_place">
                                                <i class="far fa-times-circle"></i> {{ $message }}
                                            </label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group __kh__">
                                        <label for="loan__penalty">មូលដ្ឋានគិតប្រាក់ពិន័យ <span class="text-danger">*</span></label>
                                        <select name="loan__penalty" id="loan__penalty" class="form-control">
                                            <option value="1" selected>១$ (មួយដុល្លារ)</option>
                                            <option value="2">១% (មួយភាគរយ)</option>
                                        </select>
                                        
                                        @error('loan__penalty')
                                        <label class="col-form-label text-danger" for="loan__penalty">
                                            <i class="far fa-times-circle"></i> {{ $message }}
                                        </label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <hr> --}}
                            
                        </div>
                       
                    </div>
                </div>
            </div> 
            {{-- end row --}}

          
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-prevent-submits">
                                <i class="fas fa-save mr-1"></i>រក្សាទុក
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            
            {{-- end row --}}
        </form>
    </section>
</div>

{{-- @include('trans.modal_s')
@include('trans.loans.sub.join_cus')
@include('trans.loans.sub.guaran_cus')
@include('trans.coll_modal')
@include('trans.loans.sub.dara_kok.index') --}}

@endsection

@section('js')
<!-- InputMask -->
<script src="{{ asset('public/template') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('public/template') }}/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<script>
    var table_tmp, table_cus, cus_form;
    var state_form = false;
    var data_state = false;
    var g_state = false;
    var jtable, gtable, __table__coll, kok_table;
    $(function () {

        @include("layouts.ajaxSetup")
        $('.select2').select2();
        $('[data-mask]').inputmask();
        //Address -----------------------------------------------------------------------------------------------------
    //     @yield('cus__village')
    //     //end Address -------------------------------------------------------------------------------------------------
    //     @yield('join__village')
    //     //-------------------------------------------------------------------------------------------------------------
    //     @yield('g__village')
    //     //-------------------------------------------------------------------------------------------------------------
    //     @yield('g__dara_kok')
    //     //-------------------------------------------------------------------------------------------------------------
    //     cus_form = $('#form_cus');

    //     @yield('cus___table')
    //     @yield('tmp__tables_cus')  // on table_cus

    //     jtable = $('#jtable').DataTable({
    //         "paging": true,
    //         "lengthChange": true,
    //         "searching": true,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "processing": true,
    //         "serverSide": true,
    //         "ajax" : "{{ route('get.loan.client.join') }}",
    //         "columns": [
    //             { data: "name_full",  name: "name_full" },
    //             { data: "gender",  name: "gender" },
    //             { data: "phone",  name: "phone" },
    //             { data: "address",  name: "address" },
    //             { data: "dob",  name: "dob" },
    //             { data: "identify",  name: "identify" },
    //         ]
    //     });

    //     gtable = $('#gtable').DataTable({
    //         "paging": true,
    //         "lengthChange": true,
    //         "searching": true,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "processing": true,
    //         "serverSide": true,
    //         "ajax" : "{{ route('get.loan.client.gg') }}",
    //         "columns": [
    //             { data: "name",  name: "name" },
    //             { data: "gender",  name: "gender" },
    //             { data: "phone",  name: "phone" },
    //             { data: "address",  name: "address" },
    //             { data: "dob",  name: "dob" },
    //             { data: "identify",  name: "identify" },
    //         ]
    //     });

    //     @yield('kok_table_ajax')
    //    //--------------------------------------------------------------------------------------------
    //     @yield('__table__coll')
    //     //-------------------------------------------------------------------------------------------

    //     $('#create_cus').click(()=>{
    //         $("#table_cus").addClass('d-none');
    //         $('#create_cus').addClass('d-none');
    //         $('#form_cus').removeClass('d-none');
    //         cus_form[0].reset();
    //         state_form = true;
    //     });

    //     cus_form.submit((e)=>{
    //         e.preventDefault();
    //         $.ajax({
    //             type: "POST",
    //             url: "{{ route('clients.ajax.save') }}",
    //             data: cus_form.serialize(),
    //             dataType: "json",
    //             success: (res)=>{
    //                 $('#client__info').modal('hide');
    //                 table_tmp.ajax.reload(null,false);
    //                 table_cus.ajax.reload(null,false);
    //                 console.log(res);
    //             },
    //             error: (err) => {
    //                 let e_rror = $('#on__error');
    //                 let error = err.responseJSON.errors;
    //                 e_rror.removeClass('d-none');
    //                 e_rror.empty();
    //                 $.each(error, (key,value)=>{
    //                     e_rror.append(`
    //                         <label class="col-form-label text-danger d-block" style="font-size:14px;">
    //                             <i class="far fa-times-circle mr-2"></i>${value}
    //                         </label>
    //                     `);
    //                 });
    //             }
    //         });
    //     });

    //     $('#table_cus').submit((e)=>{
    //         e.preventDefault();

    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ route('create.client.tmp.loan') }}',
    //             data: {
    //                 'cu_customers_radio': $("input[name='cu_customers']:checked").val()
    //             },
    //             dataType: 'json',
    //             success: (res)=>{
    //                 $('#client__info').modal('hide');
    //                 table_tmp.ajax.reload(null,false);
    //                 console.log(res);
    //             },
    //             error: (err) => console.log(err)
    //         });
    //     });


    //     $('#jf--form').submit(e => {
    //         e.preventDefault();
    //         $.ajax({
    //             type: "POST",
    //             url: "{{ route('save.loan.client.join') }}",
    //             data: $('#jf--form').serialize(),
    //             dataType: "json",
    //             success: res => {
    //                 $('#client__info_join').modal('hide');
    //                 table_tmp.ajax.reload(null,false);
    //                 jtable.ajax.reload(null,false);
    //                 console.log(res);
    //             },
    //             error: err => {
    //                 let e_rror1 = $('#on__error_join');
    //                 let error1 = err.responseJSON.errors;
    //                 e_rror1.removeClass('d-none');
    //                 e_rror1.empty();
    //                 $.each(error1, (key,value)=>{
    //                     e_rror1.append(`
    //                         <label class="col-form-label text-danger d-block" style="font-size:14px;">
    //                             <i class="far fa-times-circle mr-2"></i>${value}
    //                         </label>
    //                     `);
    //                 });
    //             }
    //         });
    //     });

        
    //     $('#gf--form').submit(e => {
    //         e.preventDefault();
    //         $.ajax({
    //             type: "POST",
    //             url: "{{ route('save.loan.client.guaran') }}",
    //             data: $('#gf--form').serialize(),
    //             dataType: "json",
    //             success: res => {
    //                 $('#client__info_guaran').modal('hide');
    //                 table_tmp.ajax.reload(null,false);
    //                 gtable.ajax.reload(null,false);
    //                 console.log(res);
    //             },
    //             error: err => {
    //                 let e_rror11 = $('#on__error_g');
    //                 let error11 = err.responseJSON.errors;
    //                 e_rror11.removeClass('d-none');
    //                 e_rror11.empty();
    //                 $.each(error11, (key,value)=>{
    //                     e_rror11.append(`
    //                         <label class="col-form-label text-danger d-block" style="font-size:14px;">
    //                             <i class="far fa-times-circle mr-2"></i>${value}
    //                         </label>
    //                     `);
    //                 });
    //             }
    //         });
    //     });

    //     $('#jt--form').submit(e => {
    //         e.preventDefault();
    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ route('safe.loan.o.cli') }}',
    //             data: {
    //                 'cu_customers_radio': $("input[name='join__loan']:checked").val()
    //             },
    //             dataType: 'json',
    //             success: res => {
    //                 $('#client__info_join').modal('hide');
    //                 table_tmp.ajax.reload(null,false);
    //                 console.log(res);
    //             },
    //             error: err => console.log(err)
    //         });
    //     });


    //     @yield('dara_kok_jquery')


    //     $('#gt--form').submit(e => {
    //         e.preventDefault();
    //         $.ajax({
    //             type: 'POST',
    //             url: '{{ route('safe.loan.o.guaran') }}',
    //             data: {
    //                 'cu_customers_radio': $("input[name='gg__loan']:checked").val()
    //             },
    //             dataType: 'json',
    //             success: res => {
    //                 $('#client__info_guaran').modal('hide');
    //                 table_tmp.ajax.reload(null,false);
    //                 console.log(res);
    //             },
    //             error: err => console.log(err)
    //         });
    //     });


    //     $('#create_cus_join').click(e => {
    //         e.preventDefault();
    //         $('#jt--form').addClass('d-none');
    //         $('#jf--form').removeClass('d-none');
    //         $('#create_cus_join').addClass('d-none');
    //         $('#jf--form')[0].reset();
    //         data_state = true;
    //     });

        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif


        // $('#create_cus_guaran').click(e =>{
        //     e.preventDefault();
        //     $('#gt--form').addClass('d-none');
        //     $('#gf--form').removeClass('d-none');
        //     $('#create_cus_guaran').addClass('d-none');
        //     $('#gf--form')[0].reset();
        //     g_state = true;
        // });

        // $('#frm__collacterall').submit(function(e) {
        //     e.preventDefault();
        //     let url = frm_col_sta92 ? "{{ route('co.tmp.save') }}"  : "{{ route('co.tmp.edit','') }}/" + encodeURI(frm_col_id92);
        //     $.ajax({
        //         type: "POST",
        //         dataType: "JSON",
        //         url: url,
        //         data: $(this).serialize(),
        //         success: () => {
        //             $('#modal__collacteral').modal('hide');
        //             __table__coll.ajax.reload(null,false);
        //         },
        //         error: err => console.log(err)
        //     });
        // });

        $('.prevent-submits').on('submit', function(){
            $('.btn-prevent-submits').attr('disabled', true);
        });

    });

    function customer(){
        $('#client__info').modal('show');
        $("#table_cus").removeClass('d-none');
        $('#create_cus').removeClass('d-none');
        $('#form_cus').addClass('d-none');
        state_form = false;
        $('#table_cus')[0].reset();
    }

    function join_client(){
        $('#client__info_join').modal('show');
        $('#jt--form').removeClass('d-none');
        $('#jf--form').addClass('d-none');
        $('#create_cus_join').removeClass('d-none');
        $('#jt--form')[0].reset();
        data_state = false;
    }

    function guaran_client(){
        $('#client__info_guaran').modal('show');
        $('#gt--form').removeClass('d-none');
        $('#gf--form').addClass('d-none');
        $('#create_cus_guaran').removeClass('d-none');
        $('#gt--form')[0].reset();
        g_state = false;
    }


    // @yield('kok_func')

    function form_sub() {
        if(state_form)
            cus_form.submit();
        else
            $('#table_cus').submit();
    }

    function form_sub_join(){
        if(data_state)
            $('#jf--form').submit();
        else 
            $('#jt--form').submit();
    }

    function form_sub_guaran(){
        if(g_state)
            $('#gf--form').submit();
        else
            $('#gt--form').submit();
    }

    function de__data(val){
        if(confirm('Are you sure ?')){
            $.ajax({
                type: 'GET',
                url: "{{ route('sa5dw.delv.row.ssd','') }}/" + encodeURI(val),
                dataType: 'json',
                success: res => {
                    table_tmp.ajax.reload(null,false);
                    console.log(res);
                },
                error: err => console.log(err)
            });
        }
    }
    // @yield('clearAll')
    // @yield('colesc92')


    // function create_loan_(){
    //     $.ajax({
    //         type: "POST",
    //         url: "",
    //         dataType: "json",
    //         data: $('#fr_losnd').serialize(),
    //         success: res=> {
    //             toastr.success(res);
    //         },
    //         error: err => console.log(err)
    //     });
    // }

    function paymentCal(){
        let balance = $('#loan__balance').val();
        let rate = $('#loan__interest_rate').val();
        let ratePer = $('#loan__interest_rate_per').val();
        let term = $('#loan__term').val();
        let result = 0;
        if(term > 0){
            result =  Math.ceil(balance/term) + Math.ceil(balance * (rate/100) * ratePer);
        }
        $('#loan__need_pay').val(result);
    }

    // function paymentWheel(){
    //     let balance = $('#loan__balance').val();
    //     let rate = $('#loan__interest_rate').val();
    //     let ratePer = $('#loan__interest_rate_per').val();
    //     let term = $('#loan__term').val() + 1;
    //     let result = 0;
    //     if(term > 0){
    //         result =  Math.ceil(balance/term) + Math.ceil(balance * (rate/100) * ratePer);
    //     }
    //     $('#loan__need_pay').val(result);
    // }

    function culLoan(){
        let book = $('#loan__investment').val();
        let price = $('#loan__price').val();
        $('#loan__balance').val(price-book);

        paymentCal();
    }
</script>

@endsection
