@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Example Component</div>

                <div class="card-body">
                    {{-- <example-component perkataan="{{$button}}" type="submit"></example-component> --}}
                    <todolist></todolist>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
