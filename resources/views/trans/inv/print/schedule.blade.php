@php
    $collections = $data->getSchedules()->orderBy('id')->orderBy('date_pay', 'desc')->get()->groupBy(function($item) {
        return $item->tag;
    });
@endphp

@foreach ($collections as $item => $rows)
    <section class="content page-break print_white">
        <div class="container-fluid print_white" style="color: black !important;">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row for-print-a4 __Content__">
                            <div class="col-12">
                                <h4 class="d-flex" style="justify-content: space-between;">
                                    <div class="user-block1 d-flex">
                                        <img class="mr-3"
                                            src="{{ asset('public/template/images/hb-logo.svg') }}" 
                                            style="width: 100px !important; height: 60px !important;"
                                            alt="image">
                                        <div>    
                                            <h4 class="username1" style="font-size: 24px; font-weight: bold;">
                                                ហាក់ ប៊ុនជា
                                            </h4>
                                            <span class="description mt-2" 
                                                style="font-size: 20px; color: black; width: 100%;">
                                                ទិញ លក់​ និងបង់រំលស់ម៉ូតូនិងឡាន
                                            </span>
                                        </div>
                                    </div>
                                      
                                    <b class="float-right1">កាលវិភាគសងប្រាក់</b>
                                    
                                </h4>
                                
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row mt-3 mb-3 for-print-a4 __Content__">
                            <div class="col-12">
                                <img src="{{ asset('public/template/images/facebook-square-brands.svg') }}"
                                    height="20px"
                                    class="mb-2 mr-1"
                                    alt="img">
                                <a href="https://www.facebook.com/hakbunchea168"
                                    class="node-dsm"
                                    target="_blank">ហាក់ ប៊ុនជា ទិញលក់រំលស់ម៉ូតូនិងឡាន រង្វង់មូលដៃប្រាំបី បាត់ដំបង</a>
                            </div>
                        </div>
                        
                        <!-- info row -->
                        <div class="row invoice-info for-print-a4 __Content__">
                            <div class="col-sm-4 invoice-col">
                                សូមទំនាក់ទំនងព័ត៌មានតាមរយៈ
                                <address class="mb-1">
                                    <strong>លេខទូរស័ព្ទវេរលុយ</strong><br>
                                    088 838 8687 ,  069 522 229 
                                    <br>
                                    093 597 273 , 077 522 227                                            
                                </address>
                                  
                                <b class="mr-2">អាចវេរលុយតាម ៖ </b>
                                <img height="40px" src="{{ asset('public/template/images/wing.png') }}" alt="wing">
                                <img height="40px" src="{{ asset('public/template/images/truemoney.png') }}" alt="truemoney">
                                <img height="40px" src="{{ asset('public/template/images/emoney.png') }}" alt="emoney">
                                
                                <address class="pt-4">
                                    {{-- <b>អាចវេរលុយតាម ៖ </b> --}}
                                    <img height="42px" class="mr-2" src="{{ asset('public/template/images/ABA.png') }}" alt="emoney"> 
                                    <img height="42px" src="{{ asset('public/template/images/aceleda.png') }}" alt="emoney">
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                ឈ្មោះអតិថិជន : <strong class="mr-3 text-primary text-lg">{{ $data->getClient->fullName() }}</strong> 
                                <address>
                                    @if($data->join_with != null)
                                    ឈ្មោះអ្នករួមខ្ចី/ប្តី/ប្រពន្ធ : <b>{{ $data->getJoin->fullName() }}</b><br>
                                    @endif
                                    @if($data->guaranteed != null)
                                    ឈ្មោះអ្នកធានា : <b>{{ $data->getGuaranteed->fullName() }}</b><br>
                                    @endif
                                    @if($data->guaranteed_join != null)
                                    ឈ្មោះអ្នករួមធានា : <b>{{ $data->getGuaranteedJoin->fullName() }}</b><br>
                                    @endif
                                    ថ្ងៃបើកប្រាក់ : {{ \Carbon\Carbon::parse($data->date_disburst)->format('d-m-Y') }}<br>
                                    ប្រាក់បង់មុន : $ {{ number_format($data->booking) }}<br>
                                    លេខទូរស័ព្ទ : {{ \Hel::phoneDisplay($data->getClient->phone) }} 
                                                {{ $data->getClient->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getClient->phone2) : '' }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                គណនី :
                                <b class="text-primary text-lg"> {{ $data->acc_number }}</b><br>
                                ចំនួនប្រាក់កម្ចី : <b>$ {{ number_format($rows->sum('prin_due')) }}</b><br>
                                អត្រាការប្រាក់ : <b>{{ number_format($data->interest_rate, 2) }} %</b><br>
                                រយៈពេលខ្ចី : <b>{{ $rows->count() }}​</b> ខែ <br>
                                ប្រភេទកម្ចី : <br>
                                @foreach($data->getCollaterals as $db)
                                    {{ $db->model . ' ' . $db->extra . ' ' . $db->year . ' ' . $db->color . ' ' . $db->iden }} <br>
                                @endforeach
            
                                ម៉ោងបង់ប្រាក់ &nbsp; 7:00 ព្រឹក ដល់ 5:00 ល្ងាច
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
            
                        <!-- Table row -->
                        <div class="row for-print-a4 __Content__ mt-2">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered border-black">
                                    <tbody>
                                    <tr>
                                        <th class="text-center" width="40px">#</th>
                                        <th class="text-center" width="170px">កាលបរិច្ឆេទ</th>
                                        <th class="text-center" width="120px">ប្រាក់ត្រូវបង់</th>
                                        <th class="text-center" width="120px">ប្រាក់ដើម</th>
                                        <th class="text-center" width="120px">ការប្រាក់</th>
                                        <th class="text-center" width="160px">សមតុល្យប្រាក់ដើម</th>
                                        <th width="110px" class="text-center">ប្រាក់ពិន័យ</th>
                                        <th width="100px" class="text-center">ថ្ងៃបង់</th>
                                        <th width="110px" class="text-center">អ្នកទទួល</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center pt-1 pb-1">0</td>
                                        <td class="pt-1 pb-1">
                                            @lang("schedule.".\Carbon\Carbon::parse($rows[$loop->iteration - 1]->date_disburs)->format('D'))
                                            <span class="float-right">{{  \Carbon\Carbon::parse($rows[$loop->iteration - 1]->date_disburs)->format('d-m-Y') }}</span>
                                        </td>
                                        <td class="pt-1 pb-1">-</td>
                                        <td class="pt-1 pb-1">-</td>
                                        <td class="pt-1 pb-1">-</td>
                                        <td class="pt-1 pb-1">$ 
                                            <span class="float-right">
                                                {{ number_format($rows->sum('prin_due')) }}
                                            </span>
                                        </td>
                                        <td class="pt-1 pb-1"></td>
                                        <td class="pt-1 pb-1"></td>
                                        <td class="pt-1 pb-1"></td>
                                    </tr>
            
                                    @foreach($rows as $ln)
                                    <tr>
                                        <td class="text-center pt-1 pb-1">{{ $loop->iteration }}</td>
                                        <td class="pt-1 pb-1">
                                            @lang("schedule.".\Carbon\Carbon::parse($ln->date_pay)->format('D'))
                                            <span class="float-right">{{ \Carbon\Carbon::parse($ln->date_pay)->format('d-m-Y') }}</span>
                                        </td>
                                        <td class="pt-1 pb-1" 
                                            style="background-image: url('{{ asset('public/template/images/bg_prints.png') }}');">$ 
                                            <span class="float-right">{{ number_format($ln->amount) }}</span>   
                                        </td>
                                        <td class="pt-1 pb-1">$ <span class="float-right">{{ number_format($ln->prin_due) }}</span></td>
                                        <td class="pt-1 pb-1">$ <span class="float-right">{{ number_format($ln->inter_due) }}</span></td>
                                        <td class="pt-1 pb-1">$ <span class="float-right">{{ number_format($ln->balance) }}</span></td>
                                        <td class="pt-1 pb-1"></td>
                                        <td class="pt-1 pb-1"></td>
                                        <td class="pt-1 pb-1"></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row for-print-a4 __Content__">
                            <div class="col-sm-6">
                                <div class="col-sm-12 text-center">
                                    ស្នាមមេដៃអតិថិជន
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        អតិថិជន
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        អ្នករួមខ្ចី
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        អ្នកធានា
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 140px">
                                    <div class="col-sm-4 text-center">
                                        {{ $data->getClient->fullName() }}
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        {{ $data->join_with == null ? "" : $data->getJoin->fullName() }}
                                    </div>

                                    <div class="col-sm-4 text-center">
                                        {{ $data->guaranteed == null ? "" : $data->getGuaranteed->fullName() }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-sm-6">
                                <div class="col-sm-12 text-center">
                                    ស្នាមមេដៃអ្នកទទួលប្រាក់
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="height: 24px;"></div>
                                </div>
                                <div class="row" style="margin-top: 140px">
                                    <div class="col-sm-12 text-center">
                                        ហាក់ ប៊ុនជា
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->        
        </div>
    </section>
@endforeach
