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
    <div class="user-name">
        testユーザーさん<!--userのname-->
    </div>
    <div class="main-content">
        <div class="reserved">
            <div class="reserved-title">
                <h2 class="reserved-title__logo">予約状況</h2>
            </div>
            <!--ここにフォーイーチが入る-->
            <div class="reserved-content">
                <div class="reserved-item">
                    <div class="reserved-count">
                        <div class="reserved-icon">
                            <img class="icon-clock" src="{{ asset('storage/image/icon_clock.png') }}" alt="時計のアイコン">
                        </div>
                        <div class="reserved-logo">
                            予約1<!--カウンタ変数を使って順番を表示する-->
                        </div>
                    </div>
                    <div class="reserved-delete">
                        <form class="delete-form" action="/reservation/delete" method="post">
                            @method('delete')
                            @csrf
                            <input class="delete-input" type="hidden" name="id" value=""><!--reservationのid-->
                            <button class="delete-button" type="submit">&times;</button>
                        </form>
                    </div>
                </div>
                <div class="reserved-content__table">
                    <table class="reserved-table">
                        <tr class="reserved-tr">
                            <th class="reserved-th">Shop</th>
                            <td class="reserved-td">
                                仙人<!--shopのname-->
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Date</th>
                            <td class="reserved-td">
                                2024-05-05<!--reservationのdate-->
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Time</th>
                            <td class="reserved-td">
                                17:00<!--reservationのtime-->
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Number</th>
                            <td class="reserved-td">
                                1人<!--reservationのnumber-->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="reserved-content">
                <div class="reserved-item">
                    <div class="reserved-count">
                        <div class="reserved-icon">
                            <img class="icon-clock" src="{{ asset('storage/image/icon_clock.png') }}" alt="時計のアイコン">
                        </div>
                        <div class="reserved-logo">
                            予約1<!--カウンタ変数を使って順番を表示する-->
                        </div>
                    </div>
                    <div class="reserved-delete">
                        <form class="delete-form" action="/reservation/delete" method="post">
                            @method('delete')
                            @csrf
                            <input class="delete-input" type="hidden" name="id" value=""><!--reservationのid-->
                            <button class="delete-button" type="submit">&times;</button>
                        </form>
                    </div>
                </div>
                <div class="reserved-content__table">
                    <table class="reserved-table">
                        <tr class="reserved-tr">
                            <th class="reserved-th">Shop</th>
                            <td class="reserved-td">
                                仙人<!--shopのname-->
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Date</th>
                            <td class="reserved-td">
                                2024-05-05<!--reservationのdate-->
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Time</th>
                            <td class="reserved-td">
                                17:00<!--reservationのtime-->
                            </td>
                        </tr>
                        <tr class="reserved-tr">
                            <th class="reserved-th">Number</th>
                            <td class="reserved-td">
                                1人<!--reservationのnumber-->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--ここにエンドフォーイーチが入る-->
        </div>
        <div class="like">
            <div class="favorite-title">
                <h2 class="favorite-title__logo">お気に入り店舗</h2>
            </div>
            <div class="favorite-content">
                <!--ここにフォーイーチが入る-->
                <div class="shop">
                    <div class="shop-photo">
                        <img class="shop-img" src="{{ asset('storage/image/sushi.jpg') }}" alt="店舗写真"><!--shopのimg_url-->
                    </div>
                    <div class="shop-date">
                        <div class="shop-name">
                            仙人<!--shopのname-->
                        </div>
                        <div class="shop-tag">
                            <small class="shop-tag__area">
                                #東京都<!--#とshopのarea-->
                            </small>
                            <small class="shop-tag__genre">
                                #寿司<!--#とshopのgenre-->
                            </small>
                        </div>
                        <div class="shop-detail">
                            <div class="shop-link">
                                <a class="shop-link__button" href="">詳しくみる</a><!--routeはdetailでshop.blade参照-->
                            </div>
                            <div class="favorite">
                                <form class="favorite-form__delete" action="/favorite/delete" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id" value=""/><!--favoriteのid-->
                                    <button class="form-button" type="submit" name="myPage">
                                        <img class="heart" src="{{ asset('storage/image/icon_red-heart.png') }}" alt="お気に入りボタン">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop">
                    <div class="shop-photo">
                        <img class="shop-img" src="{{ asset('storage/image/sushi.jpg') }}" alt="店舗写真"><!--shopのimg_url-->
                    </div>
                    <div class="shop-date">
                        <div class="shop-name">
                            仙人<!--shopのname-->
                        </div>
                        <div class="shop-tag">
                            <small class="shop-tag__area">
                                #東京都<!--#とshopのarea-->
                            </small>
                            <small class="shop-tag__genre">
                                #寿司<!--#とshopのgenre-->
                            </small>
                        </div>
                        <div class="shop-detail">
                            <div class="shop-link">
                                <a class="shop-link__button" href="">詳しくみる</a><!--routeはdetailでshop.blade参照-->
                            </div>
                            <div class="favorite">
                                <form class="favorite-form__delete" action="/favorite/delete" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id" value=""/><!--favoriteのid-->
                                    <button class="form-button" type="submit" name="myPage">
                                        <img class="heart" src="{{ asset('storage/image/icon_red-heart.png') }}" alt="お気に入りボタン">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--ここにエンドフォーイーチが入る-->
            </div>
        </div>
    </div>
</div>
@endsection