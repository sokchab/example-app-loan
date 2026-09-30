@php
    $tr = $ds->groupBy(function($rw){
        return $rw->pay_col_id;
    });
    
@endphp

@foreach ($tr as $item => $rows)
    @php
        $index = $loop->iteration;
    @endphp
    @foreach ($rows as $row)
        <tr class="pt-dd {{ $row->OnOverdueState() ? "on-overdue" : "" }}" style="font-size: 14px">
            @if($loop->first)
                <td rowspan="{{ $rows->count() }}" class="text-center" style="vertical-align : middle;">
                    {{ $index }}
                </td>
            @endif
            <td class="text-center">
                {{ \Carbon\Carbon::parse($row->date_pay)->format('d-m-y') }}
            </td>
            <td>$
                <span class="float-right">
                    {{ $row->amount }}
                </span>
            </td>
            <td>$
                @if ($row->print_due_return > 0)
                    <span class="float-right">{{ number_format($row->print_due_return) }}</span>
                @else
                    <span class="float-right">{{ number_format($row->same_value) }}</span>
                @endif
            </td>
            <td>$
                @if($row->inter_due_return > 0)
                    <span class="float-right">{{ number_format($row->inter_due_return) }}</span>
                @else
                    <span class="float-right">{{ number_format($row->inter_due) }}</span>
                @endif
            </td>
            <td>$
                <span class="float-right">{{ number_format($row->balance) }}</span>
            </td>

            <td>$
                @if ($row->fee > 0)
                    <span class="float-right">{{ number_format($row->fee) }}</span>
                @else
                    <span class="float-right">{{ number_format($row->kok) }}</span>
                @endif    
            </td>
            <td class="text-center">{{ $row->late }}</td>

            <td class="text-center">
                @if($row->state == 1)
                    <span class="badge bg-gradient-success">
                        បានបង់
                    </span>
                @elseif($row->state == 0)
                    <span class="badge bg-gradient-danger">
                    មិនទាន់
                    </span>
                @else
                    <span class="badge bg-gradient-warning">
                        បង់ខ្វះ
                    </span>
                @endif
            </td>

            <td>
                @if($row->state == 1 || $row->state == 2)
                    @if($row->getPayments()->count() <= 0)
                        បានបង់ផ្តាច់
                    @else
                    $ <span class="float-right">
                        {{ number_format($row->getPayments->hasPaid()) }}
                    </span>
                    @endif
                @else 
                $ <span class="float-right">0</span>
                @endif    
            </td>

            <td class="text-center">
                @if($row->state == 1 || $row->state == 2)
                    @if ($row->getPayments()->count() <= 0)
                        
                    @else
                        {{ \Carbon\Carbon::parse($row->getPayments->paid_date)->format('d-m-y') }}
                    @endif
                @endif
            </td>

            <td>
                @if($row->state == 1 || $row->state == 2)
                    @if ($row->getPayments()->count() <= 0)
                        
                    @else
                        {{ $row->getPayments->getUser->name }}
                    @endif
                @endif
            </td>

            <td>
                @if($row->state == 1 || $row->state == 2)
                    @if ($row->getPayments()->count() <= 0)
                        
                    @else
                        {{ $row->getPayments->paid_by }}
                    @endif
                @endif
            </td>

            <td class="text-center1">
                @if($row->state==0)
                    <a href="{{ route('collection.return.search.__payment', $row->id) }}" class="btn bg-gradient-olive btn-xs">
                        បង់ប្រាក់
                    </a>
                    
                @else                    
                    @if($row->getPayments()->count() <= 0)
                        
                    @else
                    <a href="{{ route('loans.invoice', $row->getPayments->id) }}" class="btn btn-link btn-xs text-bold">
                        បង្កាន់ដៃ
                    </a>
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
@endforeach
  