<form id="kok-table">
    <div class="modal-body">
        
            <table id="kok_table" class="table">
                <thead>
                <tr>
                    <th class="__kh__" style="border-top: none"># ឈ្មោះអ្នករួមធានា</th>
                    <th class="__kh__" style="border-top: none">ភេទ</th>
                    <th class="__kh__" style="border-top: none">លេខទូរស័ព្ទ</th>
                    <th class="__kh__" style="border-top: none">អាសយដ្ឋាន</th>
                    <th class="__kh__" style="border-top: none">ថ្ងៃខែឆ្នាំកំណើត</th>
                    <th class="__kh__" style="border-top: none">លេខអត្តសញ្ញាណប័ណ្ណ</th>
                </tr>
                </thead>
            </table>
        
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


@section('kok_table_ajax')
    kok_table = $('#kok_table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "ajax" : "{{ route('kok.get.rows') }}",
        "columns": [
            { data: "fullname",  name: "fullname" },
            { data: "gender",  name: "gender" },
            { data: "phone",  name: "phone" },
            { data: "address",  name: "address" },
            { data: "dob",  name: "dob" },
            { data: "identify",  name: "identify" },
        ]
    });
@endsection