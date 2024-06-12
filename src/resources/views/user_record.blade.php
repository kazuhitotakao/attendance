@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user_record.css') }}">
@endsection

@section('content')
<div class="record__content">
    <div class="record__container">
        <div class="record__user-name">
            <h2>{{ $user->name }}</h2>
        </div>
        <div class="record-month__container">
            <form class="record__form" action="/user/record/move" method="get">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="record_day" value=" {{ $record_day->subMonth() }} ">
                <button class="record__btn-move" type="submit">&lt</button>
            </form>
            <div class="record__today">
                <h2>{{ $record_day->addMonth()->format('n').'月'  }}</h2>
            </div>
            <form class="record__form" action="/user/record/move" method="get">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="record_day" value="{{ $record_day->addMonth() }} ">
                <button class="record__btn-move" type="submit">&gt</button>
            </form>
        </div>
    </div>
    <table class="record__table">
        <tr class="record__row">
            <th class="record__label">勤務日</th>
            <th class="record__label">勤務開始</th>
            <th class="record__label">勤務終了</th>
            <th class="record__label">休憩時間</th>
            <th class="record__label">勤務時間</th>
        </tr>
        @foreach($records as $record)
        <tr class="record__row">
            <td class="record__data">{{ $record->date }}</td>
            <td class="record__data">{{ $record->attend_time->format('H:i:s') }}</td>
            @if ($record->leaving_time === null)
            <td class="record__data">{{ $record->leaving_time }}</td>
            @else
            <td class="record__data">{{ $record->leaving_time->format('H:i:s') }}</td>
            @endif
            <td class="record__data">{{ $record->break_time_total }}</td>
            <td class="record__data">{{ $record->working_hours }}</td>
        </tr>
        @endforeach
    </table>
    {{ $records->appends(request()->query())->links('vendor.pagination.custom') }}
</div>
@endsection