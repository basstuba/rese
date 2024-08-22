@extends('layouts.admin-app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manager_create.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="admin-header">
        <div class="admin-header__link">
            <a class="admin-header__back" href="{{ route('adminIndex') }}">管理画面に戻る</a>
        </div>
        <div class="admin-header__message">
            {{ session('message') ?? '' }}&emsp;
        </div>
        <div class="admin-header__title">
            <h2 class="admin-header__logo">店舗代表者登録</h2>
        </div>
    </div>
    <div class="admin-content">
        <form class="admin-content__form" action="/admin/create" method="post">
            @csrf
            <table class="admin-table">
                <tr class="admin-tr">
                    <th class="admin-th">店舗代表者氏名</th>
                    <td class="admin-td">
                        <div class="admin-content__item">
                            <input class="admin-content__input" type="text" name="name" value="{{ old('name') }}"/>
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">&emsp;</th>
                    <td class="admin-td">
                        <div class="admin-content__error">
                            @error('name')
                                {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">メールアドレス</th>
                    <td class="admin-td">
                        <div class="admin-content__item">
                            <input class="admin-content__input" type="email" name="email" value="{{ old('email') }}"/>
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">&emsp;</th>
                    <td class="admin-td">
                        <div class="admin-content__error">
                            @error('email')
                                {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">パスワード</th>
                    <td class="admin-td">
                        <div class="admin-content__item">
                            <input class="admin-content__input" type="text" name="password"/>
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">&emsp;</th>
                    <td class="admin-td">
                        <div class="admin-content__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">担当店舗</th>
                    <td class="admin-td">
                        <div class="admin-content__item">
                            <select class="admin-content__select" name="shop_id">
                                <option value="">未定</option>
                                @foreach($shops as $shop)
                                <option value="{{ $shop['id'] }}" {{ old('shop_id') == $shop['id'] ? 'selected' : ''}}>{{ $shop['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
                <tr class="admin-tr">
                    <th class="admin-th">&emsp;</th>
                    <td class="admin-td">
                        <div class="admin-content__error">
                            @error('shop_id')
                                {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </td>
                </tr>
            </table>
            <div class="admin-content__button">
                <button class="admin-content__button-submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection