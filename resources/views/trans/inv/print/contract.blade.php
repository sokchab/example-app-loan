<section class="content page-break print_white">
    <div class="container-fluid print_white" style="color: black !important;">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3 line-h">
                    <h5 class="text-center __Svayreing__ mb-3 f_22px">ព្រះរាជាណាចក្រកម្ពុជា</h5>
        
                    <div class="row for-print-a4">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <h5 class="text-center __Svayreing__ f_22px">ជាតិ សាសនា ព្រះមហាក្សត្រ</h5>
                        </div>
                        <div class="col-4 text-center">
                            <b class="text-center __Content__ text-primary text-18">លេខគណនី៖</b>
                        </div>
                    </div>
        
                    <div class="row for-print-a4">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <h6 class="text-center __TACTENG__ mb-4">rrr2sss</h6>
                        </div>
                        <div class="col-4 text-center">
                            <b class="text-center __Content__ text-primary text-18">{{ $data->acc_number }}</b>
                        </div>
                    </div>
        
                    <div class="for-print-a4 __Content__">
                        <h5 class="text-center mb-3 __Niroth__ un-line">កិច្ចសន្យាខ្ចីចងការប្រាក់</h5>
                        <b class="text-center __Content__ d-block mb-2">កិច្ចសន្យានេះត្រូវបានធ្វើឡើងដោយ និងរវាង</b>  
        
                        លោក/លោកស្រី.............................
                        ថ្ងៃខែឆ្នាំកំណើត......................
                        សញ្ជាតិ <b class="mr-1">ខ្មែរ</b> អត្តសញ្ញាណប័ណ្ណលេខ.......................
                        តទៅនេះហៅកាត់ថា <b> ភាគី “ ក ”</b> ។
        
                        <b class="text-center d-block mt-3 mb-2 un-line">និង</b>
        
                        {{-- \Hel::num2khtext("11989",true) --}}
        
                        លោក/លោកស្រី <b class="mrl">{{ $data->getClient->fullName() }}</b> 
                        ថ្ងៃខែឆ្នាំកំណើត  <b class="mrl">{{ \Carbon\Carbon::parse($data->getClient->dob)->format('d-m-Y') }} </b>
                        កាន់{{ $data->getClient->getIdentify->name_kh }}លេខ <b class="mrl">{{ $data->getClient->identify_no }}</b>
                        ចុះថ្ងៃទី <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getClient->identify_register)->format('d') }}</b> 
                        ខែ <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getClient->identify_register)->format('m') }}</b>
                        ឆ្នាំ <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getClient->identify_register)->format('Y') }}</b> <br>

                        ទូរស័ព្ទលេខ <b class="mrl">{{ \Hel::phoneDisplay($data->getClient->phone) }} {{ $data->getClient->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getClient->phone2) : '' }}</b>

                        មុខរបរ <b class="mrl">{{ $data->getClient->occupation }}</b>
                        ទីតាំងមុខរបរ <b class="mrl">{{ $data->getClient->add_occupation }}</b> <br>
                        មានទីលំនៅបច្ចុប្បន្ន ផ្ទះលេខ <b class="mr-2 ml-2">{{ $data->getClient->home }}</b> 
                        ផ្លូវ/ក្រុម <b class="mr-2 ml-2">{{ $data->getClient->group }}</b> 
                        ភូមិ <b class="mr-2 ml-2">{{ $data->getClient->getVillage->village_namekh }}</b>
                        ឃុំ/សង្កាត់ <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->commune_namekh }}</b>
                        ស្រុក/ក្រុង/ខណ្ឌ <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->district->district_namekh }}</b>
                        ខេត្ត/រាជធានី <b class="mr-2 ml-2">{{ $data->getClient->getVillage->commune->district->province->province_kh_name }}</b> ។ 
                        
                        @if( $data->join_with != null )
                        <br><br>
                            លោក/លោកស្រី <b class="mrl">{{ $data->getJoin->fullName() }}</b> 
                            ថ្ងៃខែឆ្នាំកំណើត <b class="mrl">{{ \Carbon\Carbon::parse($data->getJoin->dob)->format('d-m-Y') }}</b>
                            កាន់{{ $data->getJoin->getIdentify->name_kh }}លេខ  <b class="mrl">{{ $data->getJoin->it_no }}</b>
                            ចុះថ្ងៃទី <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getJoin->it_date)->format('d') }}</b>
                            ខែ <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getJoin->it_date)->format('m') }}</b>
                            ឆ្នាំ <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getJoin->it_date)->format('Y') }}</b> <br>

                            ទូរស័ព្ទលេខ <b class="mrl">{{ \Hel::phoneDisplay($data->getJoin->phone) }} {{ $data->getJoin->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getJoin->phone2) : '' }}</b>

                            មុខរបរ <b class="mrl">{{ $data->getJoin->occupation }}</b>

                            ត្រូវជា <b class="mrl">{{ $data->jx_type }}</b>

                            (<b>អ្នករួមខ្ចី</b>) &nbsp;
                            ទីតាំងមុខរបរ <b class="mrl">{{ $data->getJoin->occ_address }}</b> <br>
                            មានទីលំនៅបច្ចុប្បន្ន ផ្ទះលេខ <b class="mr-2 ml-2">{{ $data->getJoin->home }}</b>  
                            ផ្លូវ/ក្រុម <b class="mr-2 ml-2">{{ $data->getJoin->group }}</b> 
                            ភូមិ <b class="mr-2 ml-2">{{ $data->getJoin->getVillage->village_namekh }}</b>
                            ឃុំ/សង្កាត់ <b class="mr-2 ml-2">{{ $data->getJoin->getVillage->commune->commune_namekh }}</b>
                            ស្រុក/ក្រុង/ខណ្ឌ <b class="mr-2 ml-2">{{ $data->getJoin->getVillage->commune->district->district_namekh }}</b>
                            ខេត្ត/រាជធានី <b class="mr-1 ml-1">{{ $data->getJoin->getVillage->commune->district->province->province_kh_name }}</b> ។ 
                            
                        @endif
                        <br>
                            (<b>ជាភាគីកូនបំណុល</b>) តទៅនេះហៅកាត់ថា <b>ភាគី “ ខ ”</b> ។
        
                        @if( $data->guaranteed != null )
                            <b class="text-center d-block mt-3 mb-2 un-line">និង</b>
        
                            លោក/លោកស្រី <b class="mrl">{{ $data->getGuaranteed->fullName() }}</b>
                            ថ្ងៃខែឆ្នាំកំណើត <b class="mrl">{{ \Carbon\Carbon::parse($data->getGuaranteed->dob)->format('d-m-Y') }}</b>
                            កាន់{{ $data->getGuaranteed->getIdentify->name_kh }}លេខ <b class="mr-2 ml-2">{{ $data->getGuaranteed->it_no }}</b> 
                            ចុះថ្ងៃទី <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getGuaranteed->it_date)->format('d') }}</b>
                            ខែ <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getGuaranteed->it_date)->format('m') }}</b>
                            ឆ្នាំ <b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getGuaranteed->it_date)->format('Y') }}</b> 
                            <br>
                            ទូរស័ព្ទលេខ <b class="mrl">
                                {{ \Hel::phoneDisplay($data->getGuaranteed->phone) }}
                                {{ $data->getGuaranteed->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getGuaranteed->phone2) : '' }}
                            </b>

                            មុខរបរ<b class="mrl">{{ $data->getGuaranteed->occupation }}</b>

                            ត្រូវជា  <b class="mrl">{{ $data->gx_type }}</b>  &nbsp; (<b>ជាអ្នកធានា</b>) 

                            ទីតាំងមុខរបរ  <b class="mrl">{{ $data->getGuaranteed->occ_address }}</b>
                            <br>
                            មានទីលំនៅបច្ចុប្បន្ន ផ្ទះលេខ <b class="mrl">{{ $data->getGuaranteed->home }}</b>
                            ផ្លូវ/ក្រុម <b class="mrl">{{ $data->getGuaranteed->group }}</b>
                            ភូមិ <b class="mrl">{{ $data->getGuaranteed->getVillage->village_namekh }}</b>
                            ឃុំ/សង្កាត់ <b class="mrl">{{ $data->getGuaranteed->getVillage->commune->commune_namekh }}</b>
                            ស្រុក/ក្រុង/ខណ្ឌ <b class="mrl">{{ $data->getGuaranteed->getVillage->commune->district->district_namekh }}</b>
                            ខេត្ត/រាជធានី <b class="mr-1 ml-1">{{ $data->getGuaranteed->getVillage->commune->district->province->province_kh_name }}</b> ។
                            
                        @endif
        
                        @if( $data->guaranteed_join != null )
                        <br>
                            <br>
                            លោក/លោកស្រី <b class="mrl">{{ $data->getGuaranteedJoin->fullName() }}</b>
                            ថ្ងៃខែឆ្នាំកំណើត <b class="mrl">{{ \Carbon\Carbon::parse($data->getGuaranteedJoin->dob)->format('d-m-Y') }}</b>
                            កាន់{{ $data->getGuaranteedJoin->getIdentify->name_kh }}លេខ  <b class="mrl">{{ $data->getGuaranteedJoin->it_number }}</b>
                            ចុះថ្ងៃទី<b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getGuaranteedJoin->it_date)->format('d') }} </b>
                            ខែ<b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getGuaranteedJoin->it_date)->format('m') }} </b>
                            ឆ្នាំ<b class="mr-1 ml-1">{{ \Carbon\Carbon::parse($data->getGuaranteedJoin->it_date)->format('Y') }} </b>
        
                            <br>
                            ទូរសព្ទលេខ<b class="mrl">
                                {{ \Hel::phoneDisplay($data->getGuaranteedJoin->phone) }}
                                {{ $data->getGuaranteedJoin->phone2 != null ? ' , ' . \Hel::phoneDisplay($data->getGuaranteedJoin->phone2) : '' }}
                            </b>

                            មុខរបរ<b class="mrl">{{ $data->getGuaranteedJoin->occupation }}</b>

                            ត្រូវជា<b class="mrl">{{ $data->gxj_type }}</b>(<b>ជាអ្នករួមធានា</b>) 

                            ទីតាំងមុខរបរ<b class="mrl">{{ $data->getGuaranteedJoin->company_name }}</b>
                            <br> 
                            មានទីលំនៅបច្ចុប្បន្ន ផ្ទះលេខ<b class="mrl">{{ $data->getGuaranteedJoin->home }}</b>
                            ផ្លូវ/ក្រុម<b class="mrl">{{ $data->getGuaranteedJoin->group }}</b>
                            ភូមិ<b class="mrl">{{ $data->getGuaranteedJoin->getVillage->village_namekh }}</b>
                            ឃុំ/សង្កាត់<b class="mrl">{{ $data->getGuaranteedJoin->getVillage->commune->commune_namekh }}</b>
                            ស្រុក/ក្រុង/ខណ្ឌ<b class="mrl">{{ $data->getGuaranteedJoin->getVillage->commune->district->district_namekh }}</b>
                            ខេត្ត/រាជធានី <b class="mr-1 ml-1">{{ $data->getGuaranteedJoin->getVillage->commune->district->province->province_kh_name }}</b> ។ 
                            
        
                        @endif
        
                        @if($data->guaranteed != null || $data->guaranteed_join != null)
                        <br>
                            (<b>ជាភាគីអ្នកធានា</b>) តទៅនេះហៅកាត់ថា <b>ភាគី “ គ ”</b> ។
                        @endif
                            <br>
                            <h5 class="text-center mt-3 mb-2 __MEF2__ un-line">ការព្រមព្រៀង និងលក្ខន្ទិកៈ</h5>
        
                        {{-- ប្រការ ១ ៖ --}}

                            <b class="__MEF2__ un-line">ប្រការ ១ ៖ </b>&nbsp; <b>ភាគី “ ខ ”</b> 
                            យល់ព្រមខ្ចីប្រាក់ពី <b>ភាគី “ ក ”</b> ហើយ <b>ភាគី “ ក ”</b> សម្រេចផ្តល់ប្រាក់កម្ចីដល់ <b>ភាគី “ ខ ”</b> តាមលក្ខខណ្ឌដូចខាងក្រោម៖
                            <br>
                        ១.‌១. <b>ភាគី “ ខ ”</b> យល់ព្រមបង់ប្រាក់អោយ <b>ភាគី “ ក ”</b> 
                            ចំនួន <b class="pr-3 pl-3 f_17">{{ number_format($data->booking) }} $</b>
                            នៃតំលៃ <b class="pr-3 pl-3 f_17">{{ number_format($data->amount_price) }} $</b>
                            ហើយ <b>ភាគី “ ខ ”</b> បានខ្ចីប្រាក់ពី <b>ភាគី “ ក ”</b> 
                            <br>
                            <span class="mr-3"></span> ចំនួន (ជាលេខ) <b class="pl-3 pr-3 f_17">{{ number_format($data->balance) }} $</b>
                            (ជាអក្សរ) <b class="mrl">{{ \Hel::float2khtext($data->balance,true) }}ដុល្លារអាមេរិកគត់</b>
                            <br>
                            <span class="mr-3"></span>
                            នៅថ្ងៃទី <b class="mrl f_17">{{ \Carbon\Carbon::parse($data->date_disburst)->format('d') }}</b>
                            ខែ <b class="mrl f_17">{{ \Carbon\Carbon::parse($data->date_disburst)->format('m') }}</b>
                            ឆ្នាំ <b class="mrl f_17">{{ \Carbon\Carbon::parse($data->date_disburst)->format('Y') }}</b>
                            ដើម្បីយកទៅ 
        
                            @if($data->loan_purple == 1)
                                <i class="far fa-check-square mr-1 ml-3"></i>ទិញម៉ូតូ
                                <i class="far fa-square mr-1 ml-3"></i>ទិញឡាន
                                <i class="far fa-square mr-1 ml-3"></i>
                                ផ្សេងៗ.........................................................................។
                            @elseif($data->loan_purple == 2)
                                <i class="far fa-square mr-1 ml-3"></i>ទិញម៉ូតូ
                                <i class="far fa-check-square mr-1 ml-3"></i>ទិញឡាន
                                <i class="far fa-square mr-1 ml-3"></i>
                                ផ្សេងៗ.........................................................................។
                            @else
                                <i class="far fa-square mr-1 ml-3"></i>ទិញម៉ូតូ
                                <i class="far fa-square mr-1 ml-3"></i>ទិញឡាន
                                <i class="far fa-check-square mr-1 ml-3"></i>
                                ផ្សេងៗ.........................................................................។
                            @endif    
        
                            <br>
                            ១.២. អត្រាការប្រាក់ <b class="mr-2 ml-2 f_17">{{ $data->interest_rate }} %</b>  
                                (<b>{{ \Hel::float2khtext($data->interest_rate,true) }}ភាគរយ</b>) &nbsp;&nbsp;
                                ក្នុង <b>មួយ</b>
                                @if($data->rate_per == 1)
                                    ខែ
                                @elseif($data->rate_per == 2)
                                    សបា្ដហ៍
                                @else 
                                    ថ្ងៃ
                                @endif
        
                                (ប្រើរូបមន្ត <i class="far fa-check-square mr-1 ml-2"></i>វិធីសាស្រ្តរំលស់ថេរ 
                                Amortizing Method  <br>
                                <i class="far fa-square mr-1 ml-3"></i>វិធីសាស្រ្តរំលស់ដើម ការថេរ)
                                
                                <span class="mr-3"></span> រយៈពេលប្រាក់កម្ចី <b class="ml-2 f_17">{{ $data->term }}</b><b class="ml-1 mr-2">ខែ</b>
                                គិតចាប់ពីថ្ងៃទីទទួលយកប្រាក់កម្ចី ថ្ងៃទី <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->date_disburst)->format('d') }}</b>
                                ខែ <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->date_disburst)->format('m') }}</b>
                                ឆ្នាំ <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->date_disburst)->format('Y') }}</b>
                                <br><span class="mr-3"></span>ដល់ថ្ងៃដែលត្រូវបង់ប្រាក់ លើកចុងក្រោយ ដូចមានបញ្ជាក់ 
                                នៅក្នុងតារាងកាលវិភាគសងប្រាក់ដែលមានដាក់ភ្ជាប់មកជាមួយ ។
                                <br>
                                ១.៣. របៀបសងត្រឡប់ប្រាក់កម្ចី៖ សងរំលស់ប្រាក់ដើមនិងការប្រាក់ចំនួន <b class="mr-2 ml-2 f_17">{{ number_format($data->amount_pay) }} $</b>
                                    (<b>{{ \Hel::float2khtext($data->amount_pay,true) }}ដុល្លារអាមេរិកគត់</b>)
                                    នៅរៀង រាល់មួយខែម្តង
                                    <br><span class="mr-3"></span>
                                    នៅថ្ងៃទី <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->pay_day)->format('d') }}</b>
                                    ចាប់ពីថ្ងៃទី <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->pay_day)->format('d') }}</b>
                                    ខែ <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->pay_day)->format('m') }}</b>
                                    ឆ្នាំ <b class="mr-3 ml-2 f_17">{{ \Carbon\Carbon::parse($data->pay_day)->format('Y') }}</b>
                                    វេលាម៉ោង<b> 10ព្រឹក </b>យ៉ាងយូរ ។ ទីកន្លែងបង់ប្រាក់ <b class="ml-2">{{ $data->pay_place }}</b>
                                    <br>
                                    ១.៤. តាមស្មារតីនៃកិច្ចសន្យានេះ និងដើម្បីធានាបំណុលទាំងដើមទាំងការ <b>ភាគី “ ខ ”</b> បានសម្រេចដាក់បញ្ចាំនូវ៖
                                        <br> <span class="mr-3"></span>
                                        <i class="far fa-square mr-1 ml-2"></i>ប័ណ្ណសំគាល់យានយន្ត/<i class="far fa-square mr-1 ml-2"></i>
                                        យានយន្ត របស់ឈ្មោះ.......................................និង.............................................
                                        <br>					                        
                                        <table class="table mt-3 table-bordered border-black">
                                            <tbody>
                                                <tr>
                                                    {{-- <td>ចំនួន</td> --}}
                                                    <td class="text-center pt-1 pb-1">ក្រុមហ៊ុនផលិត</td>
                                                    <td class="text-center pt-1 pb-1">ម៉ូដែល</td>
                                                    <td class="text-center pt-1 pb-1">ពណ៌</td>
                                                    <td class="text-center pt-1 pb-1">លេខម៉ាស៊ីន</td>
                                                    <td class="text-center pt-1 pb-1">លេខតួ</td>
                                                    <td class="text-center pt-1 pb-1">ឆ្នាំផលិត</td>
                                                    <td class="text-center pt-1 pb-1">ស្លាកលេខ/ប័ណ្ណសំគាល់</td>
                                                </tr>
                                                @foreach ($data->getCollaterals as $i)
                                                <tr>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->model }}</td>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->extra }}</td>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->color }}</td>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->marchine }}</td>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->body }}</td>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->year }}</td>
                                                    <td class="pt-1 pb-1 text-bold text-center">{{ $i->iden }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
        
                                        
                                        ១.៥. <b>ភាគី “ ខ ”</b> សន្យាថានឹងយកយានយន្ត ខាងលើមកបង្ហាញ <b>ភាគី “ ក ”</b> ដោយគ្មានលក្ខខណ្ឌនៅរៀងរាល់ខែពេលមកបង់ប្រាក់ឬនៅពេលដែល
                                        <br><span class="mr-3"></span>
                                        មានការជូនដំណឹងពី <b>ភាគី “ ក ”</b> ហើយ <b>ភាគី “ ខ ”</b> សន្យាថែរក្សាទោចក្រយានយន្តឬយានយន្តឲ្យបានល្អនិងធានា ជួសជុលយានយន្តរាល់ពេលខូចខាត ។
                                        <span class="mb-2 d-block"></span>

                        {{-- ប្រការ ២ ៖  --}}

                                        <b class="__MEF2__ un-line">ប្រការ ២ ៖ </b>&nbsp; ក្នុងករណីដែល <b>ភាគី “ ខ ”</b> មិនបានអនុវត្តតាមការសន្យាសងប្រាក់ដើម និងការប្រាក់ដូចមានចែងក្នុងបញ្ញាតិ នៃប្រការ១ ខាងលើទេ 
                                        <b>ភាគី “ ខ ”</b>
                                        <br><span class="mr-3"></span> យល់ព្រមឲ្យ <b>ភាគី “ ក ”</b> អនុវត្តវិធានការដូចតទៅ៖ 
                                        <br>
                                        ២.១. ប្រសិនបើ <b>ភាគី “ ខ ”</b> មិនបានបំពេញកាតព្វកិច្ចសងប្រាក់ទាន់ពេលវេលាកំណត់ក្នុងតារាងសងប្រាក់ទេ <b>ភាគី “ ខ ”</b> សន្យាថាសុខចិត្តបង់ប្រាក់
                                        <br><span class="mr-3"></span>
                                        ពិន័យចំនួន <span class="mr-2"></span>
        
                                        @if ($data->penalty==1)
                                            <i class="far fa-square mr-1 ml-3"></i>១% (មួយភាគរយ) 
                                            <i class="far fa-check-square mr-1 ml-3"></i>១$ (មួយដុល្លារ) ក្នុងមួយថ្ងៃ នៃទឹកប្រាក់ត្រូវបង់ប្រចាំខែ 
                                        @else
                                            <i class="far fa-check-square mr-1 ml-3"></i>១% (មួយភាគរយ) 
                                            <i class="far fa-square mr-1 ml-3"></i>១$ (មួយដុល្លា) ក្នុងមួយថ្ងៃ នៃទឹកប្រាក់ត្រូវបង់ប្រចាំខែ  
                                        @endif

{{--                                        (ចំនួនថ្ងៃនៃការពិន័យត្រូវបានលើកលែងចំពោះ <br><span class="mr-3"></span> ថ្ងៃចុងសប្ដាហ៍ --}}
{{--                                         និង ថ្ងៃបុណ្យជាតិ) ។ --}}
                                        នាកំឡុងពេលនៃការយឺតយ៉ាវនេះ <b>ភាគី “ ក ”</b> <br>     <span class="mr-3"></span>
                                        មានសិទ្ធិគ្រប់គ្រាន់ក្នុងការចុះសាកសួរព័ត៌មានអំពីមូលហេតុដែលបណ្តាល
                                        ឲ្យមានការយឺតយ៉ាវ ដើម្បីរកដំណោះស្រាយ។
                                        <br>
                                        ២.២. ក្នុងករណី <b>ភាគី “ ខ ”</b> មានបំណង់ចង់រំលស់ប្រាក់ដើមឬបង់ផ្តាច់មុនកាលកំណត់ <b>ភាគី “ ខ ”</b> ត្រូវបង់ប្រាក់ពិន័យ 5% (ប្រាំភាគរយ) <br><span class="mr-3"></span> នៃចំនួន
                                        
                                        ប្រាក់ដើមដែលបានបង់​ ។
                                        <br>
                                        ២.៣. ក្នុងករណីដែលខកខានមិនបានសងបំណុលតាមបញ្ញាត្តិចែងក្នុងចំណុច ១.២ និង ១.៣ កន្លងផុតរយៈពេលមួយ(១)ខែ <b>ភាគី “ ខ ”</b> យល់ព្រមប្រគល់
                                        ទោចក្រយានយន្ត
                                        <br><span class="mr-3"></span>
                                        ឬយានយន្តដែលបានដាក់បញ្ចាំជូន <b>ភាគី “ ក ”</b> តែមួយគត់ដើម្បីចាត់ចែងលក់ឡាយឡុងយកប្រាក់មកសងបំណុលដែលជំពាក់ទាំងស្រុងរួមទាំងប្រាក់ដើម
                                        <br><span class="mr-3"></span> ការប្រាក់ និងប្រាក់ពិន័យផ្សេងទៀត ។ ក្រោយពីការទូទាត់បំណុលជូន <b>ភាគី “ ក ”</b> ទាំងស្រុងហើយថវិការ
                                        ដែលនៅសល់ត្រូវប្រគល់ជូន <b>ភាគី “ ខ ”</b> វិញ ។
                                        <br>
                                        <b class="un-line">បញ្ជាក់៖</b>&nbsp; ភាគីដទៃទៀតរួមទាំងម្ចាស់បំណុលផ្សេងទៀតពុំមានសិទ្ធិរារាំង <b>ភាគី “ ក ”</b> ក្នុងការលក់ឡាយឡុងទោចក្រយានយន្តឬយានយន្តដែលបានដាក់បញ្ចាំដូចមានរៀបរាប់ក្នុងកិច្ចសន្យាខ្ចីចងការប្រាក់និងដាក់បញ្ចាំនេះបានឡើយ។ ករណីមិនទាន់បានសងគ្រប់ <b>ភាគី “ ខ ”</b> ត្រូវមានកាតព្វកិច្ចសងបំណុលដែលនៅសល់បន្ថែមរហូតទាល់តែគ្រប់ចំនួន ។
                                        <br>
                                        ២.៤. ក្នុងករណីចំនុច ១.៥ នៃប្រការ១ មិនត្រូវបានគោរព <b>ភាគី “ ក ”</b> មានសិទ្ធិគ្រប់គ្រាន់ក្នុងការបញ្ចប់កិច្ចសន្យាមុនកាលកំណត់ដោយតម្រូវឲ្យ 
                                        <b>ភាគី “ ខ ”</b><br><span class="mr-3"></span> សងត្រឡប់មកវិញនូវប្រាក់ដើមទាំងអស់រួមជាមួយនឹងការប្រាក់រហូតដល់ចប់កិច្ចសន្យា ។
        

                    {{-- ប្រការ ៣ ៖ --}}
                                        <span class="mb-2 d-block"></span>
                                        <b class="__MEF2__ un-line">ប្រការ ៣ ៖ </b>&nbsp;
                                        <b> ភាគី “ ខ ”</b> គ្មានសិទ្ធិលក់ដូរ បញ្ចាំ ឬធ្វើអំណោយអោយទៅជនដទៃផ្សេងទៀតឡើយ ប្រសិនបើមិនបានបំពេញកាតព្វកិច្ចបង់ប្រាក់ <br><span class="mr-3"></span>
                                        បង្រ្គប់តាមកិច្ចសន្យានេះទេ ភាគី “ ខ ” សុខចិត្តទទួលខុសត្រូវពីបទល្មើសរំលោភលើទំនុកចិត្ត ឬឆបោកតាមច្បាប់ព្រហ្មទណ្ឌ ។
                    {{-- ប្រការ ៤ ៖ --}}
                                        <span class="mb-2 d-block"></span>
                                        <b class="__MEF2__ un-line">ប្រការ ៤ ៖ </b>&nbsp;
                                        <b>ភាគី “ គ ”</b> (<b>ភាគីអ្នកធានា</b>) បានធានានិងអះអាងទទួលខុសត្រូវលើបន្ទុកបំណុលរបស់ <b>ភាគី “ ខ ”</b> ទាំងស្រុងក្នុងករណីដែល
                                        <b>ភាគី “ ខ ”</b><br><span class="mr-3"></span> មិនបានអនុវត្តកាតព្វកិច្ចសន្យាដោយពុំមានលទ្ធភាពសង ឬគេចវេសពីកាតព្វកិច្ចរបស់ខ្លួន ។
                    {{-- ប្រការ ៥ ៖ --}}
                                        <span class="mb-2 d-block"></span>
                                        <b class="__MEF2__ un-line">ប្រការ ៥ ៖ </b>&nbsp;
                                        ក្នុងករណីបាត់បង់ ឬខូចខាត (យានយន្តដែលបានដាក់បញ្ចាំ) ដោយប្រការណាមួយមុនពេលបញ្ចប់កិច្ចសន្យា <b>ភាគី “ ក ”</b> មិនទទួល
                                        ខុសត្រូវឡើយ <br><span class="mr-3"></span> ហើយ <b>ភាគី “ ខ ”</b> និងអ្នកធានាត្រូវមានកាតព្វកិច្ចទទួលខុសត្រូវលើការសងបំណុលដែលនៅសល់នោះទាំងស្រុង 
                                        រួមមានប្រាក់ដើមនិងការប្រាក់ ។
                    {{-- ប្រការ ៦ ៖ --}}
                                        <span class="mb-2 d-block"></span>
                                        <b class="__MEF2__ un-line">ប្រការ ៦ ៖ </b>&nbsp;
                                        អំពីលក្ខខណ្ឌអវសាន
                                        <b>ភាគី “ ក ”</b> , <b>ភាគី “ ខ ”</b> និង <b>ភាគី “ គ ”</b> (<b>ភាគីអ្នកធានា</b>) 
                                        សន្យាគោរពយ៉ាងម៉ឺងម៉ាត់តាមរាល់ប្រការ និងបញ្ញាត្តិនានា
                                        <br><span class="mr-3"></span>នៃកិច្ចសន្យាខាងលើ ។ 
                                        ក្នុងករណីអនុវត្តផ្ទុយ ឬដោយរំលោភលក្ខខណ្ឌណាមួយនៃកិច្ចសន្យានេះ 
                                        ភាគីដែលល្មើសត្រូវទទួលខុសត្រូវចំពោះវិធានការច្បាប់<br><span class="mr-3"></span>ជាធរមាន ។
                                        រាល់សោហ៊ុយទាក់ទងក្នុងការដោះស្រាយទំនាស់វិវាទជាបន្ទុករបស់ភាគីដែលចាញ់ក្តី ។
                                        កិច្ចសន្យានេះត្រូវបានធ្វើឡើងដោយមានការព្រមព្រៀង<br><span class="mr-3"></span>ពិតប្រាកដនិងដោយសេរី គ្មានការបង្ខិតបង្ខំពីភាគីណាមួយឡើយ ហើយមានប្រសិទ្ធភាព
                                        អនុវត្តចាប់ពីថ្ងៃទទួលប្រាក់តទៅ ។
                                        
                    </div>
                    <br>
                    <div class="row for-print-a4 __Content__">
                        <div class="col-4"></div>
                        <div class="col-2"></div>
                        <div class="col-6">
                            <p class="text-right">បាត់ដំបង ថ្ងៃទី.............ខែ...............ឆ្នាំ...............</p>
                        </div>
                    </div>
        
                    <div class="d-flex justify-content-between for-print-a4 __Content__">
                        <div>
                            <p class="text-center">ស្នាមមេដៃស្តាំអ្នកខ្ចី <b>ភាគី “ ខ ”</b></p>
                            <p class="text-center sign-m">
                                {{ $data->getClient->fullName() }}
                            </p>
                        </div>
        
                        <div>
                            <p class="text-center">ស្នាមមេដៃស្តាំ (<b>អ្នករួមខ្ចី</b>)</p>
                            <p class="text-center sign-m">
                                @if($data->join_with == null)
                                    .....................................
                                @else
                                    {{ $data->getJoin->fullName() }}
                                @endif
                            </p>
                        </div>
        
                        <div>
                            <p class="text-center">ស្នាមមេដៃស្តាំ (<b>អ្នកធានា</b>)</p>
                            <p class="text-center sign-m">
                                @if($data->guaranteed == null)
                                    .....................................
                                @else
                                    {{ $data->getGuaranteed->fullName() }} 
                                @endif 
                            </p>
                        </div>
        
                        <div>
                            <p class="text-center">ស្នាមមេដៃស្តាំ (<b>អ្នករួមធានា</b>)</p>
                            <p class="text-center sign-m">
                                @if($data->guaranteed_join == null)
                                    .....................................
                                @else
                                    {{ $data->getGuaranteedJoin->fullName() }} 
                                @endif 
                                
                            </p>
                        </div>
        
                        <div>
                            <p class="text-center">ហត្ថលេខា និងត្រា <b>ភាគី “ ក ”</b></p>
                            <p class="text-center sign-m">
                                .....................................
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>