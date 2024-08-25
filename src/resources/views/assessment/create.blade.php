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
<div class="main">
    <div class="shop-display">
        <div class="shop-display__item">
            <p class="shop-display__item-message">今回のご利用は<br>いかがでしたか？</p>
        </div>
        <div class="shop">
            <div class="shop-photo">
                <img class="shop-img" src="{{ \App\Helpers\ImageHelper::imageUrl($shop['img_url']) }}" alt="店舗写真">
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
                                <button class="form-button" type="submit" name="create">
                                    <img class="heart" src="{{ asset('storage/image/icon_gray-heart.png') }}" alt="お気に入りボタン">
                                </button>
                            </form>
                        @else
                            <form class="favorite-form__delete" action="/favorite/delete" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
                                <button class="form-button" type="submit" name="createPage">
                                    <img class="heart" src="{{ asset('storage/image/icon_red-heart.png') }}" alt="お気に入りボタン">
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="assessment">
        <form class="assessment-form" action="/assessment/create" method="post" enctype="multipart/form-data">
            @csrf
            <div class="assessment-title">体験を評価してください</div>
            <div class="assessment-evaluation">
                <input class="assessment-input" id="star5" type="radio" name="count" value="5" {{ old('count') == 5 ? 'checked' : ''}}>
                <label class="assessment-star" for="star5">★</label>
                <input class="assessment-input" id="star4" type="radio" name="count" value="4" {{ old('count') == 4 ? 'checked' : ''}}>
                <label class="assessment-star" for="star4">★</label>
                <input class="assessment-input" id="star3" type="radio" name="count" value="3" {{ old('count') == 3 ? 'checked' : ''}}>
                <label class="assessment-star" for="star3">★</label>
                <input class="assessment-input" id="star2" type="radio" name="count" value="2" {{ old('count') == 2 ? 'checked' : ''}}>
                <label class="assessment-star" for="star2">★</label>
                <input class="assessment-input" id="star1" type="radio" name="count" value="1" {{ old('count') == 1 ? 'checked' : ''}}>
                <label class="assessment-star" for="star1">★</label>
            </div>
            <div class="error-message">
                @error('count')
                {{ $message }}
                @enderror
                &emsp;
            </div>
            <div class="assessment-comment">
                <label class="assessment-title">口コミを投稿</label>
                <textarea class="comment-area" name="assessment_comment" cols="50" rows="8"
                placeholder="{{ old('assessment_comment') ? '' : 'コメントをご記入ください' }}">{{ old('assessment_comment') }}</textarea>
                <div class="comment-count">
                    <p class="string-count">0</p>
                    <p class="string-message">&sol;400&nbsp;&lpar;最高文字数&rpar;</p>
                </div>
            </div>
            <div class="error-message">
                @error('assessment_comment')
                {{ $message }}
                @enderror
                &emsp;
            </div>
            <div class="assessment-image">
                <label class="assessment-title">画像の追加</label>
                <input class="image-input" type="file" name="imagePhoto">
            </div>
            <div class="error-message">
                @error('imagePhoto')
                {{ $message }}
                @enderror
                &emsp;
            </div>
            <div class="assessment-button">
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                <button class="button-submit" type="submit">口コミを投稿</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/comment.js') }}"></script>
@endsection