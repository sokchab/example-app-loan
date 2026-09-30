<!-- Modal -->
<div class="modal fade" id="modal__collacteral"
     data-backdrop="static" data-keyboard="false"
     tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="frm__collacterall">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-user-circle mr-1"></i>ទ្រព្យបញ្ចាំ</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__model">ក្រុមហ៊ុនផលិត <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="collateral__model"
                                   id="collateral__model" placeholder="Enter ..." required autofocus>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__extra">ម៉ូដែល <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="collateral__extra"
                                   id="collateral__extra" placeholder="Enter ..." required>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__color">ពណ៍ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="collateral__color"
                                   id="collateral__color" placeholder="Enter ..." required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__body">លេខតួ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="collateral__body"
                                   id="collateral__body" placeholder="Enter ..." required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__machine">លេខម៉ាស៊ីន <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="collateral__machine"
                                   id="collateral__machine" placeholder="Enter ..." required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__year">ឆ្នាំផលិត <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"
                                   name="collateral__year"
                                   id="collateral__year" placeholder="Enter ..." required>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group __kh__">
                            <label for="collateral__number">ផ្លាក់លេខ/ប័ណ្ណសម្គាល់</label>
                            <input type="text" class="form-control"
                                   name="collateral__number"
                                   id="collateral__number" placeholder="Enter ...">
                        </div>
                    </div>

                    

                    <div class="col-sm-4">
                        <div class="form-group __kh__">
                            <label for="collateral__type">ប្រភេទយានយន្ត</label>
                            <select class="form-control"
                                   name="collateral__type"
                                   id="collateral__type">
                                <option value="1" selected>ម៉ូតូ</option>
                                <option value="2">ឡាន</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> បោះបង់
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i>
                    យល់ព្រម
                </button>
            </div>
        </form>
      </div>
    </div>
</div>

@section('colesc92')
    var frm_col_sta92 = true;
    var frm_col_id92;
    function frm__colla(){
        $('#modal__collacteral').modal('show');
        $('#frm__collacterall')[0].reset();
        frm_col_sta92 = true;
    }

    function Episode92(val) {
        frm_col_sta92 = false;
        $('#modal__collacteral').modal('show');
        $('#frm__collacterall')[0].reset();
        $.ajax({
            type: 'GET',
            url: '{{ route('co.tmp.sed', '') }}/' + val,
            dataType: 'json',
            success: res => {
                //__table__coll.ajax.reload(null,false);
                //console.log(res);
                $('[name="collateral__model"]').val(res.model);
                $('[name="collateral__color"]').val(res.color);
                $('[name="collateral__body"]').val(res.body);
                $('[name="collateral__machine"]').val(res.marchine);
                $('[name="collateral__year"]').val(res.year);
                $('[name="collateral__number"]').val(res.iden);
                $('[name="collateral__extra"]').val(res.extra);
                $('[name="collateral__type"]').val(res.type);
                frm_col_id92  = res.id;
            },
            error: err => console.log(err)
        });
    }

    function TheThreeKingdom(val) {
        if(confirm('Are you sure ?')){
        $.ajax({
            type: 'GET',
            url: "{{ route('collec.delv.row.ssd','') }}/" + encodeURI(val),
            dataType: 'json',
            success: res => {
                __table__coll.ajax.reload(null,false);
                console.log(res);
            },
                error: err => console.log(err)
            });
        }
    }
@endsection