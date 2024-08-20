@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/assessment_create.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.after-login')
</div>
@endsection

@section('content')
<div>
    <div>
        <div>
            <p>今回のご利用はいかがでしたか？</p>
        </div>
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
                        @if($shop->favorites->isEmpty())
                            <form class="favorite-form" action="/favorite" method="post">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
                                <button class="form-button" type="submit">
                                    <img class="heart" src="{{ asset('storage/image/icon_gray-heart.png') }}" alt="お気に入りボタン">
                                </button>
                            </form>
                        @else
                            <form class="favorite-form__delete" action="/favorite/delete" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
                                <button class="form-button" type="submit">
                                    <img class="heart" src="{{ asset('storage/image/icon_red-heart.png') }}" alt="お気に入りボタン">
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <form action="/assessment/create" method="post" enctype="multipart/form-data">
            <div>
                <label>体験を評価してください</label>
                <select name="evaluation_id">
                    @foreach($evaluations as $evaluation)
                    <option value="{{ $evaluation['id'] }}"
                    {{ old('evaluation_id') == $evaluation['id'] ? 'selected' : ''}}>
                        {{ $evaluation['star'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                @error('evaluation_id')
                {{ $message }}
                @enderror
                &emsp;
            </div>
            <div>
                <label>口コミを投稿</label>
                <textarea name="assessment_comment">{{ old('assessment_comment') }}</textarea>
                <p></p>
            </div>
            <div>
                @error('assessment_comment')
                {{ $message }}
                @enderror
                &emsp;
            </div>
            <div>
                <label>画像の追加</label>
                <input type="file" name="imagePhoto" value="{{ old('imagePhoto') }}">
            </div>
            <div>
                @error('imagePhoto')
                {{ $message }}
                @enderror
                &emsp;
            </div>
            <div>
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                <button type="submit">口コミを投稿</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/comment.js') }}"></script>
@endsection