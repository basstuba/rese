@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('search')
<div class="shop-back">
    <a class="shop-back__button" href="{{ route('detail', ['shop' => $shop['id']]) }}">戻る</a>
</div>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.after-login')
</div>
@endsection