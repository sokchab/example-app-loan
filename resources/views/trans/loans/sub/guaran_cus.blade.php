<!-- Modal -->

<div class="modal fade" id="client__info_guaran"
     data-backdrop="static" data-keyboard="false"
     tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-user-circle mr-1"></i>អ្នកធានា
                    <button type="button" class="btn btn-link" id="create_cus_guaran">
                    <i class="fas fa-plus mr-1"></i>
                    បន្ថែមថ្មី
                    </button>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{-- <button type="button" class="btn btn-success" id="create_cus_join">
                <i class="fas fa-plus mr-1"></i>
                បន្ថែមថ្មី
                </button> --}}
            </div>
                @include('trans.loans.sub.guaran.tbl')
                @include('trans.loans.sub.guaran.frm')
            
      </div>
    </div>
</div>