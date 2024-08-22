@extends('layouts.admin-app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_assessment.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="list-header">
        <div class="list-header__link">
            <a class="list-header__back" href="{{ route('adminIndex') }}">管理画面に戻る</a>
        </div>
        <div class="list-header__title">
            <h2 class="list-header__logo">店舗別口コミ一覧</h2>
        </div>
    </div>
    <div class="list-content">
        <table class="list-table">
            <tr class="list-tr__title">
                <th class="list-item__title">店舗名称</th>
                <td class="list-item__space">&emsp;</td>
            </tr>
            @foreach($shops as $shop)
            <tr class="list-tr">
                <th class="list-item__name">{{ $shop['name'] }}</th>
                <td class="list-item__link">
                    <a class="list-item__link-button" href="{{ route('adminAssessment', ['shop' => $shop['id']]) }}">口コミ一覧</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection