@extends('layouts.master')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Page Title" }}
        <small>{{ $page_description or null }}</small>
    </h1>
    <!-- You can dynamically generate breadcrumbs here -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol>
</section>
@endsection
@section('content')

<div class="row">
    <div class="col-md-4">
        <!--        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif-->
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
        @endif
        {!! Form::open(array('route' => 'depto_store')) !!}
        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            {!! Form::label('nome','Nome',['class'=>'form-label']) !!}
            {!! Form::text('nome',null,['class'=>'form-control']) !!}
            @if ($errors->has('nome'))
            <span class="help-block">
                <strong>{{ $errors->first('nome') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
            {!! Form::label('descricao','Descrição',['class'=>'form-label']) !!}
            {!! Form::text('descricao',null,['class'=>'form-control']) !!}
            @if ($errors->has('descricao'))
            <span class="help-block">
                <strong>{{ $errors->first('descricao') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection 