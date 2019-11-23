<form action="{{ route('login') }}" method="post">
    @csrf
    <input type="email" name="email">
    <input type="password" name="password">
    <button id="login-btn">Login</button>
</form>
