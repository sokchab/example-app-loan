{{-- __table__coll --}}
<div class="col-sm-12">
    <table class="table table-condensed dataTable no-footer" 
        style="margin-top: 0 !important;"
        id="table_tmp_col">
        <thead>
            <tr>
                <th>#</th>
                <th>ក្រុមហ៊ុនផលិត</th>
                <th>ម៉ូដែល</th>
                <th>ពណ៍</th>
                <th>លេខតួ</th>
                <th>លេខម៉ាស៊ីន</th>
                <th>ឆ្នាំផលិត</th>
                <th>ផ្លាក់លេខ/ប័ណ្ណសម្គាល់</th>
            </tr>
        </thead>
    </table>
</div>

@section('__table__coll')
    __table__coll = $('#table_tmp_col').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax" : "{{ route('col.tm.Secure.Digital') }}",
    "columns": [
            { data: "DT_RowIndex",  name: "DT_RowIndex" },
            { data: "model",  name: "model" },
            { data: "extra",  name: "extra" },
            { data: "color",  name: "color" },
            { data: "body",  name: "body" },
            { data: "marchine",  name: "marchine" },
            { data: "year",  name: "year" },
            { data: "iden",  name: "iden" }
        ]
    });
@endsection