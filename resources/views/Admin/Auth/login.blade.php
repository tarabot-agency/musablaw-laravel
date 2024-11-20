@extends('Admin.layout.guest-app')
@section('title')
    Login
@endsection
@section('content')
<div class="login">
    <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <label for="chk" aria-hidden="true">Admin Login</label>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>Login</button>
    </form>
</div>
@endsection
