@extends('layouts.admin-app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/assessment.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="assessment-header">
        <div class="assessment-header__link">
            <a class="assessment-header__back" href="{{ route('adminShopAssessment') }}">店舗別口コミ一覧に戻る</a>
        </div>
        <div class="assessment-header__message">
            {{ session('message') ?? '' }}&emsp;
        </div>
        <div class="assessment-header__title">
            {{ $shop['name'] . "の口コミ一覧" }}
        </div>
    </div>
    @if($assessments->isNotEmpty())
    <div class="assessment-content">
        @foreach($assessments as $assessment)
        <div class="assessment-content__item">
            <div class="assessment-content__delete">
                <form class="delete-form" action="/admin/assessment/delete" method="post">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                    <input type="hidden" name="assessment_id" value="{{ $assessment['id'] }}">
                    <button class="delete-form__button" type="submit">削除する</button>
                </form>
            </div>
            <div class="assessment-content__evaluate">
                <span class="item-count" data-rate="{{ $assessment['count'] }}"></span>
            </div>
            <div class="assessment-content__comment">
                {{ $assessment['assessment_comment'] }}
            </div>
            @if(!empty($assessment['photo_url']))
            <div class="assessment-content__photo">
                <img class="photo-image" src="{{ asset($assessment['photo_url']) }}" alt="口コミ画像">
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="assessment-content__empty">
        <p class="empty-message">この店舗の口コミはありません</p>
    </div>
    @endif
</div>
@endsection