
@extends('layouts.app') 
@section('title', 'ユーザー一覧')

@section('content')
<ul>
    @forelse ($users as $user)
        <li>{{ $user }}</li>
    @empty
        <p>ユーザーがいません</p>
    @endforelse
</ul>
<h1>h1の見出しが入ります</h1>
<p>テキストが入ります</p>
@endsection
