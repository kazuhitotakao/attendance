@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_list.css') }}">
@endsection

@section('content')
<div class="user__content">
    <div class="user__inner">
        <div class="user-name__container">
            <div class="user-name">
                <h2 class=>ユーザー一覧</h2>
            </div>
        </div>
        <form class="search-form" action="/search" method="get">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{request('keyword')}}">
            <input class="btn search-form__search-btn" type="submit" value="検索">
            <input class="btn search-form__reset-btn" type="submit" value="リセット" name="reset">
        </form>
    </div>
    <table class="user__table">
        <tr class="user__row">
            <th class="label user__label-ID">ID</th>
            <th class="label user__label-name">名前</th>
            <th class="label user__label-email">メールアドレス</th>
            <th class="label user__label-button">個別勤怠表</th>
        </tr>
        @foreach($users as $user)
        <tr class="user__row">
            <td class="data user__data-ID">{{ $user->id }}</td>
            <td class="data user__data-name">{{ $user->name }}</td>
            <td class="data user__data-email">{{ $user->email }}</td>
            <td class="data user__data-button">
                <form action="/user/record" method="get">
                    <button class="user__data-button--btn">勤怠表</button>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $users->links('vendor.pagination.custom') }}
</div>
@endsection