@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}"/>
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
            <div class="shop-header__main">
                <div class="shop-header__back">
                    <a class="back-button" href="{{ route('index') }}">&lt;</a>
                </div>
                <div class="shop-name">
                    {{ $shop['name'] }}
                </div>
            </div>
            <div class="shop-header__review">
                @if(Auth::check())
                    <div class="shop-header__review-create">
                        <a class="review-create__button" href="{{ route('review', ['shop' => $shop['id']]) }}">
                            レビューを投稿する
                        </a>
                    </div>
                @endif
                <div class="modal-review">
                    <a class="modal-review__button" href="#reviewPage">レビューを見る</a>
                </div>
            </div>
        </div>
        <div class="modal-review__page" id="reviewPage">
            <div class="review-page__back">
                <a class="review-page__back-button" href="#">&times;</a>
            </div>
            <div class="review-content">
                @if($reviews->isEmpty())
                    <p class="review-none">このお店のレビューはまだありません</p>
                @else
                    @foreach($reviews as $review)
                        <div class="review-star">
                            {{ $review['evaluate'] }}
                        </div>
                        <div class="review-text">
                            <p class="review-text__comment">{{ $review['review_comment'] }}</p>
                        </div>
                        <div class="review-date">
                            {{ $review['posted_on'] }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="shop-photo">
            <img class="shop-img" src="{{ asset($shop['img_url']) }}" alt="店舗写真">
        </div>
        <div class="shop-tag">
            <p class="shop-area">
                {{ '#' . $shop['area'] }}
            </p>
            <p class="shop-genre">
                {{ '#' . $shop['genre'] }}
            </p>
        </div>
        <div class="shop-text">
            <p class="shop-message">
                {{ $shop['comment']}}
            </p>
        </div>
        @if($assessments->isNotEmpty())
        <div class="modal-assessment__open">
            <button class="modal-assessment__open-button" popovertarget="Modal" popovertargetaction="show">全ての口コミ情報</button>
        </div>
        <div class="modal-assessment__content" id="Modal" popover="auto">
            <div class="modal-assessment__close">
                <button class="modal-assessment__close-button" popovertarget="Modal" popovertargetaction="hidden">閉じる</button>
            </div>
            <div class="modal-assessment__main-content">
            @foreach($assessments as $assessment)
                @if($assessment['user_id'] == Auth::user()->id)
                    <div class="modal-assessment__user-item">
                        <div class="user-item__link">
                            <a class="user-item__link-button" href="{{ route('assessmentEdit', ['shop' => $shop['id']]) }}">口コミを編集</a>
                        </div>
                        <div class="user-item__delete">
                            <form class="user-item__delete-form" action="/assessment/delete" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                                <input type="hidden" name="assessmentId" value="{{ $assessment['id'] }}">
                                <button class="user-item__delete-button" type="submit">口コミを削除</button>
                            </form>
                        </div>
                    </div>
                @endif
                <div class="modal-assessment__item-evaluate">
                    {{ $assessment['evaluate'] }}
                </div>
                <div class="modal-assessment__item-comment">
                    {{ $assessment['assessment_comment']}}
                </div>
                @if(!empty($assessment['photo_url']))
                    <div class="modal-assessment__item-photo">
                        <img class="item-photo__img" src="{{ asset($assessment['photo_url']) }}" alt="口コミ画像">
                    </div>
                @endif
            @endforeach
            </div>
        </div>
        @endif
        @if(!empty($userAssessment))
            <div class="user-assessment__item-nav">
                <div class="item-nav__update">
                    <a class="item-nav__update-link" href="{{ route('assessmentEdit', ['shop' => $shop['id']]) }}">口コミを編集</a>
                </div>
                <div class="item-nav__delete">
                    <form class="item-nav__delete-form" action="/assessment/delete" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <input type="hidden" name="assessmentId" value="{{ $userAssessment['id'] }}">
                        <button class="item-nav__delete-button" type="submit">口コミを削除</button>
                    </form>
                </div>
            </div>
            <div class="user-assessment__item-evaluate">
                {{ $userAssessment['evaluate'] }}
            </div>
            <div class="user-assessment__item-comment">
                {{ $userAssessment['assessment_comment']}}
            </div>
            @if(!empty($userAssessment['photo_url']))
                <div class="user-assessment__item-photo">
                    <img class="item-photo__img" src="{{ asset($userAssessment['photo_url']) }}" alt="口コミ画像">
                </div>
            @endif
        @else
            <div class="user-assessment__item-create">
                <a class="item-create__link" href="{{ route('assessment', ['shop' => $shop['id']]) }}">口コミを投稿する</a>
            </div>
        @endif
    </div>
    <div class="reserved">
        <div class="reserved-title">
            <h2 class="reserved-title__logo">予約</h2>
        </div>
        <div class="reservation-content">
            <div class="indicate">
                <form class="indicate-form" action="/indicate" method="get">
                    <div class="indicate-date">
                        <input class="indicate-date__input" type="date" name="sendDate"
                        value="{{ old('sendDate') }}" min="{{ $tomorrow }}" onchange="submit()"/>
                        <div class="form-error">
                            @error('date')
                            {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </div>
                    <div class="indicate-item">
                        <select class="indicate-item__select" name="sendTime" onchange="submit()">
                            <option value="" hidden>時間を選択してください</option>
                            @foreach($times as $time)
                            <option value="{{ $time['reserved_time'] }}"
                            {{ old('sendTime') == $time['reserved_time'] ? 'selected' : ''}}>
                                {{ $time['reserved_time'] }}
                            </option>
                            @endforeach
                        </select>
                        <div class="form-error">
                            @error('time')
                            {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </div>
                    <div class="indicate-item">
                        <select class="indicate-item__select" name="sendNumber" onchange="submit()">
                            <option value="" hidden>人数を選択してください</option>
                            @foreach($numbers as $number)
                            <option value="{{ $number['reserved_number'] }}"
                            {{ old('sendNumber') == $number['reserved_number'] ? 'selected' : ''}}>
                                {{ $number['reserved_number'] }}
                            </option>
                            @endforeach
                        </select>
                        <div class="form-error">
                            @error('number')
                            {{ $message }}
                            @enderror
                            &emsp;
                        </div>
                    </div>
                    <input type="hidden" name="sendId" value="{{ $shop['id'] }}"/>
                </form>
            </div>
            <div class="reserved-form">
                <form class="form" action="/reservation" method="post">
                    @csrf
                    <div class="reserved-content">
                        <table class="reserved-table">
                            <tr class="reserved-tr">
                                <th class="reserved-th">Shop</th>
                                <td class="reserved-td">
                                    {{ $shop['name'] }}
                                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
                                </td>
                            </tr>
                            <tr class="reserved-tr">
                                <th class="reserved-th">Date</th>
                                <td class="reserved-td">
                                    <input class="reserved-value" type="text" name="date" value="{{ old('sendDate') ?? '' }}" readonly/>
                                </td>
                            </tr>
                            <tr class="reserved-tr">
                                <th class="reserved-th">Time</th>
                                <td class="reserved-td">
                                    <input class="reserved-value" type="text" name="time" value="{{ old('sendTime') ?? '' }}" readonly/>
                                </td>
                            </tr>
                            <tr class="reserved-tr">
                                <th class="reserved-th">Number</th>
                                <td class="reserved-td">
                                    <input class="reserved-value" type="text" name="number" value="{{ old('sendNumber') ?? '' }}" readonly/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="reserved-button">
                        <button class="reserved-button__submit" type="submit">予約する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection