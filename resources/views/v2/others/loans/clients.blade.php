@extends("layouts.app")
@section('title', 'V2.Loans')
@section('v2.other.loans', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('v2.others.loan.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active text-primary">ជ្រើសរើសអ្នកខ្ចី</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ជ្រើសរើសអ្នកខ្ចី</h3>
                                <form class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="search"  value="{{ old('search', request('search')) }}"
                                               class="form-control float-right" placeholder="Search">
                    
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ឈ្មោះអតិថិជន</th>
                                            <th>អក្សរឡាតាំង</th>
                                            <th>ភេទ</th>
                                            <th>លេខទូរស័ព្ទ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cus as $c)
                                            <tr>
                                                <td>
                                                    <a href="{{ route("v2.others.loan.createByClient", $c->id) }}" class="btn btn-info btn-xs">
                                                        {{ $c->cus_key }}
                                                    </a>
                                                </td>
                                                <td>{{ $c->fullName() }}</td>
                                                <td>{{ $c->fullNameEn() }}</td>
                                                <td><span class="tag tag-success">{{ $c->Sex() }}</span></td>
                                                <td>
                                                    {{ \Hel::phoneDisplay($c->phone) }} ,
                                                    {{ \Hel::phoneDisplay($c->phone2) }} 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $cus->appends(['search' => request('search') ])->links() }}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
<style type="text/css">
    .pagination{
        margin-bottom: 0 !important;
    }

    @media print {
        .print_white{
            background-color: white !important;
        }
    }
</style>
@endsection

@section('js')
<script>
    $(function () {
        @if (Session::has('message'))
            toastr.success('{{ Session::get('message') }}');
        @endif
    });
</script>
@endsection
