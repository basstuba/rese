@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/before-login.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('search')
<div class="header-search">
    <form class="search-form" action="/search" method="get">
        <div class="search-item">
            <select class="search-select" name="area" onchange="submit()">
                <option value="">All area</option>
                @foreach($areas as $area)
                <option value="{{ $area['search_area'] }}" {{ old('area') == $area['search_area'] ? 'selected' : ''}}>{{ $area['search_area'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-item">
            <select class="search-select" name="genre" onchange="submit()">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                <option value="{{ $genre['search_genre'] }}" {{ old('genre') == $genre['search_genre'] ? 'selected' : ''}}>{{ $genre['search_genre'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-text">
            <div class="text-field">
                <input class="text-field__input" type="text" name="keyword" placeholder="Search ..."
                value="{{ old('keyword') }}" onchange="submit()">
            </div>
        </div>
    </form>
</div>
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
    @foreach($shops as $shop)
    <div class="shop">
        <div class="shop-photo">
            <img class="shop-img" src="{{ asset($shop['img_url']) }}" alt="店舗写真">
        </div>
        <div class="shop-date">
            <div class="shop-name">
                {{ $shop['name'] }}
            </div>
            <div class="shop-tag">
                <small class="shop-tag__area">
                    {{ '#' . $shop['area'] }}
                </small>
                <small class="shop-tag__genre">
                    {{ '#' . $shop['genre'] }}
                </small>
            </div>
            <div class="shop-detail">
                <div class="shop-link">
                    <a class="shop-link__button" href="{{ route('detail', ['shop' => $shop['id']]) }}">詳しくみる</a>
                </div>
                <div class="favorite">
                    @if($favorites->isEmpty())
                        <form class="favorite-form" action="/favorite" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user['id'] }}"/>
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
                            <button class="form-button" type="submit">
                                <img class="heart" src="{{ asset('storage/image/icon_gray-heart.png') }}" alt="お気に入りボタン">
                            </button>
                        </form>
                    @else
                        @foreach($favorites as $favorite)
                            @if($favorite['shop_id'] == $shop['id'])
                                <form class="favorite-form__delete" action="/favorite/delete" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $favorite['id'] }}"/>
                                    <button class="form-button" type="submit">
                                        <img class="heart" src="{{ asset('storage/image/icon_red-heart.png') }}" alt="お気に入りボタン">
                                    </button>
                                </form>
                            @else
                                <form class="favorite-form" action="/favorite" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user['id'] }}"/>
                                    <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
                                    <button class="form-button" type="submit">
                                        <img class="heart" src="{{ asset('storage/image/icon_gray-heart.png') }}" alt="お気に入りボタン">
                                    </button>
                                </form>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection