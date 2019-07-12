<div class="form-group{{ $errors->has('iduf') ? ' has-error' : '' }}">
    {!! Form::Label('iduf', 'Estado') !!}
    {!! Form::select('iduf', $estados, null, ['class' => 'form-control','placeholder' => 'Selecione...']) !!}
    @if ($errors->has('iduf'))
    <span class="help-block">
        <strong>{{ $errors->first('iduf') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('idmunicipio') ? ' has-error' : '' }}">
    {!! Form::label('idmunicipio','Cidade',['class'=>'form-label']) !!}
    @if(isset($municipios))
    {!! Form::select('idmunicipio',$municipios,null,['class'=>'form-control']) !!}
    @else
    {!! Form::select('idmunicipio',[],null,['class'=>'form-control']) !!}
    @endif

    @if ($errors->has('idcidade'))
    <span class="help-block">
        <strong>{{ $errors->first('idcidade') }}</strong>
    </span>
    @endif
</div>

@section('scripts')
<script>
    $('#iduf').on('change', function () {

        getMunicipios($(this).val());
    });

    function getMunicipios(iduf) {
        $.get('/municipios/' + iduf, function (data) {
            $('#idmunicipio').html(data);
        });
    }

//    $(document).ready(function () {
//        getMunicipios($('#iduf').val());
//    });

</script>
@endsection