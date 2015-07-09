@extends('layouts.main')

@section('content')

<div class="container">

{{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
<h2 class="form-signup-heading">Please Register</h2>

 @if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <div class="input-control text size3">
    {{ Form::text('nama', null, array('class'=>'form-control', 'placeholder'=>'Nama')) }}
    </div>
    <br>
    <div class="input-control text size3">
    {{ Form::text('no_kar', null, array('class'=>'form-control', 'placeholder'=>'Nomor Karyawan')) }}
    </div>
    <br>
    <div class="input-control text size3">
    {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}
    </div>
    <br>
    <div class="input-control password size3">
    {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Input Password')) }}
    </div>
    <br>
    <div class="input-control text size3">
    {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
    </div>
 <br>
    {{ Form::submit('Register', array('class'=>'btn btn-default'))}}
{{ Form::close() }}	
</div>
@stop
