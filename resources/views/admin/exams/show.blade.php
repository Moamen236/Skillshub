@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item active">{{ $exam->name('en') }}</li>
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
                                <h3 class="card-title">Exam Detais</h3>
                                <div class="card-tools">
                                    <!-- Button trigger modal -->
                                    @if($exam->questions->count() <= 0)
                                        <a href="{{ url("dashboard/exams/create-questions/{$exam->id}") }}" class="btn btn-sm btn-primary">
                                            Create Questions
                                        </a>
                                    @endif
                                    <a href="{{ url("dashboard/exams/show/$exam->id/questions") }}" class="btn btn-sm btn-success">
                                        Show Questions
                                    </a>
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">
                                        Back
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Name (en)</th>
                                        <td>{{ $exam->name('en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name (ar)</th>
                                        <td>{{ $exam->name('ar') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Image</th>
                                        <td><img src="{{ asset("uploads/$exam->img") }}" alt="" height="50px"></td>
                                    </tr>
                                    <tr>
                                        <th>Questions Number</th>
                                        <td>{{ $exam->questions_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Difficulty</th>
                                        <td>{{ $exam->difficulty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration in mins</th>
                                        <td>{{ $exam->duration_mins }}</td>
                                    </tr>
                                    <tr>
                                        <th>Skill</th>
                                        <td>{{ $exam->skill->name('en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description (en)</th>
                                        <td>{{ $exam->desc('en') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description (ar)</th>
                                        <td>{{ $exam->desc('ar') }}</td>
                                    </tr>
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