@extends('layouts.master')
@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $page_title or "Page Title" }}
    </h1>
<!--     You can dynamically generate breadcrumbs here 
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol>-->
</section>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-6 actions">
        <div class="pull-left">
            <a href="{{ route('cbanc_create') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i>
                NOVO
            </a>
        </div>
        
    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-10">
        @if ($message = Session::get('success'))
        <br/>
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
        @endif
    </div>
</div>
<div class="row"><br/></div>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $page_description or null }}</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th></th>
            </tr>
            @foreach($contasBancarias as $contas)
            <tr>
                <td>{{ $contas->nome }}</td>
                <td>{{ $contas->descricao }}</td>
                <td>
                    <a href="{{ route('cbanc_edit',['id'=>$contas->id])}}">
                        <i class="fa fa-plus-square"></i>
                    </a>
                    <a href="{{route('cbanc_disable',['id'=>$contas->id])}}">
                        <i class="fa fa-minus-square"></i>
                    </a>
                    
                    
                    
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
</div>


@endsection
