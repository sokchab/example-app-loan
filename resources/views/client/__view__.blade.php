@extends('layouts.app')
@section('title','Clients')

@section('client', 'active')    

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span>ព័ត៌មានអតិថិជន</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right __kh__">
                            <li class="breadcrumb-item"><span class="text-primary">ព័ត៌មានអតិថិជន</span></li>
                            {{-- <li class="breadcrumb-item active">ថ្មី</li> --}}
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title __kh__">
                            <a href="{{ route('clients.index') }}"><i class="fas fa-reply mr-1"></i>ត្រឡប់ក្រោយ</a>
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__key__" class="__kh__">លេខសម្គាល់</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__key__"
                                        value="{{ $cvs->cus_key }}"
                                        id="__key__" placeholder="Enter ..." readonly>
    
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__name__" class="__kh__">នាមត្រកូល</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__name__"
                                        value="{{ $cvs->last_name }}"
                                        id="__name__" placeholder="Enter ..." readonly>
    
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__name__" class="__kh__">នាមខ្លួន</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__name__"
                                        value="{{ $cvs->first_name }}"
                                        id="__name__" placeholder="Enter ..." readonly>
    
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__name_en__" class="__kh__">ជាអក្សរឡាតាំង</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__name_en__"
                                        value="{{ $cvs->fullNameEn() }}"
                                        id="__name_en__" placeholder="Enter ..." readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__gender__" class="__kh__">ភេទ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__gender__"
                                        value="{{ $cvs->gender ? "ប្រុស" : "ស្រី"  }}"
                                        id="__gender__" placeholder="Enter ..." readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__dob__" class="__kh__">ថ្ងៃខែឆ្នាំកំណើត</label>
                                    <input type="date" class="form-control __kh__"
                                        name="__dob__"
                                        value="{{ $cvs->dob }}"
                                        id="__dob__" placeholder="Enter ..." readonly>

                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__id_type__" class="__id_type__">ប្រភេទប័ណ្ឌសម្គាល់ខ្លួន</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__id_type__"
                                        value="{{ $cvs->getIdentify->name_kh }}"
                                        id="__id_type__" placeholder="Enter ..." readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__id_number__" class="__kh__">លេខប័ណ្ឌសម្គាល់ខ្លួន</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__id_number__"
                                        value="{{ $cvs->identify_no }}"
                                        id="__id_number__" placeholder="Enter ..." readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__id_register__" class="__kh__">ចុះថ្ងៃទី</label>
                                    <input type="date" class="form-control __kh__"
                                        name="__id_register__"
                                        value="{{ $cvs->identify_register }}"
                                        id="__id_register__" placeholder="Enter ..." readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__occupation__" class="__occupation__">មុខរបរ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__occupation__"
                                        value="{{ $cvs->occupation }}"
                                        id="__occupation__" placeholder="Enter ..." readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="add_occupation" class="__occupation__">ទីតាំងមុខរបរ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="add_occupation"
                                        value="{{ $cvs->add_occupation }}"
                                        id="add_occupation" placeholder="Enter ..." readonly>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="__phone__" class="__kh__">លេខទូរស័ព្ទ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__phone__"
                                        value="{{ \Hel::phoneDisplay($cvs->phone) }} , {{ Hel::phoneDisplay($cvs->phone2) }}"
                                        id="__phone__" placeholder="Enter ..." readonly>
                                </div>
                            </div>
                        </div>
                               

                    </div>   
                    {{-- End Card Body--}}
                    <div class="card-footer">
                        <a href="{{ route('clients.edit', $cvs->id) }}" class="btn btn-primary __kh__"><i class="fas fa-edit mr-2"></i>កែប្រែ</a>
                    </div>  
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" style="height: 584px">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__home__" class="__kh__">ផ្ទះលេខ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__home__"
                                        value="{{ $cvs->home }}"
                                        id="__home__" placeholder="Enter ..." readonly>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="__group__" class="__kh__">ក្រុមទី/ផ្លូវលេខ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__group__"
                                        value="{{ $cvs->group }}"
                                        id="__group__" placeholder="Enter ..." readonly>
                                </div>
                            </div>
                            
                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="__street__" class="__kh__">ផ្លូវលេខ</label>
                                    <input type="text" class="form-control __kh__"
                                        name="__street__"
                                        value="{{ $cvs->street }}"
                                        id="__street__" placeholder="Enter ..." readonly>
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group">
                            <label for="__province__" class="__kh__">ខេត្ត</label>
                            <input type="text" class="form-control __kh__"
                                        name="__province__"
                                        value="{{ $cvs->getVillage->commune->district->province->province_kh_name }}"
                                        id="__province__" placeholder="Enter ..." readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="__district__" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង</label>
                            <input type="text" class="form-control __kh__"
                                        name="__district__"
                                        value="{{ $cvs->getVillage->commune->district->district_namekh }}"
                                        id="__district__" placeholder="Enter ..." readonly>
                        </div>

                        <div class="form-group">
                            <label for="__commune__" class="__kh__">ឃុំ/សង្កាត់</label>
                            <input type="text" class="form-control __kh__"
                                        name="__commune__"
                                        value="{{ $cvs->getVillage->commune->commune_namekh }}"
                                        id="__commune__" placeholder="Enter ..." readonly>
                        </div>

                        <div class="form-group">
                            <label for="__village__" class="__kh__">ភូមិ</label>
                            <input type="text" class="form-control __kh__"
                                        name="__village__"
                                        value="{{ $cvs->getVillage->village_namekh }}"
                                        id="__village__" placeholder="Enter ..." readonly>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="__active__" class="__kh__">ស្ថានភាព</label>
                            <input type="text" class="form-control __kh__"
                                        name="__active__"
                                        value="{{ $cvs->is_active ? "ដំណើរការ" : "ផ្អាកដំណើរការ" }}"
                                        id="__active__" placeholder="Enter ..." readonly>
                        </div>
                    </div>
                         
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

