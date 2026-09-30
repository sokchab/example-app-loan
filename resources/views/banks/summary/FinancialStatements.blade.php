<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">Financial statements
            <small class="ml-3">Page {{ $sub->currentPage() }} of {{ $sub->lastPage() }}</small>
        </h3>
        <div class="card-tools no-print">
            <a href="{{ route("bank.report.flows") }}"><i class="fas fa-clipboard-list mr-1"></i> Report</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-valign-middle table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Date</th>
                <th>In flow</th>
                <th>Out flow</th>
                <th>Cash balance</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sub as $rw)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                        {{-- $loop->iteration+$sub->perPage()*($sub->currentPage()-1) --}}
                    </td>
                    <td>
                        {{ $rw->dsc }}
                    </td>
                    <td>&nbsp;
                        {{ \Carbon\Carbon::parse($rw->created_at)->format('d-m-Y - h:i A') }}
                    </td>

                    <td>
                        <small class="text-success mr-1">
                            <i class="fas fa-arrow-down"></i>
                        </small>
                        {{ number_format($rw->in_flow,2) }} USD
                    </td>

                    <td>
                        <small class="text-danger mr-1">
                            <i class="fas fa-arrow-up"></i>
                        </small>
                        {{ number_format($rw->out_flow,2) }} USD
                    </td>

                    <td>
                        {{ number_format($rw->balance,2) }} USD
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5" class="text-right">
                    Ending balance
                </th>
                <th>
                    {{ number_format($data->bank_principle + $data->bank_interest,2) }} USD
                </th>
            </tr>
            </tfoot>
        </table>
        <div class="float-right no-print mr-3 mt-3">
            {{ $sub->withQueryString()->links() }}
        </div>
    </div>
</div>