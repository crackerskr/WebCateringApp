<link rel="stylesheet" href="{{asset('style/style.css')}}">

<div class="login-container">
    <x-logo />
    <h2>WELCOME TO LAM CATERING FOOD MANAGEMENT</h2>
    <form action="login" method="POST">
        @csrf
        <div class="formContent">
            <input type="email" id="email" name="email" class="input" placeholder="Email" />
            <span style="color:red;font-weight:bold">@error('email'){{$message}}@enderror</span><br>
        </div>
        <div class="formContent">
            <input type="password" id="password" name="password" class="input" placeholder="Password" />
            <span style="color:red;font-weight:bold">@error('password'){{$message}}@enderror</span><br>
        </div>
        <div class="formContent">
            <input type="submit" class="btn" href="menu" value="Login"></input>
        </div>
    </form>
    <p>New user? Sign up <a href ="signup" style="color:blue;font-weight:bold">here</a>.</p>

</div>