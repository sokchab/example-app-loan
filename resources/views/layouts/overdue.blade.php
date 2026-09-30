<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-clock"></i>
        <span class="badge bg-gradient-danger navbar-badge">
            {{ \Notify::getOverDue()->get()->count() }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
            Loan Overdue</span>
        <div class="dropdown-divider"></div>
        @foreach (\Notify::getOverDue()->offset(0)->limit(10)->get() as $item)
        <a class="dropdown-item">
            <i class="fas fa-clock mr-1"></i> {{ $item->acc_number }}
            <span class="float-right text-muted text-sm">
                {{ 
                    \Carbon\Carbon::parse($item->getCollection
                        ->where('state', false)
                        ->where('date_pay', '<=', \Carbon\Carbon::now()->subMonths(1))
                        ->min('date_pay'))->diffForHumans()
                }} 
            </span>
        </a>
        <div class="dropdown-divider"></div>
        @endforeach
        <a href="{{ route('collection.overdue') }}" class="dropdown-item dropdown-footer">See All Overdue</a>
    </div>
</li>