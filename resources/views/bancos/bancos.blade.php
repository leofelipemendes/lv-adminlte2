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
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Novo Banco</h3>
            </div>
            <div class="box-body">
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
                @if(isset($bancos))
                {!! Form::model($bancos,['route' => ['bancos_update',$bancos],'class' => 'form','method' => 'put']) !!}
                @else
                {!! Form::open(['route' => 'bancos_store','class' => 'form']) !!}
                @endif
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                    {!! Form::label('nome','Nome',['class'=>'form-label']) !!}
                    {!! Form::text('nome',null,['class'=>'form-control']) !!}
                    @if ($errors->has('nome'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nome') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('codigo') ? ' has-error' : '' }}">
                    {!! Form::label('codigo','Codigo',['class'=>'form-label']) !!}
                    {!! Form::text('codigo',null,['class'=>'form-control']) !!}
                    @if ($errors->has('codigo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nome') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                    {!! Form::label('site','Site',['class'=>'form-label']) !!}
                    {!! Form::text('site',null,['class'=>'form-control']) !!}
                    @if ($errors->has('site'))
                    <span class="help-block">
                        <strong>{{ $errors->first('site') }}</strong>
                    </span>
                    @endif
                </div>

               
            </div>
            <div class="box-footer">
                <div class="form-group">
                    {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('bancos_index')}}" type="button" class="btn btn-default">Cancel</a>
                </div>
            </div>
             {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection 