@extends('layouts.app')
@section('title','Backup')
@section('backup', 'active')    
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <form action="{{ route("backup.create") }}" method="POST" class="prevent-submits">  @csrf
              <button type="submit" class="btn btn-link btn-prevent-submits">
                  <i class="fas fa-database mr-1"></i> Create New Backup
              </button>
          </form>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Backup</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Backup Files</h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects table-sm">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 40%">
                          File
                      </th>
                      <th style="width: 20%">
                          Size
                      </th>
                      
                      <th style="width: 10%" class="text-center">
                          Age
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($backups as $bp)
                      
                  <tr>
                      <td>
                         {{ $loop->iteration }}
                      </td>
                      <td>
                          <b>
                              {{ $bp["file_name"] }}
                          </b>
                          <br/>
                          <small>
                              Created <b>{{ \Carbon::parse($bp["last_modified"]) }}</b>
                          </small>
                      </td>
                      <td>
                          <b>{{ \Hel::formatSizeUnits($bp["file_size"]) }}</b>
                      </td>
                      
                      <td class="project-state">
                          <span class="badge badge-success"> {{ \Carbon::parse($bp["last_modified"])->diffForHumans() }} </span>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="{{ route("backup.download", $bp["file_name"]) }}">
                              <i class="fas fa-download">
                              </i>
                              Download
                          </a>
                          
                          <a class="btn btn-danger btn-sm" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" href="{{ route("backup.delete", $bp["file_name"]) }}">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- @dd($backups) --}}
@endsection

@section('js')
    <script type="text/javascript">
        $(function(){
          $('.prevent-submits').on('submit', function(){
            $('.btn-prevent-submits').attr('disabled', true);
            $('.btn-prevent-submits').text('Database Backing Up...');
          });
        });
    </script>
@endsection


