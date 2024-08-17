@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('search')
<div class="shop-back">
    <a class="shop-back__button" href="{{ route('detail', ['shop' => $shop['id']]) }}">戻る</a>
</div>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.after-login')
</div>
@endsection

@section('content')
<div class="main">
    <form class="review-form" action="/review/create" method="post">
        @csrf
        <div class="shop-name">
            {{ $shop['name'] }}
            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}"/>
        </div>
        <div class="review-star">
            <select class="review-select" name="evaluate">
                <option value="" hidden>星の数を選んでください</option>
                @foreach($evaluations as $evaluation)
                <option value="{{ $evaluation['star'] }}">{{ $evaluation['star'] }}</option>
                @endforeach
            </select>
            <div class="form-error">
                @error('evaluate')
                {{ $message }}
                @enderror
                &emsp;
            </div>
        </div>
        <div class="review-comment">
            <textarea class="review-comment__field" name="review_comment" cols="70" rows="15"
            placeholder={{ old('review_comment') ? '' : 'コメントを記入してください' }}>{{ old('review_comment') }}</textarea>
            <div class="form-error">
                @error('review_comment')
                {{ $message }}
                @enderror
                &emsp;
            </div>
        </div>
        <div class="review-button">
            <button class="review-button__submit" type="submit">投稿する</button>
        </div>
    </form>
</div>
@endsection