@php
    $valueNow = floatval($Monthly['ValThis']);
    $valueLast = floatval($Monthly['ValLast']);

    if($valueNow <= $valueLast){
        $perValue = $valueLast == 0 ? 100 : 100*($valueLast - $valueNow)/$valueLast;
    }else{
        $perValue = $valueNow == 0 ? 0 : 100*($valueNow - $valueLast)/$valueNow;
    }
@endphp

<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">Monthly cash flow</h3>
            <a href="{{ route('bank.report.flows_by_month', ['from'=> \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'), 'to' => \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')]) }}" class="no-print"><i class="fas fa-clipboard-list mr-1"></i> Report</a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg">
                    $ {{ number_format($valueNow, 2) }}
                    <small>{{ number_format($valueLast, 2) }}</small>
                </span>
                <span>Disbursement</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
                @if($valueNow <= $valueLast)
                    <span class="text-danger">
                        <i class="fas fa-arrow-down"></i> {{ number_format($perValue,1) }}%
                    </span>
                @else
                    <span class="text-success">
                        <i class="fas fa-arrow-up"></i> {{ number_format($perValue,1) }}%
                    </span>
                @endif
                <span class="text-muted">Since last month</span>
            </p>
        </div>
        <!-- /.d-flex -->

        <div class="position-relative mb-4">
            <canvas id="sales-chart" height="200"></canvas>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <span class="mr-3">
                <i class="fas fa-square text-lightblue"></i> In
            </span>
            <span class="mr-3">
                <i class="fas fa-square text-maroon"></i> Out
            </span>
            <span>
                <i class="fas fa-square text-olive"></i> Disbursement
            </span>
        </div>
    </div>
</div>

