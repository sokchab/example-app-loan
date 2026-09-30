<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            ព័ត៌មានអតិថិជន
        </h3>
        <div class="float-right">
            {{-- @if($lns->join_with == null) --}}
                <a href="{{ route("add.join.on.loan", [ $lns->id, 'join'=>$lns->join_with ]) }}" class="btn bg-gradient-olive btn-xs">
                    <i class="fas fa-user mr-1"></i> អ្នករួមខ្ចី
                </a>
            {{-- @endif

            @if($lns->guaranteed == null) --}}
                <a href="{{ route("add.guar.on.loan", [ $lns->id, 'join' => $lns->guaranteed ]) }}" class="btn bg-gradient-dark btn-xs">
                    <i class="fas fa-user mr-1"></i> អ្នកធានា
                </a>
            {{-- @endif

            @if($lns->guaranteed_join == null) --}}
                <a href="{{ route("add.another.on.loan", [ $lns->id, 'join' => $lns->guaranteed_join ]) }}" class="btn bg-gradient-info btn-xs">
                    <i class="fas fa-user mr-1"></i> អ្នករួមធានា
                </a>
            {{-- @endif --}}
        </div>
    </div>
    <div class="card-body">

        <table id="li_province_cus" class="table table-bordered">
            <thead>
            <tr>
                <th class="__kh__">អត្ថលេខ</th>
                <th class="__kh__">ឈ្មោះអតិថិជន</th>
                <th class="__kh__">មុខរបរ</th>
                <th class="__kh__">លេខទូរស័ព្ទ</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <a href="{{ route('loans.edit', $lns->id) }}" class="btn-group">
                        <span class="badge br-primary text-primary brr"><i class="fas fa-user"></i></span>
                        <span class="badge bg-gradient-primary brl text-sm">{{ $lns->getClient->cus_key }}</span>
                    </a>
                </td>
                <td>
                    {{ $lns->getClient->fullName()  }} 
                    
                    &nbsp; {{ $lns->getClient->fullNameEn() }}
                </td>

                <td>
                    {{ $lns->getClient->occupation }}  
                    @if($lns->getClient->add_occupation != null)
                    <small class='ml-3 mr-1'>ទីតាំង</small> {{ $lns->getClient->add_occupation }}
                    @endif
                </td>
                <td>
                    {{ \Hel::phoneDisplay($lns->getClient->phone) }} , {{ \Hel::phoneDisplay($lns->getClient->phone2) }}
                </td>
                
            </tr>

            @if($lns->join_with != null)
            <tr>
                <td>
    
                    <a href="{{ route("loans.editJoin", $lns->id) }}" class="btn-group">
                        <span class="badge br-olive text-olive brr"><i class="fas fa-user"></i></span>
                        <span class="badge bg-gradient-olive brl text-sm">អ្នករួមខ្ចី</span>
                    </a>
                </td>
                <td>
                    {{ $lns->getJoin->fullName()  }} 
                    
                    - {{ $lns->getJoin->fullNameEn() }}
                    <div class="float-right btn-group">
                        <span class="badge br-dark brr">ត្រូវជា</span>
                        <span class="badge bg-gradient-dark brl text-sm">{{  $lns->jx_type }}</span>
                    </div>
                </td>

                <td>
                    {{ $lns->getJoin->occupation }}  
                    @if($lns->getJoin->occ_address != null)
                    <small class='ml-3 mr-1'>ទីតាំង</small> {{ $lns->getJoin->occ_address }}
                    @endif
                </td>
                <td>
                    {{ \Hel::phoneDisplay($lns->getJoin->phone) }} , {{ \Hel::phoneDisplay($lns->getJoin->phone2) }}
                </td>
                
            </tr>
            @endif

            @if($lns->guaranteed != null)
            <tr>
                <td>
                    
                    <a href="{{ route('loans.editGuaran', $lns->id) }}" class="btn-group">
                        <span class="badge br-dark text-dark brr"><i class="fas fa-user"></i></span>
                        <span class="badge bg-gradient-dark brl text-sm">អ្នកធានា</span>
                    </a>
                </td>
                <td>
                    {{ $lns->getGuaranteed->fullName()  }} 
                    - {{ $lns->getGuaranteed->fullNameEn() }}

                    <div class="float-right btn-group">
                        <span class="badge br-dark brr">ត្រូវជា</span>
                        <span class="badge bg-gradient-dark brl text-sm">{{  $lns->gx_type }}</span>
                    </div>
                </td>
                <td>
                    {{ $lns->getGuaranteed->occupation }}  
                    @if($lns->getGuaranteed->occ_address != null)
                    <small class='ml-3 mr-1'>ទីតាំង</small> {{ $lns->getGuaranteed->occ_address }}
                    @endif
                </td>
                <td>
                    {{ \Hel::phoneDisplay($lns->getGuaranteed->phone) }} , 
                    {{ \Hel::phoneDisplay($lns->getGuaranteed->phone2)  }} 
                </td>
                
            </tr>
            @endif


            @if($lns->guaranteed_join != null)
            <tr>
                <td>
                    
                    <a href="{{ route('loans.editGuaranJoin', $lns->id) }}" class="btn-group">
                        <span class="badge br-info text-info brr"><i class="fas fa-user"></i></span>
                        <span class="badge bg-gradient-info brl text-sm">រួមធានា</span>
                    </a>
                </td>
                <td>
                    {{ $lns->getGuaranteedJoin->fullName()  }}  
                    - {{ $lns->getGuaranteedJoin->fullNameEn() }}

                    <div class="float-right btn-group">
                        <span class="badge br-dark brr">ត្រូវជា</span>
                        <span class="badge bg-gradient-dark brl text-sm">{{  $lns->gxj_type }}</span>
                    </div>
                </td>
                <td>
                    {{ $lns->getGuaranteedJoin->occupation }}  
                    @if($lns->getGuaranteedJoin->company_name != null)
                    <small class='ml-3 mr-1'>ទីតាំង</small> {{ $lns->getGuaranteedJoin->company_name }}
                    @endif
                </td>
                <td>
                    {{ \Hel::phoneDisplay($lns->getGuaranteedJoin->phone) }} , 
                    {{ \Hel::phoneDisplay($lns->getGuaranteedJoin->phone2)  }}
                </td>
                
            </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>
