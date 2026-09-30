@foreach($data as $d)
<div class="timeline mb-2">
    <div class="m-0">
      {{-- <i class="fas fa-envelope bg-blue"></i> --}}
      <div class="timeline-item mr-0 ml-0">
        <span class="time" style="color: black">
          {{ $d->getClient->address() }}
        </span>
        <h3 class="timeline-header">
            <a href="{{ route('clients.show', $d->getClient->id ) }}" class="mr-2">
                {{ $d->getClient->fullName() }} - {{  $d->getClient->fullNameEn() }}
            </a> {{ $d->getClient->cus_key }} 
            {{-- <div class="btn-group">
                <span class="badge br-olive text-olive brr">Phone</span>
                <span class="badge bg-gradient-olive brl"></span>
            </div> --}}
            <small class="ml-3"></small>
            {{ $d->getClient->phone }}
        </h3>

        <div class="timeline-body pt-0 pb-0">
          <table class="table table-condensed no-border--top mb-0">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Account</th>
                <th>Balance</th>
                <th>Outstanding</th>
                <th style="width: 140px" class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td>{{ $d->acc_number }}</td>
                <td>
                  $ {{ number_format($d->balance,2) }}
                </td>
                <td>
                  $ {{ number_format($d->getCollection->sum('print_due_return'))  }}
                </td>
                <td class="text-center">
                  {!! $d->getStatus() !!}
                  <span class="badge bg-gradient-olive">
                    {{ $d->getPerOfFinish() }}%
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="timeline-footer">
          <a href="{{ route("collection.return.search.ref",$d->id) }}" 
            class="btn bg-gradient-primary btn-xs">Payments</a>
          <a class="btn bg-gradient-olive btn-xs">Finish</a>
          <div class="float-right">
            @if($d->join_with != null)
              <div class="btn-group mr-1">
                <span class="badge br-dark brr text-dark">
                  អ្នករួមខ្ចី
                </span>
                <span class="badge bg-gradient-dark text-sm brl">
                    {{ $d->getJoin->fullName() }}
                </span>
              </div>
            @endif
            @if($d->guaranteed != null)
              <div class="btn-group mr-1">
                <span class="badge br-dark brr text-dark">
                  អ្នកធានា
                </span>
                <span class="badge bg-gradient-dark text-sm brl">
                    {{ $d->getGuaranteed->fullName() }}
                </span>
              </div>
            @endif
            @if($d->guaranteed_join != null)
              <div class="btn-group mr-1">
                <span class="badge br-dark brr text-dark">
                  អ្នករួមធានា
                </span>
                <span class="badge bg-gradient-dark text-sm brl">
                    {{ $d->getGuaranteedJoin->fullName() }}
                </span>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- END timeline item -->
    <!-- timeline item -->
</div>

@endforeach