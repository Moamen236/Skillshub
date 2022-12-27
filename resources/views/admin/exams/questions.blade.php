@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item"><a href="{{ url("dashboard/exams/show/{$exam->id}") }}">{{ $exam->name('en') }}</a></li>
                            <li class="breadcrumb-item active">Questions</li>
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
                                <h3 class="card-title">All Questions ({{ $questions->count() }})</h3>
                
                                <div class="card-tools">
                                    <!-- Button trigger modal -->
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">
                                        Back
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>Options</th>
                                        <th>Right Answer</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $question)      
                                            <tr>
                                                <td>{{ $question->id }}</td>
                                                <td>{{ $question->title }}</td>
                                                <td>
                                                    1- {{ $question->option_1 }}
                                                    <br>
                                                    2- {{ $question->option_2 }}
                                                    <br>
                                                    3- {{ $question->option_3 }}
                                                    <br>
                                                    4- {{ $question->option_4 }}
                                                </td>
                                                <td>{{ $question->right_ans }}</td>
                                                <td>
                                                    <a href="{{ url("dashboard/exams/edit/{$exam->id}/question/{$question->id}") }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection