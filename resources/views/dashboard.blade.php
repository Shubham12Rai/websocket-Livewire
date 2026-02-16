@extends('layouts.app')

@section('content')
<div style="padding:40px;">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button style="float:right;background:red;color:white;padding:6px 12px;border:none;">
            Logout
        </button>
    </form>

    <h2>Dashboard</h2>

    @livewire('remark-manager')
</div>
@endsection
