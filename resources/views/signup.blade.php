<link rel="stylesheet" href="{{asset('style/style.css')}}">

<div class="login-container">
    <x-logo />
    <h2>WELCOME TO LAM CATERING FOOD MANAGEMENT</h2>
    <form action="signup" method="POST">
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
            <input type="password" id="confirm_password" name="confirm_password" class="input" placeholder="Confirm Password" />
            <span style="color:red;font-weight:bold">@error('confirm_password'){{$message}}@enderror</span><br>
        </div>
        <div class="formContent">
            <input type="submit" class="btn" href="/homepage" value="Sign Up"></input>
        </div>
    </form>
    <p>Already have an account? Login <a href ="login" style="color:blue;font-weight:bold">here</a>.</p>

</div>