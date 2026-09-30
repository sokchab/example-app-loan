@php
    $balNow = floatval($WeeklyCashFlow['OutSumDes']);
    $balLast = floatval($WeeklyCashFlow['LastSumDes']);

    if($balNow <= $balLast){
        $balPer = $balLast == 0 ? 100 : 100*($balLast - $balNow)/$balLast;
    }else{
        $balPer = $balNow == 0 ? 0 : 100*($balNow - $balLast)/$balNow;
    }
@endphp

<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">Weekly cash flow</h3>
            <a href="{{ route("bank.report.flows_by_day", [ 'filter' => \Carbon\Carbon::now()->format('Y-m-d') ] ) }}" class="no-print">
                <i class="fas fa-clipboard-list mr-1"></i> Report
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg">$ {{ number_format($balNow, 2) }}  <small>{{ number_format($balLast,2) }}</small></span>
                <span>Disbursement</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
                @if($balLast > $balNow)
                    <span class="text-danger">
                        <i class="fas fa-arrow-down"></i> {{ number_format($balPer, 1) }}%
                    </span>
                @else
                    <span class="text-success">
                        <i class="fas fa-arrow-up"></i> {{ number_format($balPer, 1) }}%
                    </span>
                @endif
                <span class="text-muted">Since last week</span>
            </p>
        </div>
        <!-- /.d-flex -->
        <div class="position-relative mb-4">
            <canvas id="visitors-chart" height="200" width="100%"></canvas>
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
