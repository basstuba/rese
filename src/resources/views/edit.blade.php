@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/after-login.css') }}"/>
@endsection

@section('modal')
<div class="modal" id="menu">
    @include('menu.after-login')
</div>
@endsection

@section('content')
<div class="edit">
    <div class="edit-title">
        <h2 class="edit-title__logo">予約内容</h2>
    </div>
    <div class="editor-content">
        <div class="indicate">
            <form class="indicate-form" action="/indicate/edit" method="get">
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
                <input type="hidden" name="sendId" value="{{ $reservation['id'] }}"/>
            </form>
        </div>
        <div class="edit-form">
            <form class="form" action="/reservation/edit" method="post">
                @csrf
                <div class="edit-content">
                    <table class="edit-table">
                        <tr class="edit-tr">
                            <th class="edit-th">Shop</th>
                            <td class="edit-td">
                                {{ $reservation['shop']['name'] }}
                                <input type="hidden" name="id" value="{{ $reservation['id'] }}">
                            </td>
                        </tr>
                        <tr class="edit-tr">
                            <th class="edit-th">Date</th>
                            <td class="edit-td">
                                <input class="edit-value" type="text" name="date"
                                value="{{ old('sendDate') ?? $reservation['date'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="edit-tr">
                            <th class="edit-th">Time</th>
                            <td class="edit-td">
                                <input class="edit-value" type="text" name="time"
                                value="{{ old('sendTime') ?? $reservation['time'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="edit-tr">
                            <th class="edit-th">Number</th>
                            <td class="edit-td">
                                <input class="edit-value" type="text" name="number"
                                value="{{ old('sendNumber') ?? $reservation['number'] }}" readonly/>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="edit-button">
                    <button class="edit-button__submit" type="submit">変更する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection