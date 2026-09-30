<form id="form_cus" class="d-none">
    <div class="modal-body">
        @csrf
        {{-- <div class="d-none mb-2" id="on__error">
        </div> --}}
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__last_name" class="__kh__">នាមត្រកូល *</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__last_name"
                        id="cus__last_name" placeholder="Last Name" required autofocus>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__first_name" class="__kh__">នាមខ្លួន *</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__first_name"
                        id="cus__first_name" placeholder="First Name" required>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__last_name_en" class="__kh__">អក្សរឡាតាំង Last Name * </label>
                    <input type="text" class="form-control __kh__"
                        name="cus__last_name_en"
                        id="cus__last_name_en" placeholder="Last Name" required>
                </div>
            </div>

          

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__first_name_en" >First Name​ *</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__first_name_en"
                        id="cus__first_name_en" placeholder="First Name" required>
                </div>
            </div>

            

            
        </div>


        <div class="row">

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="cus__name_en" class="__kh__">ភេទ</label>
                    <select name="cus__gender" id="cus__gender" class="form-control __kh__">
                        <option value="1">ប្រុស</option>
                        <option value="0">ស្រី</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="cus__dob" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                    <input type="date" class="form-control"
                        name="cus__dob"
                        id="cus__dob" placeholder="Enter ...">
                </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__id_type" class="__kh__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                    <select name="cus__id_type" id="cus__id_type" class="form-control __kh__">
                        @foreach($data['ide'] as $r)
                            <option value="{{ $r->id }}">{{ $r->name_kh }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__id_number" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន *</label>
                    <input type="text" class="form-control"
                        name="cus__id_number"
                        id="cus__id_number" placeholder="Enter ..." required>
                </div>
            </div>


            <div class="col-sm-2">
                <div class="form-group">
                    <label for="cus__id_register" class="__kh__">ចុះថ្ងៃទី</label>
                    <input type="date" class="form-control"
                        name="cus__id_register"
                        id="cus__id_register" placeholder="Enter ...">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="cus__occupation" class="__kh__">មុខរបរ *</label>
                    <input type="text" class="form-control"
                        name="cus__occupation"
                        id="cus__occupation" placeholder="Enter ..." required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="cus__occupation_address" class="__kh__">ទីតាំងមុខរបរ</label>
                    <input type="text" class="form-control"
                        name="cus__occupation_address"
                        id="cus__occupation_address" placeholder="Enter ...">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__phone" class="__kh__">លេខទូរស័ព្ទ *</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__phone"
                        data-inputmask='"mask": "999 999 9999"' data-mask
                        id="cus__phone" placeholder="Enter ..." required>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__phone2" class="__kh__" style="color: white">-</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__phone2"
                        data-inputmask='"mask": "999 999 9999"' data-mask
                        id="cus__phone2" placeholder="Enter ...">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__home" class="__kh__">លេខផ្ទះ</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__home"
                        id="cus__home" placeholder="Enter ...">
                </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__group" class="__kh__">ក្រុមទី/លេខផ្លូវ</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__group"
                        id="cus__group" placeholder="Enter ...">
                </div>
            </div>

          

            {{-- <div class="col-sm-3">
                <div class="form-group">
                    <label for="cus__street" class="__kh__">លេខផ្លូវ</label>
                    <input type="text" class="form-control __kh__"
                        name="cus__street"
                        id="cus__street" placeholder="Enter ...">
                </div>
            </div> --}}

            @include("trans.loans.sub.address")
        </div>

    </div>

    <div class="modal-footer justify-content-between">
        <div>
            {{-- <button type="button" class="btn btn-primary" id="create_cus">
                <i class="fas fa-plus mr-1"></i>
                បន្ថែមថ្មី
            </button>  --}}
        </div>
        <div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-times mr-1"></i> បោះបង់
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i>
                យល់ព្រម
            </button>
        </div>
    </div>
</form>