<form id="jf--form" class="d-none">
        
    <div class="modal-body" id="j--form">
        @csrf
            {{-- <div class="d-none mb-2" id="on__error_join">
            </div> --}}
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__last_name" class="__kh__">នាមត្រកូល *</label>
                        <input type="text" class="form-control __kh__"
                            name="join__last_name"
                            id="join__last_name" placeholder="Last Name" required autofocus>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__first_name" class="__kh__">នាមខ្លួន *</label>
                        <input type="text" class="form-control __kh__"
                            name="join__first_name"
                            id="join__first_name" placeholder="First Name" required>
                    </div>
                </div>
                

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__last_name_en" class="__kh__">អក្សរឡាតាំង Last Name *</label>
                        <input type="text" class="form-control __kh__"
                            name="join__last_name_en"
                            id="join__last_name_en" placeholder="Last Name" required>
                    </div>
                </div>

             
                


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__first_name_en">First Name *</label>
                        <input type="text" class="form-control __kh__"
                            name="join__first_name_en"
                            id="join__first_name_en" placeholder="First Name" required>
                    </div>
                </div>

                

                
            </div>

            <div class="row">
                {{-- <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__mstatus" class="__kh__">ស្ថានភាពគ្រួសារ</label>
                        <select name="join__mstatus" id="join__mstatus" class="form-control __kh__">
                            @foreach($data['ms'] as $r)
                                <option value="{{ $r->id }}">{{ $r->name_kh }}-{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="join__gender" class="__kh__">ភេទ</label>
                        <select name="join__gender" id="join__gender" class="form-control __kh__">
                            <option value="1">ប្រុស</option>
                            <option value="0">ស្រី</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="join__dob" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                        <input type="date" class="form-control"
                            name="join__dob"
                            id="join__dob" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__id_type" class="__kh__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                        <select name="join__id_type" id="join__id_type" class="form-control __kh__">
                            @foreach($data['ide'] as $r)
                                <option value="{{ $r->id }}">{{ $r->name_kh }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__id_number" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន *</label>
                        <input type="text" class="form-control"
                            name="join__id_number"
                            id="join__id_number" placeholder="Enter ..." required>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="join__id_register" class="__kh__">ចុះថ្ងៃទី</label>
                        <input type="date" class="form-control"
                            name="join__id_register"
                            id="join__id_register" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="join__type" class="__kh__">ត្រូវជាអ្វីនឹងអ្នកខ្ចី</label>
                        <input type="text" class="form-control"
                            name="join__type"
                            id="join__type" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="join__occupation" class="__kh__">មុខរបរ *</label>
                        <input type="text" class="form-control"
                            name="join__occupation"
                            id="join__occupation" placeholder="Enter ..." required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="join__occupation_address" class="__kh__">ទីតាំងមុខរបរ</label>
                        <input type="text" class="form-control"
                            name="join__occupation_address"
                            id="join__occupation_address" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__phone" class="__kh__">លេខទូរស័ព្ទ *</label>
                        <input type="text" class="form-control __kh__"
                            name="join__phone"
                            data-inputmask='"mask": "999 999 9999"' data-mask
                            id="join__phone" placeholder="Enter ..." required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__phone2" class="__kh__" style="color: white">-</label>
                        <input type="text" class="form-control __kh__"
                            name="join__phone2"
                            data-inputmask='"mask": "999 999 9999"' data-mask
                            id="join__phone2" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__home" class="__kh__">លេខផ្ទះ</label>
                        <input type="text" class="form-control __kh__"
                            name="join__home"
                            id="join__home" placeholder="Enter ...">
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__group" class="__kh__">ក្រុមទី/លេខផ្លូវ</label>
                        <input type="text" class="form-control __kh__"
                            name="join__group"
                            id="join__group" placeholder="Enter ...">
                    </div>
                </div>

              
                {{-- <div class="col-sm-3">
                    <div class="form-group">
                        <label for="join__street" class="__kh__">លេខផ្លូវ</label>
                        <input type="text" class="form-control __kh__"
                            name="join__street"
                            id="join__street" placeholder="Enter ...">
                    </div>
                </div> --}}
                @include("trans.loans.js.address")
            </div>
        
    </div>


    <div class="modal-footer justify-content-between">
        <div>
            
        </div>
        <div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i> បោះបង់
        </button>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save mr-1"></i>
            យល់ព្រម
        </button>
        </div>
    </div>

</form>

{{-- onclick="form_sub_join()" --}}