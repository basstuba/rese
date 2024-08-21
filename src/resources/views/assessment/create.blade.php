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
    <div class="assessment">
        <form class="assessment-form" action="/assessment/create" method="post" enctype="multipart/form-data">
            @csrf
            <div class="assessment-evaluation">
                <label class="assessment-title">体験を評価してください</label>
                <select class="evaluation-select" name="evaluation_id">
                    @foreach($evaluations as $evaluation)
                    <option value="{{ $evaluation['id'] }}"
                    {{ old('evaluation_id') == $evaluation['id'] ? 'selected' : ''}}>
                        {{ $evaluation['star'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="error-message">
                @error('evaluation_id')
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