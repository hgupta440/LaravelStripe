@extends('layout')
@section('content')
    {{ Form::open(array('url' => 'login')) }}
        @csrf
        <h1>Login</h1>
        
        <p class="error">
           
            {{ $errors->first('login') }}
        </p>
        
        <div class="form-outline mb-4">
            <label class="form-label" for="email">{{ Form::label('email', 'Email Address') }}</label>
            {{ Form::email('email','', array('class'=>'form-control', 'id'=>'email')) }}
        </div>
        <p class="error">
            {{ $errors->first('email') }}
        </p>
        <div class="form-outline mb-4">
            <label class="form-label" for="password">{{ Form::label('password', 'Password') }}</label>
            {{ Form::password('password',array('class'=>'form-control', 'id'=>'password')) }}
        </div>
        <p class="error">
           
            {{ $errors->first('password') }}
        </p>
        {{ Form::submit('Login',array('class'=>'btn btn-primary')) }}

      
    {{ Form::close() }}
@endsection