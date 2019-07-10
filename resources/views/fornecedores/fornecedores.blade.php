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
                <h3 class="box-title">Novo Fornecedor</h3>
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
                @if(isset($fornecedores))
                {!! Form::model($fornecedores,['route' => ['fornecedor_update',$fornecedores],'class' => 'form','method' => 'put']) !!}
                @else
                {!! Form::open(['route' => 'fornecedor_store','class' => 'form']) !!}
                @endif
                <div class="form-group {{ $errors->has('razaosocial') ? ' has-error' : '' }}">
                    {!! Form::label('razaosocial','razaosocial',['class'=>'form-label']) !!}
                    {!! Form::text('razaosocial',null,['class'=>'form-control']) !!}
                    @if ($errors->has('razaosocial'))
                    <span class="help-block">
                        <strong>{{ $errors->first('razaosocial') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('nomefantasia') ? ' has-error' : '' }}">
                    {!! Form::label('nomefantasia','nomefantasia',['class'=>'form-label']) !!}
                    {!! Form::text('nomefantasia',null,['class'=>'form-control']) !!}
                    @if ($errors->has('nomefantasia'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nomefantasia') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('cnpj') ? ' has-error' : '' }}">
                    {!! Form::label('cnpj','cnpj',['class'=>'form-label']) !!}
                    {!! Form::text('cnpj',null,['class'=>'form-control']) !!}
                    @if ($errors->has('cnpj'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cnpj') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('ie') ? ' has-error' : '' }}">
                    {!! Form::label('ie','ie',['class'=>'form-label']) !!}
                    {!! Form::text('ie',null,['class'=>'form-control']) !!}
                    @if ($errors->has('ie'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ie') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                    {!! Form::label('endereco','endereco',['class'=>'form-label']) !!}
                    {!! Form::text('endereco',null,['class'=>'form-control']) !!}
                    @if ($errors->has('endereco'))
                    <span class="help-block">
                        <strong>{{ $errors->first('endereco') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                    {!! Form::label('bairro','bairro',['class'=>'form-label']) !!}
                    {!! Form::text('bairro',null,['class'=>'form-control']) !!}
                    @if ($errors->has('bairro'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bairro') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                    {!! Form::label('numero','numero',['class'=>'form-label']) !!}
                    {!! Form::text('numero',null,['class'=>'form-control']) !!}
                    @if ($errors->has('numero'))
                    <span class="help-block">
                        <strong>{{ $errors->first('numero') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                    {!! Form::label('complemento','complemento',['class'=>'form-label']) !!}
                    {!! Form::text('complemento',null,['class'=>'form-control']) !!}
                    @if ($errors->has('complemento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('complemento') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('idmunicipio') ? ' has-error' : '' }}">
                    {!! Form::label('idmunicipio','idmunicipio',['class'=>'form-label']) !!}
                    {!! Form::text('idmunicipio',null,['class'=>'form-control']) !!}
                    @if ($errors->has('idmunicipio'))
                    <span class="help-block">
                        <strong>{{ $errors->first('idmunicipio') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('iduf') ? ' has-error' : '' }}">
                    {!! Form::label('iduf','iduf',['class'=>'form-label']) !!}
                    {!! Form::text('iduf',null,['class'=>'form-control']) !!}
                    @if ($errors->has('iduf'))
                    <span class="help-block">
                        <strong>{{ $errors->first('iduf') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('im') ? ' has-error' : '' }}">
                    {!! Form::label('im','im',['class'=>'form-label']) !!}
                    {!! Form::text('im',null,['class'=>'form-control']) !!}
                    @if ($errors->has('im'))
                    <span class="help-block">
                        <strong>{{ $errors->first('im') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('contato') ? ' has-error' : '' }}">
                    {!! Form::label('contato','contato',['class'=>'form-label']) !!}
                    {!! Form::text('contato',null,['class'=>'form-control']) !!}
                    @if ($errors->has('contato'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contato') }}</strong>
                    </span>
                    @endif
                </div>               
                <div class="form-group{{ $errors->has('tel_contato') ? ' has-error' : '' }}">
                    {!! Form::label('tel_contato','tel_contato',['class'=>'form-label']) !!}
                    {!! Form::text('tel_contato',null,['class'=>'form-control']) !!}
                    @if ($errors->has('tel_contato'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tel_contato') }}</strong>
                    </span>
                    @endif
                </div>               
            </div>
            <div class="box-footer">
                <div class="form-group">
                    {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('fornecedor_index')}}" type="button" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection 