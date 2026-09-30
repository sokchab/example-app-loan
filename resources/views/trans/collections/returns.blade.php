@extends("layouts.app")

@section('title', 'Loan Return')

@section('loans.collection.return', 'active')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header pb-0">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-8">
                        <form action="{{ route("collection.return") }}" role="search" method="get">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="q" class="form-control float-right"
                                               value="{{ old('q',$nest->q) }}"
                                               placeholder="Search">
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search mr-1"></i> ស្វែងរក
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Loan</li>
                            <li class="breadcrumb-item active text-primary">Return</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content print_white">
            <div class="container-fluid print_white">
                <div class="row">
                    {{-- <div class="col-12">
                        <div class="card">
                            <div class="card-body p-1">
                                @include("trans.collections.rets.forms")
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Return List</h3>
                                <div class="card-tools">
                                    
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if(isset($data))
                                    @if($nest->op == 'loan')
                                        @include("trans.collections.rets.loan")
                                    @else
                                        @include("trans.collections.rets.clients")
                                    @endif
                                    <div class="mt-3 float-right">
                                         {!! $data->appends(['op' => $nest->op, 'q' => $nest->q])->links() !!}
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div> --}}
                        @if(isset($data))
                            {{-- @if($nest->op == 'loan') --}}
                                @include("trans.collections.returns.loans")
                            {{-- @elseif($nest->op == 'client')
                                @include("trans.collections.returns.client")
                            @else
                                @include('trans.collections.returns.others')
                            @endif --}}
                            <div class="float-right">
                                {{ $data->appends(['op' => $nest->op, 'q' => $nest->q])->links() }}
                            </div>
                        @endif
                        {{-- @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator )
                            {{$products->links()}}
                        @endif --}}
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
