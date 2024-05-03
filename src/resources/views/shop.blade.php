@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/before-login.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('modal')
<div class="modal" id="menu">
    @if(Auth::check())
        @include('menu.after-login')
    @else
        @include('menu.before-login')
    @endif
</div>
@endsection

@section('content')
<div class="main">
    <div class="shop">
        <div class="shop-header">
            <div class="shop-header__back">
                <a class="back-button" href="{{ route('index') }}">&lt;</a>
            </div>
            <div class="shop-name">
                {{ $store['name'] }}
            </div>
        </div>
        <div class="shop-photo">
            <img src="{{ asset($store['img_url']) }}" alt="店舗写真">
        </div>
        <div class="shop-tag">
            <p class="shop-area">
                {{ '#' . $store['area'] }}
            </p>
            <p class="shop-genre">
                {{ '#' . $store['genre'] }}
            </p>
        </div>
        <div class="shop-text">
            <p class="shop-message">
                {{ $store['comment']}}
            </p>
        </div>
    </div>
    <div class="reserved">
        <div></div>
        <div></div>
    </div>
</div>