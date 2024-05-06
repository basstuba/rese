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
            <div class="shop-header__back">
                <a class="back-button" href="{{ route('index') }}">&lt;</a>
            </div>
            <div class="shop-name">
                {{ $shop['name'] }}
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
    </div>
    <div class="reserved">
        <div class="reserved-title">
            <h2 class="reserved-title__logo">予約</h2>
        </div>
        <div class="reservation-content">
            <div class="indicate">
                <form class="indicate-form" action="/indicate" method="get">
                    <div class="indicate-date">
                        <input class="indicate-date__input" type="date" name="sendDate" value="{{ old('sendDate') }}" onchange="submit()"/>
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