@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/before-login.css') }}"/>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.before-login')
</div>
@endsection

@section('content')
<div class="main">
    <div class="main-content">
        <div class="content-text">
            <p class="content-text__message">会員登録ありがとうございます</p>
        </div>
        <div class="content-button">
            <a class="content-button__back" href="{{ route('linkLogin') }}">ログインする</a>
        </div>
    </div>
</div>
@endsection