@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance__content">
    <div class="attendance-date__container">
        <form class="attendance__form" action="/attendance/move" method="post">
            @csrf
            <input type="hidden" name="attendance_day" value="{{ $attendance_day->subDay() }}">
            <button class="attendance__btn-move" type="submit">&lt</button>
        </form>
        <div class="attendance__today">
            <h2>{{ $attendance_day->addDay()->format('Y-m-d')  }}</h2>
        </div>
        <form class="attendance__form" action="/attendance/move" method="post">
            @csrf
            <input type="hidden" name="attendance_day" value="{{ $attendance_day->addDay() }}">
            <button class="attendance__btn-move" type="submit">&gt</button>
        </form>
    </div>
    <table class="attendance__table">
        <tr class="attendance__row">
            <th class="attendance__label">名前</th>
            <th class="attendance__label">勤務開始</th>
            <th class="attendance__label">勤務終了</th>
            <th class="attendance__label">休憩時間</th>
            <th class="attendance__label">勤務時間</th>
        </tr>
        @foreach($attendances as $attendance)
        <tr class="attendance__row">
            <td class="attendance__data">{{ $attendance->user->name }}</td>
            <td class="attendance__data">{{ $attendance->attend_time->format('H:i:s') }}</td>
            <td class="attendance__data">{{ $attendance->leaving_time->format('H:i:s') }}</td>
            <td class="attendance__data">{{ $attendance->break_time_total }}</td>
            <td class="attendance__data">{{ $attendance->working_hours }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection