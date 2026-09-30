<!-- Modal -->
<div class="modal fade" id="modal_dara_kok"
     data-backdrop="static" data-keyboard="false"
     tabindex="-1" role="dialog"
     aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-user-circle mr-1"></i>អ្នករួមធានា
                    <button type="button" class="btn btn-link" id="create_dara_kok">
                      <i class="fas fa-plus mr-1"></i>
                      បន្ថែមថ្មី
                    </button>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                @include('trans.loans.sub.dara_kok.table')
                @include('trans.loans.sub.dara_kok.form')
      </div>
    </div>
</div>

@section('kok_func')
  function guaran_join_client(){
    $('#modal_dara_kok').modal('show');
    $('#create_dara_kok').removeClass('d-none');
    $('#kok-table').removeClass('d-none');
    $('#kok-form').addClass('d-none');
  }
@endsection

@section('dara_kok_jquery')
  $('#create_dara_kok').click(function(e){
    e.preventDefault();
    $('#create_dara_kok').addClass('d-none');
    $('#kok-table').addClass('d-none');
    $('#kok-form').removeClass('d-none');
  });


  $('#kok-form').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ route('kok.save.rows') }}",
        data: $(this).serialize(),
        dataType: "json",
        success: res => {
            $('#modal_dara_kok').modal('hide');
            table_tmp.ajax.reload(null,false);
            kok_table.ajax.reload(null,false);
            console.log(res);
        },
        error: err => {
            console.log(err);
        }
    });
  });


  $('#kok-table').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: 'GET',
      url: '{{ route('kok.save.table') }}',
      data: {
          'g_kok__loan': $("input[name='g_kok__loan']:checked").val()
      },
      dataType: 'json',
      success: (res)=>{
          $('#modal_dara_kok').modal('hide');
          table_tmp.ajax.reload(null,false);
          console.log(res);
      },
      error: (err) => console.log(err)
    });
  });
@endsection