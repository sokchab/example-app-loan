
    <div class="col-sm-3">
        <div class="form-group">
            <label for="kok__province" class="__kh__">ខេត្ត *</label>
            <select class="form-control __kh__ select2"
                    name="kok__province"
                    id="kok__province" style="width: 100%">
                @foreach ($data['province'] as $p)
                    <option value="{{ $p->province_id }}">{{ $p->province_kh_name.'-'.$p->province_en_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="kok__district" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង *</label>
            <select name="kok__district"
                    id="kok__district"
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
            <label for="kok__commune" class="__kh__">ឃុំ/សង្កាត់ *</label>
            <select name="kok__commune"
                    id="kok__commune"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="kok__village" class="__kh__">ភូមិ *</label>
            <select name="kok__village"
                    id="kok__village"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>


@section('g__dara_kok')
    let kok__province_on = $('#kok__province');
    let kok__district_on = $('#kok__district');
    let kok__commune_on = $('#kok__commune');
    // let kok__village_on = $('#kok__village');
    kok__province_on.change(function(e){
    e.preventDefault();
    let proId = $(this).val();
    $.ajax({
    url: "{{  route('communes.fetch.district', '') }}/" + encodeURI(proId),
    type: "GET",
    dataType: "json",
    success: (data) => {
    clearKok(true,true,true);
    $.each(data, (key, value) => {
    $('#kok__district').append(`<option value="${value.id}">${value.text}-${value.text_en}</option>`);
    });
    }
    });
    });
    kok__district_on.change(function(e){
    e.preventDefault();
    let dis_id = $(this).val();
    $.ajax({
    url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
    type: "GET",
    dataType: "json",
    success: (data) =>{
    clearKok(false, true, true);
    $.each(data, (key, value) => {
    $('#kok__commune').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
    });
    }
    });
    });
    kok__commune_on.change(function(e){
    e.preventDefault();
    let com = $(this).val();
    $.ajax({
    url: "{{ route('clients.fetch.village', '') }}/" + encodeURI(com),
    type: "GET",
    dataType: "json",
    success: (data)=>{
    clearKok(false,false,true);
    $.each(data, (key, value)=> {
    $('#kok__village').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
    });
    }
    });
    });
@endsection