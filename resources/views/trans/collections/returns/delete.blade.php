
@foreach($data as $d)
<div class="timeline mb-2">
    <div class="m-0">
      {{-- <i class="fas fa-envelope bg-blue"></i> --}}
      <div class="timeline-item mr-0 ml-0">
        <span class="time" style="color: black">
          {{ $d->getClient->address() }}
          {!! $d->getStatus('text-sm pt-2px ml-2') !!}
          <span class="badge bg-gradient-olive text-sm pt-2px">
            {{ $d->getPerOfFinish() }}%
          </span>
        </span>

        <h3 class="timeline-header">
            <a href="{{ route('clients.show', $d->getClient->id ) }}" class="mr-2">
                {{ $d->getClient->fullName() }} <small>-</small> {{  $d->getClient->fullNameEn() }}
            </a> {{ $d->getClient->cus_key }} 
            <small class="ml-3"></small>
            {{ \Hel::phoneDisplay($d->getClient->phone) }} , {{ \Hel::phoneDisplay($d->getClient->phone2) }}
            <small class="ml-3"></small>
            {{ $d->getClient->occupation }}
           
        </h3>

        <div class="timeline-body pt-0 pb-0">
          <table class="table table-condensed no-border--top table-sm not-top mb-0">
            <tbody>
              <tr>
                <td class="pl-0">
                  <a href="{{ route("collection.return.search.ref",$d->id) }}" 
                    class="btn bg-gradient-primary btn-xs">
                    <i class="fas fa-calculator mr-1"></i>
                    <b>បង់ប្រាក់</b>
                  </a>
                  @php
                      
                      $ddx = $d->getCollection()
                          ->orderBy('inter_due_return', 'desc')
                          ->where('state', false);

                      if($ddx->count() > 0){
                        $date_first = $ddx->first()->date_pay;    
                      }else {
                        $date_first = now();
                      }
                          
                      $val = $d->getCollection()->where('state', false)
                          ->where('date_pay', '<=', \Carbon\Carbon::parse($date_first));
                      //$inter = $val->sum('inter_due_return');
                      $prin = $val->sum('print_due_return');

                      $total = $d->getCollection->sum('print_due_return');    
                      //$first_paid = $d->getCollection->max('amount') - $d->getCollection->max('inter_due_return');
                  
                      $pdf = $d->getCollection()->isReLoans()->get()->groupBy(function($rw){
                        return $rw->pay_col_id;
                      });

                  @endphp
                  @if ($pdf->count() >= 3 && $d->getCollection->sum('print_due_return') > 0 && ($prin + $total) > 300)
                  <a href="{{ route('re.create', $d->id) }}"
                    class="btn bg-gradient-olive ml-1 btn-xs">
                      <i class="fab fa-elementor mr-1"></i>
                      <b>រំលស់ប្រាក់ដើម</b>
                  </a>
                  @endif
                </td>
                <td>
                  <small>លេខគណនី </small>
                  <b>{{ $d->acc_number }}</b>
                </td>
                <td>
                  <small>កម្ចី </small>
                  <b>
                    $ {{ number_format($d->balance) }}
                  </b>
                </td>
                <td>
                  <small>ប្រាក់ដើមក្នុងដៃអតិថិជន</small>
                  <b>
                  $ {{ number_format($d->getCollection->sum('print_due_return'))  }}
                  </b>
                </td>
                
                <td>
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
                </td>
                <td class="text-right pr-0">
                  @if($d->getCollection()->isOverdue()->count() > 0)
                  <div class="btn-group mr-1">
                    <span class="badge br-danger brr text-danger">
                      យឺត
                    </span>
                    <span class="badge bg-gradient-danger text-sm brl">
                      {{ \Carbon\Carbon::parse($d->getCollection()->isOverdue()->min('date_pay'))->diffInDays() }}
                      <small>ថ្ងៃ</small>
                    </span>
                  </div>
                  @endif
                  
                </td>

                <td class="text-right">
                  @php $item = $d->getCollaterals();  @endphp
                  @if($item->count() > 0)
                    <small>
                      <b>{{ $item->first()->model }} 
                        {{ $item->first()->extra }} 
                        {{ $item->first()->year }} 
                        {{ $item->first()->color }} 
                        {{ $item->first()->iden }}</b>
                    </small>
                  @endif  
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
      </div>
    </div>
    <!-- END timeline item -->
    <!-- timeline item -->
</div>

@endforeach