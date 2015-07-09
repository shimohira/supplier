<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login</title>
  {{ HTML::style('assets/css/styleLogin.css') }}
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
  {{ Form::open(array('url'=>'user/signin', 'class'=>'login')) }}
  <p>
    <label for="login">username:</label>
    {{ Form::text('username', null, array('placeholder'=>'Username')) }}
  </p>

  <p>
    <label for="password">Password:</label>
    {{ Form::password('password', array('placeholder'=>'Password')) }}
  </p>

  <p class="login-submit">
    <button type="submit" class="login-button">Login</button>
  </p>

  <p class="forgot-password"><a href="daftar">Daftar</a></p>
  {{ Form::close() }}

  <section class="about">
    <p class="about-links">
      <a href="http://www.cssflow.com/snippets/dark-login-form" target="_parent">View Article</a>
      <a href="http://www.cssflow.com/snippets/dark-login-form.zip" target="_parent">Download</a>
    </p>
    <p class="about-author">
      &copy; 2012&ndash;2013 <a href="http://thibaut.me" target="_blank">Thibaut Courouble</a> -
      <a href="http://www.cssflow.com/mit-license" target="_blank">MIT License</a><br>
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>
    </section>
  </body>
  </html>
