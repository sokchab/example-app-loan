<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            ព័ត៌មានទ្រព្យបញ្ចាំ
        </h3>
        <div class="float-right">
            <a href="{{ route("loans.new_collateral", $lns->id) }}" class="btn bg-gradient-primary btn-xs">
                <i class="fas fa-plus mr-1"></i> បន្ថែម
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="60px" class="text-center">#</th>
                    <th>ក្រុមហ៊ុនផលិត</th>
                    <th>ម៉ូដែល</th>
                    <th>ពណ៌</th>
                    <th>លេខតួ</th>
                    <th>លេខម៉ាស៊ីន</th>
                    <th>ឆ្នាំផលិត</th>
                    <th>ផ្លាកលេខ</th>
                    {{-- <th class="text-center">ផ្សេងៗ</th> --}}
                </tr>
            </thead>
            <tbody>
            @foreach($lns->getCollaterals as $col)
                <tr>
                    <td class="text-center">
                        <a href="{{ route("loans.editCollat", $col->id) }}" class="btn-group">
                            <span class="badge br-primary text-primary brr"><i class="fas fa-hashtag"></i></span>
                            <span class="badge bg-gradient-primary brl text-sm">{{ $loop->iteration }}</span>
                        </a>
                    </td>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $col->model }}</td>
                    <td>{{ $col->extra }}</td>
                    <td>{{ $col->color }}</td>
                    <td>{{ $col->body }}</td>
                    <td>{{ $col->marchine }}</td>
                    <td>{{ $col->year }}</td>
                    <td>{{ $col->iden }}</td>
                    {{-- <td class="text-center" width="110px">
                        <a href="{{ route("loans.editCollat", $col->id) }}" class="btn btn-outline-primary btn-sm">
                            កែប្រែ
                        </a>
                    </td> --}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
