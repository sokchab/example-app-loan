<form action="{{ route("collection.return") }}" role="search" method="get">
    <div class="row">
        {{--
        <div class="col-sm-2">
            <div class="custom-control custom-radio" style="margin-top: 4px; margin-left: 4px;">
                <input class="custom-control-input" value="loan" type="radio" id="customRadio1"
                       name="op" {{ old('op',$nest->op)=='loan' ? 'checked' : '' }}>
                <label for="customRadio1" class="custom-control-label" style="cursor: pointer;">លេខគណនី</label>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="custom-control custom-radio" style="margin-top: 4px;">
                <input class="custom-control-input" value="client" type="radio" id="customRadio2"
                       name="op" {{ old('op',$nest->op)=='client' ? 'checked' : '' }}>
                <label for="customRadio2" class="custom-control-label" style="cursor: pointer;">ឈ្មោះអតិថិជន</label>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="custom-control custom-radio" style="margin-top: 4px;">
                <input class="custom-control-input" value="other" type="radio" id="customRadio3"
                       name="op" {{ old('op',$nest->op)=='other' ? 'checked' : '' }}>
                <label for="customRadio3" class="custom-control-label" style="cursor: pointer;">ផ្សេងៗ</label>
            </div>
        </div> 
        --}}
        {{-- <div class="col-sm-6">
            <div class="input-group input-group-sm">
                <input type="text" name="q" class="form-control float-right"
                       value="{{ old('q',$nest->q) }}"
                       placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-6">
            <input type="text" name="q" class="form-control float-right"
                       value="{{ old('q',$nest->q) }}"
                       placeholder="Search">
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fas fa-search mr-1"></i> ស្វែងរក
            </button>
        </div>
    </div>
</form>
