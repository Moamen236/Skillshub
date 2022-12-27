@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exam Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Exam Questions</li>
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
                                <h3 class="card-title">Create Exam Questions</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ url("dashboard/exams/create-questions/{$exam->id}") }}" id="add-form">
                                    @csrf
                                    @for($i = 1; $i <= $exam->questions_no; $i++)
                                        <h4 class="mb-3">Question {{ $i }}</h4>
                                        <div class="row justify-content-between">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="titles[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Option 1</label>
                                                    <input type="text" name="option_1s[]" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Option 2</label>
                                                    <input type="text" name="option_2s[]" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Option 3</label>
                                                    <input type="text" name="option_3s[]" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Option 4</label>
                                                    <input type="text" name="option_4s[]" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Right Ans.</label>
                                                    <input type="number" name="right_anss[]" class="form-control" min="1" max="4">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endfor
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