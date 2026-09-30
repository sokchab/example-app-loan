
    <div class="col-sm-3">
        <div class="form-group">
            <label for="cus__province" class="__kh__">ខេត្ត *</label>
            <select class="form-control __kh__ select2"
                    name="cus__province"
                    id="cus__province" style="width: 100%">
                @foreach ($data['province'] as $p)
                    <option value="{{ $p->province_id }}">{{ $p->province_kh_name.'-'.$p->province_en_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="cus__district" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង *</label>
            <select name="cus__district"
                    id="cus__district"
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
            <label for="cus__commune" class="__kh__">ឃុំ/សង្កាត់ *</label>
            <select name="cus__commune"
                    id="cus__commune"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="cus__village" class="__kh__">ភូមិ *</label>
            <select name="cus__village"
                    id="cus__village"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>

    @section('cus__village')
        let on__province = $('#cus__province');
        let on__district = $('#cus__district');
        let on__commune = $('#cus__commune');
        // let on__village = $('#cus__village');
        on__province.change(function(e){
        e.preventDefault();
        let proId = $(this).val();
        $.ajax({
        url: "{{  route('communes.fetch.district', '') }}/" + encodeURI(proId),
        type: "GET",
        dataType: "json",
        success: (data) => {
        clearAll1(true,true,true);
        $.each(data, (key, value) => {
        $('#cus__district').append(`<option value="${value.id}">${value.text}-${value.text_en}</option>`);
        });
        }
        });
        });
        on__district.change(function(e){
        e.preventDefault();
        let dis_id = $(this).val();
        $.ajax({
        url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
        type: "GET",
        dataType: "json",
        success: (data) =>{
        clearAll1(false, true, true);
        $.each(data, (key, value) => {
        $('#cus__commune').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
        });
        }
        });
        });
        on__commune.change(function(e){
        e.preventDefault();
        let com = $(this).val();
        $.ajax({
        url: "{{ route('clients.fetch.village', '') }}/" + encodeURI(com),
        type: "GET",
        dataType: "json",
        success: (data)=>{
        clearAll1(false,false,true);
        $.each(data, (key, value)=> {
        $('#cus__village').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
        });
        }
        });
        });
    @endsection