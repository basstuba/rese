@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my-page.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.after-login')
</div>
@endsection

@section('content')
<div class="main">
    <div class="main-header">
        <div class="stripe">
            <form action="{{route('stripeCharge')}}" method="POST">
                @csrf
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ env('STRIPE_KEY') }}"
                    data-amount="1000"
                    data-name="お支払い画面"
                    data-label="決済をする"
                    data-description="現在はデモ画面です"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto"
                    data-currency="JPY">
                </script>
            </form>
        </div>
        <div class="user-name">
            {{ $user['name'] . 'さん' }}
        </div>
    </div>
    <div class="main-content">
        <div class="reserved">
            <div class="reserved-title">
                <h2 class="reserved-title__logo">予約状況</h2>
            </div>
            @foreach($reservations as $key => $reservation)
            <div class="reserved-content">
                <div class="reserved-item">
                    <div class="reserved-count">
                        <div class="reserved-icon">
                            <img class="icon-clock" src="{{ asset('storage/image/icon_clock.png') }}" alt="時計のアイコン">
                        </div>
                        <div class="reserved-logo">
                            {{ '予約' . ( $key + 1 ) }}
                        </div>
                        <div class="reserved-edit">
                            <a class="reserved-edit__button" href="{{ route('edit', ['reservation' => $reservation['id']]) }}">
                                予約内容を変更する
                            </a>
                        </div>
                    </div>
                    <div class="reserved-delete">
                        <form class="delete-form" action="/reservation/delete" method="post">
                            @method('delete')
                            @csrf
                            <input class="delete-input" type="hidden" name="id" value="{{ $reservation['id'] }}">
                            <button class="delete-button" type="submit">&times;</button>
                        </form>
                    </div>
                </div>
                <div class="reserved-content__table">
                    <table class="reserved-table">
                        <tr class="reserved-tr">
                            <th class="reserved-th">Shop</th>
                            <td class="reserved-td">
                                {{ $reservation['shop']['name'] }}
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Date</th>
                            <td class="reserved-td">
                                {{ $reservation['date'] }}
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Time</th>
                            <td class="reserved-td">
                                {{ $reservation['time'] }}
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Number</th>
                            <td class="reserved-td">
                                {{ $reservation['number'] }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        <div class="like">
            <div class="favorite-title">
                <h2 class="favorite-title__logo">お気に入り店舗</h2>
            </div>
            <div class="favorite-content">
                @foreach($favorites as $favorite)
                <div class="shop">
                    <div class="shop-photo">
                        <img class="shop-img" src="{{ \App\Helpers\ImageHelper::imageUrl($favorite['shop']['img_url']) }}" alt="店舗写真">
                    </div>
                    <div class="shop-date">
                        <div class="shop-name">
                            {{ $favorite['shop']['name'] }}
                        </div>
                        <div class="shop-tag">
                            <small class="shop-tag__area">
                                {{ '#' . $favorite['shop']['area'] }}
                            </small>
                            <small class="shop-tag__genre">
                                {{ '#' . $favorite['shop']['genre'] }}
                            </small>
                        </div>
                        <div class="shop-detail">
                            <div class="shop-link">
                                <a class="shop-link__button" href="{{ route('detail', ['shop' => $favorite['shop']['id']]) }}">詳しくみる</a>
                            </div>
                            <div class="favorite">
                                <form class="favorite-form__delete" action="/favorite/delete" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="shop_id" value="{{ $favorite['shop']['id']}}"/>
                                    <button class="form-button" type="submit" name="myPage">
                                        <img class="heart" src="{{ asset('storage/image/icon_red-heart.png') }}" alt="お気に入りボタン">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection