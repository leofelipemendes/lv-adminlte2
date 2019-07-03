@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::open(array('route' => 'sierra')) !!}
            {!! Form::label('nome','Nome',['class'=>'form-label']) !!}
            {!! Form::text('nome',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
        </div>
            {!! Form::close() !!}
    </div>
</div>
@endsection 