@extends('layouts.admin')
@section('content')
    @include('alerts.request')
    {!!Form::open(['url' => 'usuario','method'=>'POST'])!!}
    <div class="form-group">
        {!!Form::label('nombre','Nombre:')!!}
        {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('email','Correo:')!!}
        {!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el email del usuario'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('password','Contraseña:')!!}
        {!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa la contraseña del usuario'])!!}
    </div>
    {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
    {!!Form::close()!!}
@endsection