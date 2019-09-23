@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Task</div>

                <div class="card-body">
                    {!! Form::open(['method'=>'POST','route'=>'todolist.store']) !!}
                        @include('todolists._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
