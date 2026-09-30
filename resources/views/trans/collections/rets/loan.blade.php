
<div class="row">
    @foreach($data as $d)
        <div class="col-sm-12">
            <div class="post">
                <div class="user-block">
                    <img
                         src="{{ asset('public/template/images/alts') }}/{{ strtoupper(substr($d->getClient->cus_key, 0, 1)) }}.png"
                         alt="image">
                    <span class="username">
                <strong class="text-primary mr-4">{{ $d->getClient->last_name  }} {{ $d->getClient->first_name . ' - ' . $d->getClient->name_en }}</strong>
                <small class="mr-1">Client Key</small> <b class="text-primary mr-4">{{ $d->getClient->cus_key }}</b>
                <small class="mr-1">Phone</small> <b class="text-primary">{{ $d->getClient->phone }}</b>
            </span>
                    <span class="description">
                    {{ $d->getClient->fullAddress() }}
                </span>
                </div>
                <!-- /.user-block -->
                <div class="table-responsive mailbox-messages mb-5">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="mailbox-name">
                                    <i class="fas fa-file-invoice-dollar mr-3"></i>

                                    <span class="text-primary">{{ $d->acc_number }}</span>

                                    <div class="float-right">

                                        @if($d->status == 1)
                                            <div class="btn-group">
                                                <span class="badge br-indigo brr text-indigo">Status</span>
                                                <span class="badge bg-indigo brl text-sm">
                                                    <i class="far fa-chart-bar mr-1"></i>Active
                                                </span>
                                            </div>
                                        @elseif($d->status == 2)
                                            <div class="btn-group">
                                                <span class="badge br-dark text-dark brr">Status</span>
                                                <span class="badge bg-dark text-sm brl">
                                                    <i class="fas fa-times mr-1"></i>Reject
                                                </span>
                                            </div>
                                        @else
                                            <div class="btn-group">
                                                <span class="badge br-success brr text-success">Status</span>
                                                <span class="badge bg-success text-sm brl">
                                                    <i class="fas fa-check mr-1"></i>Finish
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="mailbox-subject">
                                    <b class="mr-4 text-danger">$ {{ number_format($d->balance,2) }}</b>

                                    <div class="btn-group mr-1">
                                        <span class="badge br-primary brr text-primary">Outstanding</span>
                                        <span class="badge bg-primary brl text-sm">
                                            $ {{ number_format($d->getCollection->sum('print_due_return')) }}
                                         </span>
                                    </div>

                                    <div class="btn-group">
                                        <span class="badge br-success brr text-success">Finished</span>
                                        <span class="badge bg-success brl text-sm">
                                            {{ number_format(100 - ($d->getCollection->sum('print_due_return')/$d->balance)*100) }} %
                                        </span>
                                    </div>
                                </td>

                                <td class="mailbox-date" width="120px">
                                    <a href="{{ route("collection.return.search.ref",$d->id) }}" class="btn btn-block btn-outline-success btn-xs">
                                        <i class="fas fa-dollar-sign mr-2"></i> Payment
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
            </div>
        </div>
    @endforeach
</div>
