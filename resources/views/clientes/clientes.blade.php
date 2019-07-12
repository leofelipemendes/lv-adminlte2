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
                <h3 class="box-title">Novo Cliente</h3>
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
                @if(isset($clientes))
                {!! Form::model($clientes,['route' => ['cliente_update',$clientes],'class' => 'form','method' => 'put']) !!}
                @else
                {!! Form::open(['route' => 'cliente_store','class' => 'form']) !!}
                @endif

                <div class="form-group {{ $errors->has('nome') ? ' has-error' : '' }}">
                    {!! Form::label('nome','Nome',['class'=>'form-label']) !!}
                    {!! Form::text('nome',null,['class'=>'form-control']) !!}
                    @if ($errors->has('nome'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nome') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('rg') ? ' has-error' : '' }}">
                    {!! Form::label('rg','RG',['class'=>'form-label']) !!}
                    {!! Form::text('rg',null,['class'=>'form-control']) !!}
                    @if ($errors->has('rg'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rg') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                    {!! Form::label('cpf','CPF',['class'=>'form-label']) !!}
                    {!! Form::text('cpf',null,['class'=>'form-control']) !!}
                    @if ($errors->has('cpf'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cpf') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                    {!! Form::label('endereco','Endereco',['class'=>'form-label']) !!}
                    {!! Form::text('endereco',null,['class'=>'form-control']) !!}
                    @if ($errors->has('endereco'))
                    <span class="help-block">
                        <strong>{{ $errors->first('endereco') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                    {!! Form::label('bairro','Bairro',['class'=>'form-label']) !!}
                    {!! Form::text('bairro',null,['class'=>'form-control']) !!}
                    @if ($errors->has('bairro'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bairro') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                    {!! Form::label('numero','Numero',['class'=>'form-label']) !!}
                    {!! Form::text('numero',null,['class'=>'form-control']) !!}
                    @if ($errors->has('numero'))
                    <span class="help-block">
                        <strong>{{ $errors->first('numero') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                    {!! Form::label('complemento','Complemento',['class'=>'form-label']) !!}
                    {!! Form::text('complemento',null,['class'=>'form-control']) !!}
                    @if ($errors->has('complemento'))
                    <span class="help-block">
                        <strong>{{ $errors->first('complemento') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('iduf') ? ' has-error' : '' }}">
                    {!! Form::Label('iduf', 'Estado') !!}
                    {!! Form::select('iduf', $estados, null, ['class' => 'form-control']) !!}
                    @if ($errors->has('iduf'))
                    <span class="help-block">
                        <strong>{{ $errors->first('iduf') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group{{ $errors->has('idcidade') ? ' has-error' : '' }}">
                    {!! Form::label('idcidade','Cidade',['class'=>'form-label']) !!}
                    {!! Form::select('idcidade',[],null,['class'=>'form-control']) !!}
                    @if ($errors->has('idcidade'))
                    <span class="help-block">
                        <strong>{{ $errors->first('idcidade') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group{{ $errors->has('ddd_res') ? ' has-error' : '' }}">
                    {!! Form::label('ddd_res','DDD Res.',['class'=>'form-label']) !!}
                    {!! Form::text('ddd_res',null,['class'=>'form-control']) !!}
                    @if ($errors->has('ddd_res'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ddd_res') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('tel_res') ? ' has-error' : '' }}">
                    {!! Form::label('tel_res','Tel. Res.',['class'=>'form-label']) !!}
                    {!! Form::text('tel_res',null,['class'=>'form-control']) !!}
                    @if ($errors->has('tel_res'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tel_res') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('ddd_cel') ? ' has-error' : '' }}">
                    {!! Form::label('ddd_cel','DDD Cel.',['class'=>'form-label']) !!}
                    {!! Form::text('ddd_cel',null,['class'=>'form-control']) !!}
                    @if ($errors->has('ddd_cel'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ddd_cel') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('tel_cel') ? ' has-error' : '' }}">
                    {!! Form::label('tel_cel','Celular',['class'=>'form-label']) !!}
                    {!! Form::text('tel_cel',null,['class'=>'form-control']) !!}
                    @if ($errors->has('tel_cel'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tel_cel') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('ddd_out') ? ' has-error' : '' }}">
                    {!! Form::label('ddd_out','DDD Out.',['class'=>'form-label']) !!}
                    {!! Form::text('ddd_out',null,['class'=>'form-control']) !!}
                    @if ($errors->has('ddd_out'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ddd_out') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('tel_out') ? ' has-error' : '' }}">
                    {!! Form::label('tel_out','Tel. Out',['class'=>'form-label']) !!}
                    {!! Form::text('tel_out',null,['class'=>'form-control']) !!}
                    @if ($errors->has('tel_out'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tel_out') }}</strong>
                    </span>
                    @endif
                </div>               
                <div class="form-group{{ $errors->has('contato') ? ' has-error' : '' }}">
                    {!! Form::label('contato','Contato',['class'=>'form-label']) !!}
                    {!! Form::text('contato',null,['class'=>'form-control']) !!}
                    @if ($errors->has('contato'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contato') }}</strong>
                    </span>
                    @endif
                </div>               
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email','Email',['class'=>'form-label']) !!}
                    {!! Form::text('email',null,['class'=>'form-control']) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>               
            </div>
            <div class="box-footer">
                <div class="form-group">
                    {!! Form::submit('enviar',['class'=>'btn btn-primary']) !!}
                    <a href="{{route('cliente_index')}}" type="button" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection 
@section('scripts')
<script>
    $('#iduf').on('change',function(){

       getMunicipios($(this).val()); 
    });
    
    function getMunicipios(iduf){
        $.get('/municipios/'+iduf,function(data){
            $('#idcidade').html(data);
        });
    }
    
    $(document).ready(function () {
        getMunicipios($('#iduf').val());
    });
    
</script>
@endsection