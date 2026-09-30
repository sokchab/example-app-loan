<form id="gf--form" class="d-none">
    <div class="modal-body">
        @csrf
            {{-- <div class="d-none mb-2" id="on__error_g">
            </div> --}}
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__last_name" class="__kh__">នាមត្រកូល *</label>
                        <input type="text" class="form-control __kh__"
                            name="g__last_name"
                            id="g__last_name" placeholder="Last Name" required autofocus>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__first_name" class="__kh__">នាមខ្លួន *</label>
                        <input type="text" class="form-control __kh__"
                            name="g__first_name"
                            id="g__first_name" placeholder="First Name" required>
                    </div>
                </div>



                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__last_name_en" class="__kh__">អក្សរឡាតាំង * Last Name</label>
                        <input type="text" class="form-control __kh__"
                            name="g__last_name_en"
                            id="g__last_name_en" placeholder="Last Name" required>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__first_name_en" class="__kh__">First Name *</label>
                        <input type="text" class="form-control __kh__"
                            name="g__first_name_en"
                            id="g__first_name_en" placeholder="First Name" required>
                    </div>
                </div>


           


               

                
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="g__name_en" class="__kh__">ភេទ</label>
                        <select name="g__gender" id="g__gender" class="form-control __kh__">
                            <option value="1">ប្រុស</option>
                            <option value="0">ស្រី</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="g__dob" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                        <input type="date" class="form-control"
                            name="g__dob"
                            id="g__dob" placeholder="Enter ...">
                    </div>
                </div>


                {{-- <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__mstatus" class="__kh__">ស្ថានភាពគ្រួសារ</label>
                        <select name="g__mstatus" id="g__mstatus" class="form-control __kh__">
                            @foreach($data['ms'] as $r)
                                <option value="{{ $r->id }}">{{ $r->name_kh }}-{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__id_type" class="__kh__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                        <select name="g__id_type" id="g__id_type" class="form-control __kh__">
                            @foreach($data['ide'] as $r)
                                <option value="{{ $r->id }}">{{ $r->name_kh }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__id_number" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន *</label>
                        <input type="text" class="form-control"
                            name="g__id_number"
                            id="g__id_number" placeholder="Enter ..." required>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="g__id_register" class="__kh__">ចុះថ្ងៃទី</label>
                        <input type="date" class="form-control"
                            name="g__id_register"
                            id="g__id_register" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="g__type" class="__kh__">ត្រូវជាអ្វីនឹងអ្នកខ្ចី</label>
                        <input type="text" class="form-control"
                            name="g__type"
                            id="g__type" placeholder="Enter ..." required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="g__occupation" class="__kh__">មុខរបរ *</label>
                        <input type="text" class="form-control"
                            name="g__occupation"
                            id="g__occupation" placeholder="Enter ..." required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="g__occupation_address" class="__kh__">ទីតាំងមុខរបរ</label>
                        <input type="text" class="form-control"
                            name="g__occupation_address"
                            id="g__occupation_address" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__phone" class="__kh__">លេខទូរស័ព្ទ *</label>
                        <input type="text" class="form-control __kh__"
                            name="g__phone" data-inputmask='"mask": "999 999 9999"' data-mask
                            id="g__phone" placeholder="Enter ..." required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__phone2" class="__kh__" style="color: white">-</label>
                        <input type="text" class="form-control __kh__"
                            name="g__phone2" data-inputmask='"mask": "999 999 9999"' data-mask
                            id="g__phone2" placeholder="Enter ...">
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__home" class="__kh__">លេខផ្ទះ</label>
                        <input type="text" class="form-control __kh__"
                            name="g__home"
                            id="g__home" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__group" class="__kh__">ក្រុមទី/លេខផ្លូវ</label>
                        <input type="text" class="form-control __kh__"
                            name="g__group"
                            id="g__group" placeholder="Enter ...">
                    </div>
                </div>


                {{-- <div class="col-sm-3">
                    <div class="form-group">
                        <label for="g__street" class="__kh__">លេខផ្លូវ</label>
                        <input type="text" class="form-control __kh__"
                            name="g__street"
                            id="g__street" placeholder="Enter ...">
                    </div>
                </div> --}}
                @include("trans.loans.sub.guaran.add")
            </div>
        
    </div>

    <div class="modal-footer justify-content-between">
        <div>
            
        </div>
        <div>
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
             <i class="fas fa-times mr-1"></i> បោះបង់
          </button>
          <button type="submit" class="btn btn-dark">
              <i class="fas fa-save mr-1"></i>
              យល់ព្រម
          </button>
        </div>
    </div>
</form>
