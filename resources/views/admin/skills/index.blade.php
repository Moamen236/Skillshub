@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Skills</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">skills</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->
        
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.inc.messages')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Skills</h3>
                
                                <div class="card-tools">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal">
                                        Add new
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name (en)</th>
                                        <th>Name (ar)</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($skills as $skill)      
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $skill->name('en') }}</td>
                                                <td>{{ $skill->name('ar') }}</td>
                                                <td>
                                                    <img src="{{ asset("uploads/$skill->img") }}" alt="" height="50px">
                                                </td>
                                                <td>{{ $skill->cat->name('en') }}</td>
                                                <td>
                                                    @if($skill->active)
                                                        <span class="badge bg-success">yes</span>
                                                    @else
                                                        <span class="badge bg-danger">no</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info edit-btn" data-id="{{ $skill->id }}" data-name-en="{{ $skill->name('en') }}" data-name-ar="{{ $skill->name('ar') }}" data-img="{{ $skill->img }}" data-cat-id="{{ $skill->cat_id }}" data-toggle="modal" data-target="#edit-modal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="{{ url("dashboard/skills/delete/$skill->id") }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                                    @if($skill->active)
                                                        <a href="{{ url("dashboard/skills/toggle/$skill->id") }}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                                                    @else
                                                        <a href="{{ url("dashboard/skills/toggle/$skill->id") }}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-off"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex my-3 justify-content-center">
                                    {{ $skills->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div><!-- /.content-wrapper -->

<!-- Add Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('admin.inc.errors')
            <form method="post" action="{{ url('dashboard/skills/store') }}" id="add-form" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name (en)</label>
                    <input type="text" name="name_en" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Name (ar)</label>
                    <input type="text" name="name_ar" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile02" name="img">
                          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="cat_id">
                        @foreach ($cats as $cat )
                        <option value="{{ $cat->id }}">{{ $cat->name() }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Cat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('admin.inc.errors')
            <form method="post" action="{{ url('dashboard/skills/update') }}" id="edit-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id">
                <div class="card-body">
                  <div class="form-group">
                    <label>Name (en)</label>
                    <input type="text" name="name_en" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Name (ar)</label>
                    <input type="text" name="name_ar" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="img">
                        <label class="custom-file-label">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="cat_id">
                        @foreach ($cats as $cat )
                        <option value="{{ $cat->id }}">{{ $cat->name() }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
</div>
@endsection


@section('scripts')
    <script>
        $('.edit-btn').click(function(){
            let id = $(this).attr('data-id');
            let name_en = $(this).attr('data-name-en');
            let name_ar = $(this).attr('data-name-ar');
            // let image = $(this).attr('data-name-ar');
            let cat_id = $(this).attr('data-name-ar');
            // console.log(id , name_en , name_ar);
            $("#edit-form input[name|='id']").val(id)
            $("#edit-form input[name|='name_en']").val(name_en)
            $("#edit-form input[name|='name_ar']").val(name_ar)
            // $("#edit-form input[name|='image']").val(image)
            $("#edit-form input[name|='cat_id']").val(cat_id)
        })
    </script>
@endsection