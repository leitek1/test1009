@extends('layout')
@section('title')
Отзывы
@endsection
@section('main_content')
<h1>Форма добавления отзыва</h1>
<br>
@if($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif
<form method="POST" action="/review/check">
    @csrf
    <input type="email" name="email" id="email" placeholder="Ввведите email" class="form-control"><br>
    <input type="text" name="subject" id="subject" placeholder="Ввведите тему" class="form-control"><br>
    <textarea name="message" id="message" class="form-control" placeholder="Введите сообщение"></textarea><br>
    <button type="submit" class="btn btn-success">Отправить</button>
</form>
<br>
<h1>Все отзывы</h1>
<br>
@foreach ($reviews as $el)
    <div class="alert alert-warning">
<h3>{{ $el->email}}</h3>
<b>{{ $el->subject}}</b>
<p>{{ $el->message}}</p>
    </div>
@endforeach
@endsection