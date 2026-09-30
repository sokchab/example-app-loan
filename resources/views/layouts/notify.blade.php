<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge bg-gradient-warning navbar-badge">
            {{ \Notify::getData()->get()->count() }}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
            {{ \Notify::getData()->get()->count() }} Collections</span>
        <div class="dropdown-divider"></div>
        @foreach (\Notify::getData()->offset(0)->limit(10)->get() as $item)
        <span class="dropdown-item">
            <i class="fas fa-user mr-2"></i> {{ $item->acc_number }}
            <span class="float-right text-muted text-sm">
                {{ $item->getClient->fullName() }}
            </span>
        </span>
        <div class="dropdown-divider"></div>
        @endforeach
        <a href="{{ route('collection.index') }}" class="dropdown-item dropdown-footer">See All Collections</a>
    </div>
</li>