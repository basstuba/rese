@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css) }}"/>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.after-login')
</div>
@endsection

@section('content')
<div class="main">
    <div class="main-content">
        <div class="content-text">
            <p class="content-text__message">ご予約ありがとうございます</p>
        </div>
        <div class="content-button">
            <a class="content-button__back" href="{{ route('detail') }}">戻る</a>
        </div>
    </div>
</div>
@endsection