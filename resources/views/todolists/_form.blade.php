<div class="row">
    <div class="col-md-12">
        {!! Form::text('title', null, ['placeholder'=>'Todolist Title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! Form::textarea('Description', null, ['placeholder'=>'Description', 'class'=>'form-control']) !!}
    </div>
</div>
{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
