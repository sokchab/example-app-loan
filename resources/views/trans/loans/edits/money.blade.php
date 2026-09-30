@php
    $flag = $lns->getCollection->sum('print_due_return') < $lns->balance ? true: false;
@endphp
<div class="card">
    <div class="card-header">
        <div class="card-title">
            លេខគណនី
            <b>{{ $lns->acc_number }}</b>
        </div>
        <div class="float-right">
            ព័ត៌មានកម្ចី
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('loans.update', $lns->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="loan__amount_price" class="__kh__">តម្លៃម៉ូតូ/ឡាន ($)</label>
                        <input type="number" class="form-control"
                                min="0"
                                onchange="culLoan()"
                                onkeyup="culLoan()"
                                onmouseup="culLoan()"
                               value="{{ old('loan__amount_price', $lns->amount_price) }}"
                               name="loan__amount_price" id="loan__amount_price" @if($flag) readonly @endif required>

                            @error('loan__amount_price')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror       
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="loan__booking" class="__kh__">ប្រាក់បង់មុន ($)</label>
                        <input type="number" class="form-control"
                                min="0"
                                onchange="culLoan()"
                                onkeyup="culLoan()"
                                onmouseup="culLoan()"
                               value="{{ old('loan__booking',$lns->booking) }}"
                               name="loan__booking" id="loan__booking" @if($flag) readonly @endif required>

                            @error('loan__booking')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror       
                    </div>
                </div>

                

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="loan__balance" class="__kh__">ទំហំកម្ចី ($)</label>
                        <input type="number" class="form-control"
                                min="0"
                                {{-- onchange="paymentCal()" --}}
                               value="{{ old('loan__balance',$lns->balance) }}"
                               name="loan__balance" id="loan__balance" readonly required>


                               @error('loan__balance')       
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                    </div>
                </div>
                
                

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="loan__interest_rate" class="__kh__">អត្រាការប្រាក់ (%)</label>
                        <input type="number" class="form-control"
                                min="0"
                                step="0.001"
                                onchange="paymentCal()"
                                onkeyup="paymentCal()"
                                onmouseup="paymentCal()"
                               value="{{ old('loan__interest_rate',$lns->interest_rate) }}"
                               name="loan__interest_rate" id="loan__interest_rate" required @if($flag) readonly @endif>
                              
                           @error('loan__interest_rate')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label for="loan__rate_per" class="__kh__">ក្នុងមួយ</label>
                        @if($flag)
                        <input type="text" class="form-control"
                               @if($lns->rate_per==1)
                               value="ខែ"
                               @elseif($lns->rate_per==2)
                               value="សប្តាហ៍"
                               @else
                               value="ថ្ងៃ"
                               @endif
                               name="loan__rate_per" id="loan__rate_per" readonly>
                        @else 
                            <select class="form-control" onchange="paymentCal()" name="loan__rate_per" id="loan__rate_per">
                                <option value="1" {{ old('loan__rate_per', $lns->rate_per) == 1 ? "selected" : "" }}>ខែ</option>
                                <option value="2" {{ old('loan__rate_per', $lns->rate_per) == 2 ? "selected" : "" }}>សប្តាហ៍</option>
                                <option value="3" {{ old('loan__rate_per', $lns->rate_per) == 3 ? "selected" : "" }}>ថ្ងៃ</option>
                            </select>
                        @endif  
                        
                        @error('loan__rate_per')       
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="loan__term" class="__kh__">រយៈពេលខ្ចី</label>
                        <input type="text" class="form-control"
                                onchange="paymentCal()"
                                onkeyup="paymentCal()"
                                onmouseup="paymentCal()"
                               value="{{ old('loan__term', $lns->term) }}"
                               name="loan__term" id="loan__term" @if($flag) readonly @endif required>
                                
                                @error('loan__term')       
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror       
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="loan__date_disburst" class="__kh__">ថ្ងៃបើកប្រាក់</label>
                        <input type="date" class="form-control"
                               value="{{ old('loan__date_disburst',$lns->date_disburst) }}"
                               name="loan__date_disburst" id="loan__date_disburst" required @if($flag) readonly @endif>
                        @error('loan__date_disburst')       
                            <small class="text-danger">{{ $message }}</small>
                        @enderror       
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="loan__purple" class="__kh__">គោលបំណងកម្ចី</label>
                        {{-- 
                        @if($flag)
                        <input type="text" class="form-control"
                               @if($lns->loan_purple==1)
                               value="ទិញម៉ូតូ"
                               @elseif($lns->loan_purple==2)
                               value="ទិញឡាន"
                               @else
                               value="ផ្សេងៗ"
                               @endif
                               name="loan__purple" id="loan__purple" readonly>
                        @else 
                         --}}
                        <select class="form-control" name="loan__purple" id="loan__purple">
                            <option value="1" {{ old('loan__purple', $lns->loan_purple)==1 ? "selected" : ""}}>ទិញម៉ូតូ</option>
                            <option value="2" {{ old('loan__purple', $lns->loan_purple)==2 ? "selected" : ""}}>ទិញឡាន</option>
                            <option value="3" {{ old('loan__purple', $lns->loan_purple)==3 ? "selected" : ""}}>ផ្សេងៗ</option>
                        </select>
                        {{--                         
                        @endif 
                        --}}

                        @error('loan__purple')       
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="loan__amount_pay" class="__kh__">ប្រាក់បង់ប្រចាំខែ ($)</label>
                        <input type="text" class="form-control"
                               value="{{ old('loan__amount_pay', $lns->amount_pay) }}"
                               name="loan__amount_pay" id="loan__amount_pay" required readonly>

                            @error('loan__amount_pay')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror       
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="loan__pay_day" class="__kh__">ថ្ងៃបង់ប្រាក់ដំបូង</label>
                        <input type="date" class="form-control"
                               value="{{ old('loan__pay_day', $lns->pay_day) }}"
                               name="loan__pay_day" id="loan__pay_day" required @if($flag) readonly @endif>

                               @error('loan__pay_day')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="loan__pay_place" class="__kh__">កន្លែងបង់ប្រាក់ *</label>
                        <input type="text" class="form-control"
                               value="{{ old('loan__pay_place', $lns->pay_place) }}"
                               name="loan__pay_place" id="loan__pay_place" required>

                               @error('loan__pay_place')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="loan__penalty" class="__kh__">មូលដ្ឋានគិតប្រាក់ពិន័យ</label>
                        @if($flag)
                        <input type="text" class="form-control"
                               @if($lns->penalty==1)
                               value="១$ (មួយដុល្លារ)"
                               @else
                               value="១% (មួយភាគរយ)"
                               @endif
                               name="loan__penalty" id="loan__penalty" readonly>

                        @else
                        <select class="form-control" name="loan__penalty" id="loan__penalty">
                            <option value="1" {{ old('loan__penalty', $lns->penalty)==1 ? "selected" : "" }}>១$ (មួយដុល្លារ)</option>
                            <option value="2" {{ old('loan__penalty', $lns->penalty)==2 ? "selected" : "" }}>១% (មួយភាគរយ)</option>
                        </select>
                        @endif
                               @error('loan__penalty')       
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                    </div>
                </div>

                {{-- <div class="col-sm-1"></div> --}}

                <div class="col-sm-3">
                    <div class="form-group">
                        @if($lns->getCollection->sum('print_due_return') < $lns->balance)
                            <label for="loan__status" class="__kh__">Outstanding ($)</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($lns->getCollection->sum('print_due_return')) }}"
                                name="loan__status2" id="loan__status" readonly>
                            <input type="hidden" name="loan__status" value="{{ $lns->status }}">
                        @else
                            <label for="loan__status" class="__kh__">ស្ថានភាពកម្ចី</label>
                            @if($lns->status==3)
                                <input type="text" class="form-control"
                                    value="Finish"
                                    name="loan__status1" id="loan__status" readonly>
                                <input type="hidden" name="loan__status" value="{{ $lns->status }}">
                            @else
                                <select class="form-control" name="loan__status" id="loan__status">
                                    <option value="1" {{ old('loan__status',$lns->status)==1 ? "selected": "" }}>Active</option>
                                    {{-- <option value="2" {{ old('loan__status',$lns->status)==2 ? "selected": "" }}>Reject</option> --}}
                                </select>
                            @endif
                        @endif
                        @error('loan__status')       
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="col-sm-2">
                    <label for="loan__action" class="__kh__">ដំណើរការ</label>
                    <button type="submit" class="btn btn-primary d-block" style="width: 100%">
                        <i class="fas fa-save mr-2"></i>រក្សាទុក
                    </button>
                </div>
            </div>
            <!--end-row-->
        </form>
    </div>
    <!--end-card-body-->
</div>
