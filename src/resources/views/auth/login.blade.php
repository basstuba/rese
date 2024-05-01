@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
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
        <div class="main-content__title">
            <h2 class="main-content__logo">Login</h2>
        </div>
        <div class="main-item">
            <form class="form" action="/login" method="post">
                @csrf
                <div class="form-item">
                    <div class="form-item__input-email">
                        <input class="form-item__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email"/>
                    </div>
                    <div class="form-item__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                        &emsp;
                    </div>
                </div>
                <div class="form-item">
                    <div class="form-item__input-password">
                        <input class="form-item__input" type="password" name="password" placeholder="Password"/>
                    </div>
                    <div class="form-item__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                        &emsp;
                    </div>
                </div>
                <div class="form-button">
                    <button class="form-button__submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection