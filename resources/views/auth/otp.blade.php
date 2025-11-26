<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="{{asset('css/otp_verify.css')}}">
</head>
<body>

<div class="container">
    <form class="form-box otp-box" method="POST" action="">
        @csrf

        <h2>Verify OTP</h2>

        <p class="otp-subtext">
            Enter the 5-digit code sent to your email / phone.
        </p>

        <!-- OTP INPUT -->
        <div class="input-group">
            <input type="text" id="otp" name="otp" maxlength="5" required>
            <label>Enter OTP</label>
        </div>

        <button type="submit" class="btn">Verify</button>

        <p class="resend-link">
            Didn’t receive the code? <a href="">Resend OTP</a>
        </p>

    </form>
</div>

</body>
</html>
