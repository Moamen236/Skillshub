@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Exams</li>
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
                        @include('admin.inc.errors')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Exam</h3>
                
                                <div class="card-tools">
                                    <!-- Button trigger modal -->
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">
                                        Back
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ url("dashboard/exams/update/{$exam->id}") }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Name (en)</label>
                                                <input type="text" name="name_en" class="form-control" value="{{ $exam->name('en') }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Name (ar)</label>
                                                <input type="text" name="name_ar" class="form-control" value="{{ $exam->name('ar') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description (en)</label>
                                                <textarea class="form-control summernote" name="desc_en" rows="5">
                                                    {!! $exam->desc('en') !!}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description (ar)</label>
                                                <textarea class="form-control summernote" name="desc_ar" rows="5">
                                                    {!! $exam->desc('ar') !!}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Skill</label>
                                                <select class="form-control select2" name="skill_id">
                                                    @foreach($skills as $skill)
                                                        <option value="{{ $skill->id }}" {{ $skill->id == $exam->skill_id ? 'selected' : '' }}>{{ $skill->name('en') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="image">
                                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-4">
                                            <div class="form-group">
                                                <label>Questions number</label>
                                                <input type="number" name="questions_no" class="form-control">
                                            </div>
                                        </div> --}}
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Difficulty</label>
                                                <input type="number" name="difficulty" class="form-control" value="{{ $exam->difficulty }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Duration in mins</label>
                                                <input type="number" name="duration_mins" class="form-control" value="{{ $exam->duration_mins }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection