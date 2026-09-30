
    <div class="col-sm-3">
        <div class="form-group">
            <label for="g__province" class="__kh__">ខេត្ត *</label>
            <select class="form-control __kh__ select2"
                    name="g__province"
                    id="g__province" style="width: 100%">
                @foreach ($data['province'] as $p)
                    <option value="{{ $p->province_id }}">{{ $p->province_kh_name.'-'.$p->province_en_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="g__district" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង *</label>
            <select name="g__district"
                    id="g__district"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
                @foreach ($data['district'] as $dis)
                    <option value="{{ $dis->dis_id }}">{{ $dis->district_namekh.'-'.$dis->district_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="g__commune" class="__kh__">ឃុំ/សង្កាត់ *</label>
            <select name="g__commune"
                    id="g__commune"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="g__village" class="__kh__">ភូមិ *</label>
            <select name="g__village"
                    id="g__village"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>


@section('g__village')
    let onj__g_g_g_province = $('#g__province');
    let onj__g_g_g_district = $('#g__district');
    let onj__g_g_g_commune = $('#g__commune');
    // let onj__g_g_g_village = $('#g__village');
    onj__g_g_g_province.change(function(e){
    e.preventDefault();
    let proId = $(this).val();
    $.ajax({
    url: "{{  route('communes.fetch.district', '') }}/" + encodeURI(proId),
    type: "GET",
    dataType: "json",
    success: (data) => {
    clearAlla(true,true,true);
    $.each(data, (key, value) => {
    $('#g__district').append(`<option value="${value.id}">${value.text}-${value.text_en}</option>`);
    });
    }
    });
    });
    onj__g_g_g_district.change(function(e){
    e.preventDefault();
    let dis_id = $(this).val();
    $.ajax({
    url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
    type: "GET",
    dataType: "json",
    success: (data) =>{
    clearAlla(false, true, true);
    $.each(data, (key, value) => {
    $('#g__commune').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
    });
    }
    });
    });
    onj__g_g_g_commune.change(function(e){
    e.preventDefault();
    let com = $(this).val();
    $.ajax({
    url: "{{ route('clients.fetch.village', '') }}/" + encodeURI(com),
    type: "GET",
    dataType: "json",
    success: (data)=>{
    clearAlla(false,false,true);
    $.each(data, (key, value)=> {
    $('#g__village').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
    });
    }
    });
    });
@endsection