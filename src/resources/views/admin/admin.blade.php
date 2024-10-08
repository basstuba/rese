@extends('layouts.admin-app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="new-manager">
        <a class="new-manager__link" href="{{ route('adminNewManager') }}">店舗代表者登録</a>
    </div>
    <div class="shop-assessment">
        <a class="shop-assessment__link" href="{{ route('adminShopAssessment') }}">店舗別口コミ一覧</a>
    </div>
    <div class="admin-content">
        <div class="admin-content__title">
            <h2 class="admin-content__logo">CSVファイルインポート</h2>
        </div>
        <div class="admin-content__main">
            <form class="admin-content__form" action="/admin/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="admin-content__item">
                    <input class="admin-content__input" type="file" name="file">
                </div>
                <div class="admin-content__button">
                    <button class="admin-content__submit" type="submit">インポート</button>
                </div>
            </form>
        </div>
    </div>
    @if($errors->any())
    <div class="admin-content__message">
        @foreach($errors->all() as $error)
        <p class="message-error">{{ $error }}</p>
        @endforeach
    </div>
    @else
    <div class="admin-content__space">
        {{ session('message') ?? '' }}&emsp;
    </div>
    @endif
</div>
@endsection