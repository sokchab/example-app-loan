{{-- <div class="row"> --}}
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                ទ្រព្យបញ្ចាំ
                <div class="card-tools">
                    <a href="{{ route("fix.coll.formCreate") }}" class="btn bg-gradient-navy btn-sm">
                        <i class="fas fa-motorcycle mr-1"></i> បន្ថែមថ្មី
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-condensed dataTable no-footer" 
                            style="margin-top: 0 !important;"
                            id="table_tmp_col">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ក្រុមហ៊ុនផលិត</th>
                                    <th>ម៉ូដែល</th>
                                    <th>ពណ៍</th>
                                    <th>លេខតួ</th>
                                    <th>លេខម៉ាស៊ីន</th>
                                    <th>ឆ្នាំផលិត</th>
                                    <th>ផ្លាក់លេខ/ប័ណ្ណសម្គាល់</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['cols'] as $it)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $it->model }}
                                        </td>
                                        <td>
                                            {{ $it->extra }}
                                        </td>
                                        <td>
                                            {{ $it->color }}
                                        </td>
                                        <td>
                                            {{ $it->body }}
                                        </td>
                                        <td>
                                            {{ $it->marchine }}
                                        </td>
                                        <td>
                                            {{ $it->year }}
                                        </td>
                                        <td>
                                            {{ $it->iden }}
                                            <div class='float-right'>
                                                <a href='{{ route("fix.coll.formCreate", ['__colecteral_value' => $it->id]) }}' class='btn btn-outline-primary btn-xs'>
                                                    <i class='fas fa-pen mr-1'></i> កែប្រែ
                                                </a>
                                                <a href="{{ route("fix.coll.deleteCollsFix", $it->id) }}" 
                                                    onclick="return confirm('Are you sure?')"
                                                    class='btn btn-outline-danger btn-xs'>
                                                    <i class='fas fa-trash mr-1'></i> លុប
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div>  --}}