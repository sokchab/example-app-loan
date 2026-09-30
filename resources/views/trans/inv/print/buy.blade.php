@php 
    $i = $data->getCollaterals()->offset(0)->limit(2)->get()
@endphp

<section class="content page-break print_white">
    <div class="container-fluid print_white" style="color: black !important;">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3 line-h">
                    <h5 class="text-center __Svayreing__ mb-3 f_22px">ព្រះរាជាណាចក្រកម្ពុជា</h5>
                    <h5 class="text-center __Svayreing__ f_22px">ជាតិ សាសនា ព្រះមហាក្សត្រ</h5>
                    <h6 class="text-center __TACTENG__ mb-4">rrr2sss</h6>
        
                    <div class="for-print-a4 __Content__">
                        <h5 class="text-center mb-5 __Niroth__ un-line">លិខិតទិញលក់រថយន្ត/ទោចក្រយានយន្ត</h5>
                        
                        <span class="mr-5"></span>

                        {{ $data->getClient->gender == 1 ? "ខ្ញុំបាទ" : "នាងខ្ញុំ" }}ឈ្មោះ
                        <b class="mr-2 ml-2">{{ $data->getClient->fullName() }}</b>
                        ថ្ងៃខែឆ្នាំកំណើត <b class="mr-2 ml-2">
                            {{ \Carbon\Carbon::parse($data->getClient->dob)->format('d-m-Y') }}
                        </b>
                        ប្រភេទប័ណ្ណ <b class="mr-2 ml-2">{{ $data->getClient->getIdentify->name_kh }}</b>
                        ប័ណ្ណសំគាល់លេខ <b class="mr-2 ml-2">{{ $data->getClient->identify_no }}</b>
                        <br>
                        
                            {{-- និងឈ្មោះ.................................................
                            ភេទ...............
                            ថ្ងៃខែឆ្នាំកំណើត...................................
                            ប្រភេទប័ណ្ណ................................................. <br>
                            ប័ណ្ណសំគាល់លេខ............................
                            ត្រូវជា.....................
                            មានអាសយដ្ឋានបច្ចុប្បន្ន ផ្ទះលេខ......................
                            ផ្លូវ/ក្រុម................ ភូមិ................................. <br>
                            ឃុំ/សង្កាត់........................................
                            ស្រុក/ខណ្ឌ/ក្រុង........................................
                            ខេត្ត/រាជធានី............................................. <br>
                            លេខទូរសព្ទ <b class="mr-2 ml-2">{{ $data->getClient->phone }}</b> ....................................... ។
                             --}}
                        @if($data->join_with != null)
                            និងឈ្មោះ <b class="mr-2 ml-2">{{ $data->getJoin->fullName() }}</b>
                            ភេទ <b class="mr-2 ml-2">{{ $data->getJoin->Sex() }}</b>
                            ថ្ងៃខែឆ្នាំកំណើត <b class="mr-2 ml-2">{{ \Carbon\Carbon::parse($data->getJoin->dob)->format('d-m-Y') }}</b>
                            ប្រភេទប័ណ្ណ <b class="mr-2 ml-2">{{ $data->getJoin->getIdentify->name_kh }}</b> 
                            ប័ណ្ណសំគាល់លេខ <b class="mr-2 ml-2">{{ $data->getJoin->it_no }}</b> 
                            ត្រូវជា <b class="mr-2 ml-2">{{ $data->jx_type }}</b> <br>
                        @else
                           @if ($data->guaranteed != null)
                            និងឈ្មោះ <b class="mr-2 ml-2">{{ $data->getGuaranteed->fullName() }}</b>
                            ភេទ <b class="mr-2 ml-2">{{ $data->getGuaranteed->Sex() }}</b>
                            ថ្ងៃខែឆ្នាំកំណើត <b class="mr-2 ml-2">{{ \Carbon\Carbon::parse($data->getGuaranteed->dob)->format('d-m-Y') }}</b>
                            ប្រភេទប័ណ្ណ <b class="mr-2 ml-2">{{ $data->getGuaranteed->getIdentify->name_kh }}</b> 
                            ប័ណ្ណសំគាល់លេខ <b class="mr-2 ml-2">{{ $data->getGuaranteed->it_no }}</b> 
                            ត្រូវជា <b class="mr-2 ml-2">{{ $data->gx_type }}</b> <br>
                           @else
                            និងឈ្មោះ.................................................
                            ភេទ...............
                            ថ្ងៃខែឆ្នាំកំណើត...................................
                            ប្រភេទប័ណ្ណ................................................. <br>
                            ប័ណ្ណសំគាល់លេខ.........................................
                            ត្រូវជា..................................................... <br>
                           @endif
                        @endif
                            មានអាសយដ្ឋានបច្ចុប្បន្ន ផ្ទះលេខ <b class="mr-3 ml-3">{{ $data->getClient->home }}</b> 
                            ផ្លូវ/ក្រុម <b class="mr-3 ml-3">{{ $data->getClient->group }}</b> 
                            ភូមិ <b class="mr-2 ml-2">{{ $data->getClient->getVillage->village_namekh }}</b>
                            ឃុំ/សង្កាត់ <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->commune_namekh }}</b>
                            ស្រុក/ខណ្ឌ/ក្រុង <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->district->district_namekh }}</b>  
                            ខេត្ត/រាជធានី <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->district->province->province_kh_name }}</b>  <br>
                            លេខទូរសព្ទ <b class="mr-2 ml-2">
                                {{ \Hel::phoneDisplay($data->getClient->phone) }} 
                                {{ $data->getClient->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getClient->phone2) : '' }}
                            </b> ។
                        
                        <br>
                        <span class="mr-5"></span>
                        បានលក់ទោចក្រយានយន្ត / រថយន្ត ចំនួន <b class="mr-2 ml-2">{{ $i->count() }} គ្រឿង</b>
                        ដែលមានលក្ខណៈសំគាល់ដូចខាងក្រោម ៖
                      
                        <table class="table mt-3 table-bordered border-black">
                            <tbody>
                                <tr>
                                    <td class="text-center pt-1 pb-1">ព័ត៌មានយានយន្ត</td>
                                    <td class="text-center pt-1 pb-1">
                                        @if ($i->count() >= 1)
                                            <i class="far fa{{$i[0]->type == 1 ? "-check" : ""}}-square mr-1"></i> ទោចក្រយានយន្ត
                                            <i class="far fa{{$i[0]->type == 2 ? "-check" : ""}}-square mr-1 ml-2"></i> រថយន្ត ទី១
                                        @endif
                                    </td>
                                    <td class="text-center pt-1 pb-1">
                                        @if ($i->count() >= 2)
                                            <i class="far fa{{$i[1]->type == 1 ? "-check" : ""}}-square mr-1"></i> ទោចក្រយានយន្ត
                                            <i class="far fa{{$i[1]->type == 2 ? "-check" : ""}}-square mr-1 ml-2"></i> រថយន្ត ទី២
                                        @else
                                            <i class="far fa-square mr-1"></i> ទោចក្រយានយន្ត
                                            <i class="far fa-square mr-1 ml-2"></i> រថយន្ត ទី២
                                        @endif
                                    </td>
                                    <td class="text-center pt-1 pb-1">
                                        @if ($i->count() >= 3)
                                            <i class="far fa{{$i[2]->type == 1 ? "-check" : ""}}-square mr-1"></i> ទោចក្រយានយន្ត
                                            <i class="far fa{{$i[2]->type == 2 ? "-check" : ""}}-square mr-1 ml-2"></i> រថយន្ត ទី៣
                                        @else
                                            <i class="far fa-square mr-1"></i> ទោចក្រយានយន្ត
                                            <i class="far fa-square mr-1 ml-2"></i> រថយន្ត ទី៣
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">ម៉ាក</td>
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->model }} 
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->model }} 
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->model }} 
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">ម៉ូដែល</td>
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->extra }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->extra }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->extra }}
                                        @endif
                                    </td>
                                </tr>


                                <tr>
                                    <td class="pt-1 pb-1">ពណ៌</td>
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->color }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->color }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->color }}
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="pt-1 pb-1">លេខម៉ាស៊ីន</td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->marchine }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->marchine }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->marchine }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-1 pb-1">លេខតួ</td>
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->body }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->body }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->body }}
                                        @endif
                                    </td>
                                </tr>

                                

                                <tr>
                                    <td class="pt-1 pb-1">ឆ្នាំផលិត</td>
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->year }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->year }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->year }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">បង្កាន់ដៃបង់ពន្ធ/ស្លាកលេខ</td>
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->iden }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->iden }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->iden }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <span class="mr-5"></span>
                        ទៅអោយទៅឈ្មោះ.....................................................
                        ភេទ..................
                        ថ្ងៃខែឆ្នាំកំណើត........................................... <br>
                        ប័ណ្ណសំគាល់ខ្លួនលេខ.....................................
                        ប្រភេទប័ណ្ណជា......................................................... <br>
                        ក្នុងតំលៃ......................................................................................
                        (ជាអក្សរ........................................................................................) 
                        <br>យើងខ្ញុំជាអ្នកលក់ សូមធានាទទួលខុសត្រូវចំពោះមុខច្បាប់ 
                        និងចេញសំណងទាំងស្រុងអោយឈ្មោះ..............................................
                        ក្នុងករណីរកឃើញថា <br> ទោចក្រយានយន្ត / រថយន្ត ខាងលើមិនត្រឹមត្រូវតាមច្បាប់ ។

                        
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6 text-right">
                                ធ្វើនៅ............................ថ្ងៃទី........ខែ...............ឆ្នាំ..............
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <b>អ្នកលក់</b>
                                <span class="d-block" style="margin-top: 140px;">{{ $data->getClient->fullName() }}</span>
                            </div>
                            <div class="col-sm-3 text-center">
                                @if ($data->join_with != null)
                                    <b>សាក្សី</b>
                                    <span class="d-block" style="margin-top: 140px;"> 
                                        {{ $data->getJoin->fullName() }}
                                    </span>
                                @else
                                    @if ($data->guaranteed  != null)
                                        <b>សាក្សី</b>
                                        <span class="d-block" style="margin-top: 140px;">
                                            {{ $data->getGuaranteed->fullName() }}
                                        </span>
                                    @endif
                                @endif
                                
                            </div>
                            <div class="col-sm-3 text-center">
                                <b>សាក្សីអ្នកទិញ</b>
                                <span class="d-block" style="margin-top: 140px;">.............................</span>
                            </div>
                            <div class="col-sm-3 text-center">
                                <b>អ្នកទិញ</b>
                                <span class="d-block" style="margin-top: 140px;">.............................</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>