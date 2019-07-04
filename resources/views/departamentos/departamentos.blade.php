@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
        @endif
        {!! Form::open(array('route' => 'store')) !!}
        <div class="form-group">
            {!! Form::label('nome','Nome',['class'=>'form-label']) !!}
            {!! Form::text('nome',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('descricao','Descrição',['class'=>'form-label']) !!}
            {!! Form::text('descricao',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection 