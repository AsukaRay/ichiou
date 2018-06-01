@extends('layouts.app')

@section('content')

    <h1>TODOリスト</h1>

    @if (count($tasklists) > 0)
        <ul>
             @foreach ($tasklists as $tasklist)
                <li>{!! link_to_route('tasklists.show', $tasklist->id, ['id' => $tasklist->id]) !!} : {{ $tasklist->content }}</li>
 @endforeach
        </ul>
    @endif
    {!! link_to_route('tasklists.create', 'タスク一覧') !!}

@endsection