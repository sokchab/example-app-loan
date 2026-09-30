<div class="card">
  <div class="card-body p-0">
    <table class="table table-striped3 projects">
        <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 30%">
                  កម្ចី 
                </th>
                <th style="width: 35%">
                  អតិថិជន
                </th>
                <th>
                  ផ្សេងៗ
                </th>
                <th>
                  ស្ថានភាព
                </th>
                <th style="width: 15%">  </th>
            </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                  <small>គណនី </small>
                  <b class="mr-3">{{ $d->acc_number }}</b>
                  
                  <small>កម្ចី </small>
                  <b>
                    $ {{ number_format($d->balance) }}
                  </b>
                  <br>
                  <small>
                    ប្រាក់ដើមក្នុងដៃអតិថិជន
                  </small>
                  <b>
                    $ {{ number_format($d->getCollection->sum('print_due_return'))  }}
                  </b>
                  <br>
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

                <td>
                  <a href="{{ route('clients.show', $d->getClient->id ) }}" class="mr-2">
                    <b>{{ $d->getClient->fullName() }}</b>
                  </a> {{ $d->getClient->cus_key }} 
                  <small class="ml-3"></small>
                  {{ $d->getClient->occupation }}
                  <br>
                  {{ \Hel::phoneDisplay($d->getClient->phone) }} , {{ \Hel::phoneDisplay($d->getClient->phone2) }}
                  <small class="ml-3"></small>
                  
                  <br>
                  <small>
                    {{ $d->getClient->address() }}
                  </small>
                </td>

                <td class="project_progress">
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

                <td>
                  {!! $d->getStatus('text-sm pt-2px') !!}
                    <span class="badge bg-gradient-olive text-sm pt-2px">
                      {{ $d->getPerOfFinish() }}%
                    </span>

                  @if($d->getCollection()->isOverdue()->count() > 0)
                  <br>
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

                <td class="project-actions text-right">
                  <a href="{{ route("collection.return.search.ref",$d->id) }}"  style="width: 80px;"
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
                    <a href="{{ route('re.create', $d->id) }}" style="width: 80px;"
                      class="btn bg-gradient-olive ml-1 btn-xs">
                        <i class="fab fa-elementor mr-1"></i>
                        <b>រំលស់ដើម</b>
                    </a>
                    @endif              
                </td>
            </tr>
          @endforeach 
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>


