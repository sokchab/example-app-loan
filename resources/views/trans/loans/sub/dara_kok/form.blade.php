<form id="kok-form" class="d-none">
    <div class="modal-body">
        @csrf
            <div class="row">

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__last_name" class="__kh__">នាមត្រកូល *</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__last_name"
                            id="kok__last_name" placeholder="Last Name" required autofocus>
                    </div>
                </div>

             

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__first_name" class="__kh__">នាមខ្លួន *</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__first_name"
                            id="kok__first_name" placeholder="First Name" required>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__last_name_en" class="__kh__">អក្សរឡាតាំង Last Name *</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__last_name_en"
                            id="kok__last_name_en" placeholder="Last Name" required>
                    </div>
                </div>


                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__first_name_en" class="__kh__">First Name *</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__first_name_en"
                            id="kok__first_name_en" placeholder="First Name" required>
                    </div>
                </div>


                

            </div>

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="kok__name_en" class="__kh__">ភេទ</label>
                        <select name="kok__gender" id="kok__gender" class="form-control __kh__">
                            <option value="1">ប្រុស</option>
                            <option value="0">ស្រី</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="kok__dob" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                        <input type="date" class="form-control"
                            name="kok__dob"
                            id="kok__dob" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__id_type" class="__kh__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                        <select name="kok__id_type" id="kok__id_type" class="form-control __kh__">
                            @foreach($data['ide'] as $r)
                                <option value="{{ $r->id }}">{{ $r->name_kh }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__id_number" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន *</label>
                        <input type="text" class="form-control"
                            name="kok__id_number"
                            id="kok__id_number" placeholder="Enter ..." required>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="kok__id_register" class="__kh__">ចុះថ្ងៃទី</label>
                        <input type="date" class="form-control"
                            name="kok__id_register"
                            id="kok__id_register" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kok__type" class="__kh__">ត្រូវជាអ្វីនឹងអ្នកខ្ចី</label>
                        <input type="text" class="form-control"
                            name="kok__type"
                            id="kok__type" placeholder="Enter ..." required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kok__occupation" class="__kh__">មុខរបរ *</label>
                        <input type="text" class="form-control"
                            name="kok__occupation"
                            id="kok__occupation" placeholder="Enter ..." required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kok__occupation_address" class="__kh__">ទីតាំងមុខរបរ</label>
                        <input type="text" class="form-control"
                            name="kok__occupation_address"
                            id="kok__occupation_address" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__phone" class="__kh__">លេខទូរស័ព្ទ *</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__phone"  data-inputmask='"mask": "999 999 9999"' data-mask
                            id="kok__phone" placeholder="Enter ..." required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__phone2" class="__kh__" style="color: white">-</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__phone2"  data-inputmask='"mask": "999 999 9999"' data-mask
                            id="kok__phone2" placeholder="Enter ..." required>
                    </div>
                </div>


                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__home" class="__kh__">លេខផ្ទះ</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__home"
                            id="kok__home" placeholder="Enter ...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="kok__group" class="__kh__">ក្រុមទី/លេខផ្លូវ</label>
                        <input type="text" class="form-control __kh__"
                            name="kok__group"
                            id="kok__group" placeholder="Enter ...">
                    </div>
                </div>

                @include("trans.loans.sub.dara_kok.address")
            </div>
        
    </div>

    <div class="modal-footer justify-content-between">
        <div></div>
        <div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
             <i class="fas fa-times mr-1"></i> បោះបង់
          </button>
          <button type="submit" class="btn btn-info">
              <i class="fas fa-save mr-1"></i>
              យល់ព្រម
          </button>
        </div>
    </div>
</form>
