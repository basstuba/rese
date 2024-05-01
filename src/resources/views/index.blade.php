@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
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

@section('search')
<div class="header-search">
    <form class="search-form" action="/search" method="get">
        <div class="search-item">
            <select class="search-select" name="area" onchange="submit()">
                <option value="">All area</option>
                @foreach($areas as $area)
                <option value="{{ $area['search_area'] }}">{{ $area['search_area'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="search-item">
            <select class="search-select" name="genre" onchange="submit()">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                <option value="{{ $genre['search_genre'] }}">{{ $genre['search_genre']}}</option>
            </select>
        </div>
        <div class="search-text">
            <div class="text-field"><!--虫眼鏡アイコン用-->
                <input class="text-field__input" type="text" name="keyword" placeholder="Search ..." onchange="submit()">
            </div>
        </div>
    </form>
</div>
@endsection