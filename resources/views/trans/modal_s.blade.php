<!-- Modal -->
<div class="modal fade" id="client__info"
     data-backdrop="static" data-keyboard="false"
     tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-user-circle mr-1"></i>អតិថិជន
                <button type="button" class="btn btn-link" id="create_cus">
                    <i class="fas fa-plus mr-1"></i>
                    បន្ថែមថ្មី
                  </button>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{-- <button type="button" class="btn btn-primary" id="create_cus">
                <i class="fas fa-plus mr-1"></i>
                បន្ថែមថ្មី
              </button> --}}
            </div>
                @include('trans.loans.sub.table_cus')
                @include('trans.loans.sub.cus_form')
            {{-- <div class="modal-footer justify-content-between">
                <div>
                    <button type="button" class="btn btn-primary" id="create_cus">
                        <i class="fas fa-plus mr-1"></i>
                        បន្ថែមថ្មី
                    </button> 
                </div>
                <div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                     <i class="fas fa-times mr-1"></i> បោះបង់
                  </button>
                  <button type="button" class="btn btn-primary" onclick="form_sub()">
                      <i class="fas fa-save mr-1"></i>
                      យល់ព្រម
                  </button>
                </div>
            </div> --}}

      </div>
    </div>
</div>