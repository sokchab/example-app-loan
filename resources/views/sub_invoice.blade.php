
 <div class="row for-print-a4 __Content__">
    <div class="col-3"></div>
     <div class="col-6">
         
         <img class="image_logo mr-4"
            src="{{ asset('public/template/images/hb-logo.svg') }}" 
            style="width: 85px !important; height: 60px !important;"
            alt="image">
         <div class="ml-4 text-center">
             
             <h4 class="username text-bold" style="font-size: 24px;">
                 ហាក់ ប៊ុនជា
             </h4>
             <span class="description mt-2" 
                 style="font-size: 20px; color: black; width: 100%;">
                 ទិញ លក់​ និងបង់រំលស់ម៉ូតូនិងឡាន
             </span>
         </div>
     </div>
     <div class="col-3"> 
         <b class="text-danger">
             OR# {{ $data->withDate(). str_pad($data->getNest->votes, 5, "0", STR_PAD_LEFT) }}
         </b> <br>
         Date : {{ \Carbon\Carbon::parse($data->paid_date)->format('d/m/Y') }}
     </div>
</div>

<div class="row for-print-a4 __Content__ mt-4">
    <div class="col-3"></div>
     <div class="col-6">
         <p class="text-center mb-0">
             អាសយដ្ឋាន ៖ ភូមិអូរចារ សង្កាត់អូរចារ ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង
             <br>
             (ខាងលិចព្រះនរាយន៍ដៃ៨ ចម្ងាយប្រហែល ៣០ម៉ែត្រ)
         </p>
     </div>
     <div class="col-3">
         <b>លេខទូរស័ព្ទវេរលុយ</b>
         <br>
         <b>088 838 8687 , 069 522 229</b>
        <br>
        {{-- <b>069 522 229</b> --}}
         <b>093 597 273 , 077 522 227</b>
     </div>
</div>
<div class="row for-print-a4 __Content__">
    <div class="col-3"></div>
    <div class="col-6 text-center">    
         <img src="{{ asset('public/template/images/facebook-square-brands.svg') }}" height="20px" class="mb-2 mr-1" alt="img">
         <a href="https://www.facebook.com/hakbunchea168" class="node-dsm" target="_blank">
             ហាក់ ប៊ុនជា ទិញលក់រំលស់ម៉ូតូនិងឡាន រង្វង់មូលដៃប្រាំបី បាត់ដំបង
         </a>
    </div>
    <div class="col-3">
        {{-- 
         <b>093 597 273</b>
         <br>
         <b>077 522 227</b>
        --}}
         <b>អាចវេរលុយតាម​ ៖</b> <br>
         <img height="40px" src="{{ asset('public/template/images/wing.png') }}" alt="wing">
         <img height="40px" src="{{ asset('public/template/images/truemoney.png') }}" alt="truemoney">
         <img height="40px" src="{{ asset('public/template/images/emoney.png') }}" alt="emoney">
    </div>
</div>

<div class="row for-print-a4 __Content__">
     <div class="col-3"></div>
     <div class="col-6">
         <h5 class="__Niroth__ un-line text-center">បង្កាន់ដៃទទួលប្រាក់</h5>
         <h6 class="text-center __TACTENG__ mb-4">rrr2sss</h6>
     </div>
     <div class="col-3 mt-2">
         {{-- 
         <b>អាចវេរលុយតាម​ ៖</b> <br>
         <img height="40px" src="{{ asset('public/template/images/wing.png') }}" alt="wing">
         <img height="40px" src="{{ asset('public/template/images/truemoney.png') }}" alt="truemoney">
         <img height="40px" src="{{ asset('public/template/images/emoney.png') }}" alt="emoney"> 
         --}}
         <img height="42px" class="mb-2" src="{{ asset('public/template/images/ABA.png') }}" alt="emoney"> 
         <img height="42px" src="{{ asset('public/template/images/aceleda.png') }}" alt="emoney"> 
     </div>
</div>


<div class="row for-print-a4 __Content__">
    <div class="col-1"></div>
    <div class="col-10">
         <div class="row">
             <div class="col-3 mt-1">
                 លេខគណនី : 
             </div>
             <div class="col-9" style="display: inline-table;">
                 @foreach (str_split($data->getCollection->getLoan->acc_number) as $item)
                     <b class="acc_box {{ $loop->last ? "acc_box_right" : "" }}">{{ $item }}</b> 
                 @endforeach
             </div>    
         </div>
         <div class="row mt-3">
             <div class="col-3">ឈ្មោះគណនី :</div>
             <div class="col-9">
                 <b>{{ $data->getCollection->getLoan->getClient->fullName() }}</b>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-3 mt-1">ចំនួនប្រាក់ជាលេខ :</div>
             <div class="col-9">
                <div class="row">
                    <div class="col-3">
                        <b class="acc_box acc_box_right d-inline-block text-center" style="width: 100%">
                            $ {{ number_format($data->hasPaid()) }}
                        </b> 
                    </div>
                    <div class="col-9 mt-1">
                        ចំនួនប្រាក់ជាអក្សរ : 
                        <b class="ml-1">
                            {{ \Hel::float2khtext($data->hasPaid(),true) }}ដុល្លារអាមេរិកគត់
                        </b>
                    </div>
                </div>
                 
                 
             </div>
         </div>
         <div class="row mt-3">
             <div class="col-3">
                 ផ្សេងៗ :
             </div>
             <div class="col-9 d_un_100">
                {{ $data->other }}
             </div>
         </div>
         <br>
         <div class="row mt-4">
             <div class="col-6 text-center">
                 បានទទួលប្រាក់ដោយ (បេឡា)
             </div>
             <div class="col-6 text-center">
                 បានបង់ប្រាក់ដោយ
             </div>
         </div>
         <br>
         <br>
         
         <br>

         
         <div class="row mt-1">
             <div class="col-6 text-center">
                 {{ $data->getUser->name }}
             </div>
             <div class="col-6 text-center">
                 {{ $data->paid_by }}
             </div>
         </div>
    </div>
    <div class="col-1"></div>
</div>