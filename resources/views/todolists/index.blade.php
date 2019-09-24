@extends('layouts.app')
@section('head')
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            font-family: 'Varela Round', sans-serif;
        }

        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
            outline: none !important;
        }

        .modal-confirm .btn-info {
            background: #c1c1c1;
        }

        .modal-confirm .btn-info:hover,
        .modal-confirm .btn-info:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard <a href="/todolist/create" class="btn btn-sm btn-default pull-right">New Task</a></div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Created By</td>
                            <td>Clients of creator</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($todolists as $todolist)
                        <tr>
                            <td>{{$todolist->title}}</td>
                            <td>{{$todolist->Description}}</td>
                            <td>{{$todolist->user->name}}</td>
                            <td>
                                @foreach ($todolist->user->client as $client)
                                - {{$client->name}} <br>
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route'=>['todolist.destroy',$todolist->id], 'method'=>'DELETE']) !!}
                                {{-- {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-sm']) !!} --}}
                                <a href="/todolist/{{$todolist->id}}" class="btn btn-primary btn-sm">Show</a>
                                <a href="/todolist/{{$todolist->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#myModal" class="btn btn-danger btn-sm" data-id="{{$todolist->id}}" data-toggle="modal">Delete</a>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $todolists->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route'=> 'todolist.delete', 'method'=>'POST']) !!}
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {!! Form::hidden('id', '', ['id'=>'id']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#myModal').on('show.bs.modal',function (event){
        var button = $(event.relatedTarget);
        var id = button.data('id');
        $('#id').val(id);
    });
</script>
@endsection
