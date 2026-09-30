<section class="content page-break print_white">
    <div class="container-fluid print_white" style="color: black !important;">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3 line-h">
                    <h5 class="text-center __Svayreing__ mb-3 f_22px">ព្រះរាជាណាចក្រកម្ពុជា</h5>
                    <h5 class="text-center __Svayreing__ f_22px">ជាតិ សាសនា ព្រះមហាក្សត្រ</h5>
                    <h6 class="text-center __TACTENG__ mb-4">rrr2sss</h6>
        
                    <div class="for-print-a4 __Content__">
                        <h5 class="text-center mb-5 __Niroth__ un-line">លិខិតជួលយានយន្ត</h5>
                        
                        <span class="mr-5"></span>
                        {{ $data->getClient->gender == 1 ? "ខ្ញុំបាទ" : "នាងខ្ញុំ" }}ឈ្មោះ
                        <b class="mr-2 ml-2">{{ $data->getClient->fullName() }}</b> 
                        ថ្ងៃខែឆ្នាំកំណើត <b class="mr-2 ml-2">
                            {{ \Carbon\Carbon::parse($data->getClient->dob)->format('d-m-Y') }}
                        </b>
                        ប្រភេទប័ណ្ណ <b class="mr-2 ml-2">{{ $data->getClient->getIdentify->name_kh }}</b>
                        ប័ណ្ណសំគាល់លេខ <b class="mr-2 ml-2">{{ $data->getClient->identify_no }}</b>
                        <br>
                        @if($data->join_with != null)
                            
                            {{-- មានអាសយដ្ឋានបច្ចុប្បន្ន ផ្ទះលេខ......................
                            ផ្លូវ/ក្រុម........ភូមិ........................ <br>
                            ឃុំ/សង្កាត់.....................................
                            ស្រុក/ខណ្ឌ/ក្រុង.....................................
                            ខេត្ត/រាជធានី................................................ <br>
                            លេខទូរសព្ទ......................................................................................................................................... ។ <br>
                            <span class="mr-5"></span>យើងខ្ញុំទាំងពីរបានជួលយានយន្តពីឈ្មោះ.......................................
                            ភេទ........
                            អត្តសញ្ញាណប័ណ្ណលេខ......................................... <br>
                            ដែលមានអាសយដ្ឋាន ផ្ទះលេខ........ផ្លូវ/ក្រុម.........
                            ភូមិ.........................
                            ឃុំ/សង្កាត់...........................
                            ស្រុក/ខណ្ឌ/ក្រុង.................................. <br>
                            ខេត្ត/រាជធានី.........................................................
                            ដូចមានបញ្ជាក់ខាងក្រោម ៖                     --}}

                            និងឈ្មោះ<b class="mr-2 ml-2">{{ $data->getJoin->fullName() }}</b>
                            ភេទ <b class="mr-2 ml-2">{{ $data->getJoin->Sex() }}</b>
                            ថ្ងៃខែឆ្នាំកំណើត <b class="mr-2 ml-2">{{ \Carbon\Carbon::parse($data->getJoin->dob)->format('d-m-Y') }}</b>
                            ប្រភេទប័ណ្ណ <b class="mr-2 ml-2">{{ $data->getJoin->getIdentify->name_kh }}</b> 
                            ប័ណ្ណសំគាល់លេខ <b class="mr-2 ml-2">{{ $data->getJoin->it_no }}</b> 

                            ត្រូវជា <b class="mr-2 ml-2">{{ $data->jx_type }}</b> <br>
                            
                        @else
                            @if($data->guaranteed  == null)
                                និងឈ្មោះ.......................................
                                ភេទ.............
                                ថ្ងៃខែឆ្នាំកំណើត....................................
                                ប្រភេទប័ណ្ណ.............................................. <br>
                                ប័ណ្ណសំគាល់លេខ............................................
                                ត្រូវជា.................................................. <br>
                            @else
                                និងឈ្មោះ<b class="mr-2 ml-2">{{ $data->getGuaranteed->fullName() }}</b>
                                ភេទ <b class="mr-2 ml-2">{{ $data->getGuaranteed->Sex() }}</b>
                                ថ្ងៃខែឆ្នាំកំណើត <b class="mr-2 ml-2">{{ \Carbon\Carbon::parse($data->getGuaranteed->dob)->format('d-m-Y') }}</b>
                                ប្រភេទប័ណ្ណ <b class="mr-2 ml-2">{{ $data->getGuaranteed->getIdentify->name_kh }}</b> 
                                ប័ណ្ណសំគាល់លេខ <b class="mr-2 ml-2">{{ $data->getGuaranteed->it_no }}</b> 

                                ត្រូវជា <b class="mr-2 ml-2">{{ $data->gx_type }}</b> <br>
                            @endif
                        @endif
                            មានអាសយដ្ឋានបច្ចុប្បន្ន ផ្ទះលេខ <b class="mr-3 ml-3">{{ $data->getClient->home }}</b>

                            ផ្លូវ/ក្រុម  <b class="mr-3 ml-3">{{ $data->getClient->group }}</b> 

                            ភូមិ  <b class="mr-2 ml-2">{{ $data->getClient->getVillage->village_namekh }}</b> 

                            ឃុំ/សង្កាត់ <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->commune_namekh }}</b> 

                            ស្រុក/ខណ្ឌ/ក្រុង <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->district->district_namekh }}</b>

                            ខេត្ត/រាជធានី <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->district->province->province_kh_name }}</b>  <br>
                            
                            លេខទូរសព្ទ <b class="mr-2 ml-2">{{ \Hel::phoneDisplay($data->getClient->phone) }} {{ $data->getClient->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getClient->phone2) : '' }}</b>  ។ <br>
                            <span class="mr-5"></span>យើងខ្ញុំទាំងពីរបានជួលយានយន្តពីឈ្មោះ.......................................
                            ភេទ........
                            អត្តសញ្ញាណប័ណ្ណលេខ................................................ <br>
                            ដែលមានអាសយដ្ឋាន ផ្ទះលេខ........ផ្លូវ/ក្រុម.........
                            ភូមិ.........................
                            ឃុំ/សង្កាត់...........................
                            ស្រុក/ខណ្ឌ/ក្រុង.................................... <br>
                            ខេត្ត/រាជធានី.........................................................
                            ដូចមានបញ្ជាក់ខាងក្រោម ៖
                        
                        @php 
                            $i = $data->getCollaterals()->offset(0)->limit(2)->get()
                        @endphp
                        <table class="table mt-3 table-bordered border-black">
                            <tbody>
                                <tr>
                                    <td class="text-center pt-1 pb-1">ព័ត៌មានយានយន្ត</td>
                                    <td class="text-center pt-1 pb-1">
                                        @if ($i->count() >= 1)
                                            <i class="far fa{{$i[0]->type == 1 ? "-check" : ""}}-square mr-1"></i> ម៉ូតូ
                                            <i class="far fa{{$i[0]->type == 2 ? "-check" : ""}}-square mr-1 ml-3"></i> ឡាន ទី១
                                        @endif
                                    </td>
                                    <td class="text-center pt-1 pb-1">
                                        @if ($i->count() >= 2)
                                            <i class="far fa{{$i[1]->type == 1 ? "-check" : ""}}-square mr-1"></i> ម៉ូតូ
                                            <i class="far fa{{$i[1]->type == 2 ? "-check" : ""}}-square mr-1 ml-3"></i> ឡាន ទី២
                                        @else
                                            <i class="far fa-square mr-1"></i> ម៉ូតូ
                                            <i class="far fa-square mr-1 ml-3"></i> ឡាន ទី២
                                        @endif
                                    </td>
                                    <td class="text-center pt-1 pb-1">
                                        @if ($i->count() >= 3)
                                            <i class="far fa{{$i[2]->type == 1 ? "-check" : ""}}-square mr-1"></i> ម៉ូតូ
                                            <i class="far fa{{$i[2]->type == 2 ? "-check" : ""}}-square mr-1 ml-3"></i> ឡាន ទី៣
                                        @else
                                            <i class="far fa-square mr-1"></i> ម៉ូតូ
                                            <i class="far fa-square mr-1 ml-3"></i> ឡាន ទី៣
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="pt-1 pb-1">លេខម៉ាស៊ីន</td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->marchine }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->marchine }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->marchine }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-1 pb-1">លេខតួ</td>
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->body }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->body }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->body }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">បង្កាន់ដៃបង់ពន្ធ/ស្លាកលេខ</td>
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->iden }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->iden }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->iden }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">ពណ៌</td>
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->color }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->color }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->color }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">ឆ្នាំផលិត</td>
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->year }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->year }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->year }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="pt-1 pb-1">ម៉ូដែល</td>
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 1)
                                            {{ $i[0]->model }} {{ $i[0]->extra }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 2)
                                            {{ $i[1]->model }} {{ $i[1]->extra }}
                                        @endif
                                    </td>
                                    
                                    <td class="pt-1 pb-1 text-bold text-center1">
                                        @if($i->count() >= 3)
                                            {{ $i[2]->model }} {{ $i[2]->extra }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="ml-5">
                            យើងខ្ញុំជាអ្នកជួលសូមសន្យាថា ៖ <br>
                            ១ ប្រើប្រាស់យានយន្តដែលបានជួលខាងលើក្នុងគ្រប់ទម្រង់ដែលមិនផ្ទុយពីច្បាប់នៃព្រះរាជាណាចក្រកម្ពុជា <br>
                            ២ ប្រើប្រាស់យានយន្តសម្រាប់មធ្យោបាយធ្វើដំណើរប្រចាំថ្ងៃ និងថែទាំអោយនៅសភាពល្អធម្មតា <br>
                            ៣ បង់ថ្លៃជួលអោយបានទៀងទាត់ <br>
                            ៤ មិនយកយានយន្តដែលបានជួល ទៅជួលបន្តអោយជនទីបីដោយគ្មានការព្រមព្រៀងពីភាគីម្ចាស់យានយន្ត <br>
                            ៥ មិនយកយានយន្តដែលបានជួលយកទៅកែច្នៃខុសបច្ចេកទេសយានយន្ត <br>
                            ៦ មិនយកយានយន្តដែលបានជួលទៅដាក់បញ្ចាំ 
                        </p>
                        <p>
                            <span class="ml-5"></span>ក្នុងករណីដែលយើងខ្ញុំបានប្រព្រឹត្តផ្ទុយពីលក្ខខ័ណ្ឌដែលបានចែងខាងលើ យើងខ្ញុំសុខចិត្តប្រគល់យានយន្តអោយភាគីម្ចាស់យានយន្ត ឬអោយភាគម្ចាស់យានយន្តធ្វើការដកហូតដោយឥតលក្ខខ័ណ្ឌ និងព្រមទទួលខុសត្រូវចំពោះមុខច្បាប់ចំពោះទង្វើរបស់យើងខ្ញុំ ។
                        </p>
                        
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6 text-right">
                                ធ្វើនៅបាត់ដំបង ថ្ងៃទី........ខែ...............ឆ្នាំ..............
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-5 text-center">
                                <b>ភាគីអ្នកជួល</b>
                                <div class="row justify-content-around">
                                    <div class="col-sm-61">
                                        <span class="d-block" style="margin-top: 140px;">ឈ្មោះ &nbsp;&nbsp;{{ $data->getClient->fullName() }}</span>
                                    </div>
                                    @if ($data->join_with != null)
                                    <div class="col-sm-61">
                                        
                                        
                                        <span class="d-block" style="margin-top: 140px;">ឈ្មោះ &nbsp;&nbsp;{{ $data->getJoin->fullName() }}</span>
                                       
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3 text-center">
                                
                                @if($data->guaranteed != null)
                                
                                <b>សាក្សី</b>
                                <span class="d-block" style="margin-top: 140px;">ឈ្មោះ &nbsp;&nbsp;{{ $data->getGuaranteed->fullName() }}</span>
                                @endif
                            </div>
                            <div class="col-sm-4 text-center">
                                <b>ភាគីម្ចាស់យានយន្ត</b>
                                <span class="d-block" style="margin-top: 140px;">ឈ្មោះ.............................</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>