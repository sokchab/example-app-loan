{{--<form id="table_cus">  @csrf--}}
{{--    <table id="li_province" class="table table-bordered head-fixed">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>#</th>--}}
{{--            <th class="__kh__">ឈ្មោះអតិថិជន</th>--}}
{{--            <th class="__kh__">ភេទ</th>--}}
{{--            <th class="__kh__">លេខទូរស័ព្ទ</th>--}}
{{--            <th class="__kh__">អាសយដ្ឋាន</th>--}}
{{--            <th class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</th>--}}
{{--            <th class="__kh__">លេខអត្តសញ្ញាណប័ណ្ណ</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--    </table>--}}
{{--</form>--}}
<form id="table_cus">
    <div class="modal-body" id="m--table">
        @csrf
            <table id="li_province11" class="table">
                <thead>
                <tr>
                    <th style="border-top: none">#</th>
                    <th class="__kh__" style="border-top: none">ឈ្មោះអតិថិជន</th>
                    <th class="__kh__" style="border-top: none">ភេទ</th>
                    <th class="__kh__" style="border-top: none">លេខទូរស័ព្ទ</th>
                    <th class="__kh__" style="border-top: none">អាសយដ្ឋាន</th>
                    <th class="__kh__" style="border-top: none">ថ្ងៃខែឆ្នាំកំណើត</th>
                    <th class="__kh__" style="border-top: none"></th>
                </tr>
                </thead>
            </table>
        
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

@section('cus___table')
    table_cus = $('#li_province11').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": "{{ route('clients.fetch.rows') }}",
    "columns": [
    { data: "cus_key", name: "cus_key"},
    { data: "name_full", name: "name_full" },
    { data: "gender", name: "gender" },
    { data: "phone", name: "phone" },
    { data: "address", name: "address" },
    { data: "dob", name: "dob"},
    { data: "identify", name: "identify", className: "text-center" , orderable: false, searchable: false}
    ],
    "order": [[ 0, "desc" ]]
    });
@endsection

@section('tmp__tables_cus')
    table_tmp = $('#table_tmp').DataTable({
    'paging' : false,
    'lengthChange': false,
    'searching' : false,
    'ordering' : false,
    'info': false,
    'autoWidth': false,
    'processing' :  true,
    'serverSide': true,
    'ajax' : "{{ route('loans.fetch.tmp') }}",
    'columns' : [
    { data: '__nam__', name: '__nam__' },
    { data: 'cus_key', name: 'cus_key' },
    { data: '__act__', name: '__act__' },
    { data: '__action__', name: '__action__' , className: 'text-right'}
    ]
    });
@endsection
