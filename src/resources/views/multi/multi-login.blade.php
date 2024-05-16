@extends('layouts.admin-app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/multi-login.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="main-content">
        <div class="main-content__title">
            <h2 class="main-content__logo">ManagementLogin</h2>
        </div>
        <div class="main-item">
            <form class="form" action="/multi/login" method="post">
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
                <div class="form-item">
                    <select class="form-item__select" name="guard">
                        <option value="" hidden>役職を選択してください</option>
                        <option value="admin">管理者</option>
                        <option value="manager">店舗代表者</option>
                    </select>
                    <div class="form-item__error">
                        @error('guard')
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
