@extends('layouts.app')
@section('title','Clients')

@section('client', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span>ព័ត៌មានអតិថិជន</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានអតិថិជន</span></li>
                            {{-- <li class="breadcrumb-item active">ខេត្ត</li> --}}
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{ route('clients.create') }}"><i class="fas fa-plus mr-1"></i>ព័ត៌មានអតិថិជនថ្មី</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        
                        <table id="li_province" class="table table-bordered">
                            <thead>
                                <tr>
                                    {{--<th width="20px">#</th>--}}
                                    <th># លេខសម្គាល់</th>
                                    <th>ឈ្មោះអតិថិជន</th>
                                    <th>ជាអក្សរឡាតាំង</th>
                                    <th>ភេទ</th>
                                    <th>ផ្សេងៗ</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    $(function () {
        $('#li_province').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": false,
            "serverSide": true,
            "ajax": {
                    url: "{{ route('clients.fetch') }}",
                    data: function (da) {
                        da.search = $('input[type="search"]').val()
                    }
            },
            "columns": [
                { data: "action", name: "action" },
                // { data: "__key__", name: "__key__" },
                { data: "full_name", name: "full_name" },
                { data: "name_full_en", name: "name_full_en" },
                { data: "gender", name: "gender" },
                //{ data: "__dob__", name: "__dob__"},
                { data: "activation", name: "activation", orderable: false, searchable: false }
            ],
            "order": [[ 0, "desc" ]]
        });

        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
