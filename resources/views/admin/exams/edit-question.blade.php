@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Question</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url("dashboard/exams/show/{$exam->id}/questions") }}">Questions</a></li>
                            <li class="breadcrumb-item active">Edit Question</li>
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
                                <h3 class="card-title">Edit Question</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ url("dashboard/exams/update/question/{$question->id}") }}" id="add-form">
                                    @csrf
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $question->title }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Option 1</label>
                                                <input type="text" name="option_1" class="form-control" value="{{ $question->option_1 }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Option 2</label>
                                                <input type="text" name="option_2" class="form-control" value="{{ $question->option_2 }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Option 3</label>
                                                <input type="text" name="option_3" class="form-control" value="{{ $question->option_3 }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Option 4</label>
                                                <input type="text" name="option_4" class="form-control" value="{{ $question->option_4 }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Right Ans.</label>
                                                <input type="number" name="right_ans" class="form-control" min="1" max="4" value="{{ $question->right_ans }}">
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