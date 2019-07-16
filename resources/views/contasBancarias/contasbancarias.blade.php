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
                <h3 class="box-title">Nova Categoria</h3>
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
                @if(isset($contasbancarias))
                {!! Form::model($contasbancarias,['route' => ['cbanc_update',$contasbancarias],'class' => 'form','method' => 'put']) !!}
                @else
                {!! Form::open(['route' => 'cbanc_store','class' => 'form']) !!}
                @endif
                <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                    {!! Form::label('descricao','Descrição',['class'=>'form-label']) !!}
                    {!! Form::text('descricao',null,['class'=>'form-control']) !!}
                    @if ($errors->has('descricao'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descricao') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('idbanco') ? ' has-error' : '' }}">
                    {!! Form::Label('idbanco', 'Banco') !!}
                    {!! Form::select('idbanco', $bancos, null, ['class' => 'form-control','placeholder' => 'Selecione...']) !!}
                    @if ($errors->has('idbanco'))
                    <span class="help-block">
                        <strong>{{ $errors->first('idbanco') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('agencia') ? ' has-error' : '' }}">
                            {!! Form::label('agencia','Agencia',['class'=>'form-label']) !!}
                            {!! Form::number('agencia',null,['class'=>'form-control']) !!}
                            @if ($errors->has('agencia'))
                            <span class="help-block">
                                <strong>{{ $errors->first('agencia') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('dig_ag') ? ' has-error' : '' }}">
                            {!! Form::label('dig_ag','Digito Agencia',['class'=>'form-label']) !!}
                            {!! Form::number('dig_ag',null,['class'=>'form-control']) !!}
                            @if ($errors->has('dig_ag'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dig_ag') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('nr_conta') ? ' has-error' : '' }}">
                            {!! Form::label('nr_conta','Conta',['class'=>'form-label']) !!}
                            {!! Form::number('nr_conta',null,['class'=>'form-control']) !!}
                            @if ($errors->has('nr_conta'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nr_conta') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('dig_conta') ? ' has-error' : '' }}">
                            {!! Form::label('dig_conta','Digito Conta',['class'=>'form-label']) !!}
                            {!! Form::number('dig_conta',null,['class'=>'form-control']) !!}
                            @if ($errors->has('dig_conta'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dig_conta') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group{{ $errors->has('tipo_conta') ? ' has-error' : '' }}">
                            {!! Form::Label('tipo_conta', 'tipo_conta') !!}
                            {!! Form::select('tipo_conta', $tipoContas, null, ['class' => 'form-control','placeholder' => 'Selecione...']) !!}
                            @if ($errors->has('tipo_conta'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tipo_conta') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group{{ $errors->has('finalidade') ? ' has-error' : '' }}">
                            <label>Finalidade:</label>
                            <p>
                            @foreach($finalidadeConta as $finalidade)
                                {{$finalidade->descricao}}
                                {!! Form::radio('finalidade', $finalidade->id) !!}
                            @endforeach
                            </p>
                            @if ($errors->has('finalidade'))
                            <span class="help-block">
                                <strong>{{ $errors->first('finalidade') }}</strong>
                            </span>
                            @endif
                        </div>


                    </div>
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('ativo') ? ' has-error' : '' }}">
                            {!! Form::Label('ativo', 'Ativa') !!}
                            {!! Form::checkbox('ativo', '1', true) !!}
                            @if ($errors->has('ativo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ativo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>





            </div>
            <div class="box-footer">
                <div class="form-group">
                    {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('categ_index')}}" type="button" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection 