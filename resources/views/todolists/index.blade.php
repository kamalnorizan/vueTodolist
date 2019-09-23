@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($todolists as $todolist)
                        <tr>
                            <td>{{$todolist->title}}</td>
                            <td>{{$todolist->Description}}</td>
                            <td><a href="/todolist/{{$todolist->id}}" class="btn btn-primary btn-sm">Show</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
