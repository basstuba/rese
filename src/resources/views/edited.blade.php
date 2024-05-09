@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edited.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
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
            <p class="content-text__message">予約内容を変更しました</p>
        </div>
        <div class="content-button">
            <a class="content-button__back" href="{{ route('linkUser') }}">Mypageへ戻る</a>
        </div>
    </div>
</div>
@endsection