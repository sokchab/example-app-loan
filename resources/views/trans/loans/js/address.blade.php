
    <div class="col-sm-3">
        <div class="form-group">
            <label for="join__province" class="__kh__">ខេត្ត *</label>
            <select class="form-control __kh__ select2"
                    name="join__province"
                    id="join__province" style="width: 100%">
                @foreach ($data['province'] as $p)
                    <option value="{{ $p->province_id }}">{{ $p->province_kh_name.'-'.$p->province_en_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="join__district" class="__kh__">ស្រុក/ខណ្ឌ/ក្រុង *</label>
            <select name="join__district"
                    id="join__district"
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
            <label for="join__commune" class="__kh__">ឃុំ/សង្កាត់ *</label>
            <select name="join__commune"
                    id="join__commune"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label for="join__village" class="__kh__">ភូមិ *</label>
            <select name="join__village"
                    id="join__village"
                    class="form-control select2 __kh__" style="width: 100%;">
                <option selected>--ជ្រើសរើស--</option>
            </select>
        </div>
    </div>


    @section('join__village')
        let onj__province = $('#join__province');
        let onj__district = $('#join__district');
        let onj__commune = $('#join__commune');
        // let onj__village = $('#join__village');
        onj__province.change(function(e){
        e.preventDefault();
        let proId = $(this).val();
        $.ajax({
        url: "{{  route('communes.fetch.district', '') }}/" + encodeURI(proId),
        type: "GET",
        dataType: "json",
        success: (data) => {
        clearAll(true,true,true);
        $.each(data, (key, value) => {
        $('#join__district').append(`<option value="${value.id}">${value.text}-${value.text_en}</option>`);
        });
        }
        });
        });
        onj__district.change(function(e){
        e.preventDefault();
        let dis_id = $(this).val();
        $.ajax({
        url: "{{ route('villages.fetch.commune', '') }}/" + encodeURI(dis_id),
        type: "GET",
        dataType: "json",
        success: (data) =>{
        clearAll(false, true, true);
        $.each(data, (key, value) => {
        $('#join__commune').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
        });
        }
        });
        });
        onj__commune.change(function(e){
        e.preventDefault();
        let com = $(this).val();
        $.ajax({
        url: "{{ route('clients.fetch.village', '') }}/" + encodeURI(com),
        type: "GET",
        dataType: "json",
        success: (data)=>{
        clearAll(false,false,true);
        $.each(data, (key, value)=> {
        $('#join__village').append('<option value="'+ value.id +'">'+ value.text + '-' + value.text_en +'</option>');
        });
        }
        });
        });
    @endsection


    @section('clearAll')
        //Functions
        function clearAll1(dis,com,vil) {
        if (dis) {
        $("#cus__district").empty();
        $("#cus__district").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if (com){
        $("#cus__commune").empty();
        $("#cus__commune").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if(vil) {
        $("#cus__village").empty();
        $("#cus__village").append("<option selected>--ជ្រើសរើស--</option>");
        }
        }
        //Functions
        function clearAll(dis,com,vil) {
        if (dis) {
        $("#join__district").empty();
        $("#join__district").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if (com){
        $("#join__commune").empty();
        $("#join__commune").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if(vil) {
        $("#join__village").empty();
        $("#join__village").append("<option selected>--ជ្រើសរើស--</option>");
        }
        }
        //Functions
        function clearAlla(dis,com,vil) {
        if (dis) {
        $("#g__district").empty();
        $("#g__district").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if (com){
        $("#g__commune").empty();
        $("#g__commune").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if(vil) {
        $("#g__village").empty();
        $("#g__village").append("<option selected>--ជ្រើសរើស--</option>");
        }
        }


        //Functions
        function clearKok(dis,com,vil) {
        if (dis) {
        $("#kok__district").empty();
        $("#kok__district").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if (com){
        $("#kok__commune").empty();
        $("#kok__commune").append("<option selected>--ជ្រើសរើស--</option>");
        }
        if(vil) {
        $("#kok__village").empty();
        $("#kok__village").append("<option selected>--ជ្រើសរើស--</option>");
        }
        }
    @endsection