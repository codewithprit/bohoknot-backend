<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bohoknot Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="container">
    <form class="form-box" method="POST" action="{{route('register')}}">
        @csrf
        <h2>Create Account</h2>

        <!-- FIRST NAME -->
        <div class="input-group">
            <input type="text" id="name" name="name">
            <label>Enter Name</label>
        </div>
        @error('name')<p class="error">{{$message}}</p>@enderror

        <!-- EMAIL -->
        <div class="input-group">
            <input type="text" id="email" name="email">
            <label>Enter Email</label>
        </div>
        @error('email')<p class="error">{{$message}}</p>@enderror

        <!-- PHONE -->
         <div class="input-group">
            <input type="text" id="phone" name="phone">
            <label>Enter Phone</label>
        </div>
        @error('phone')<p class="error">{{$message}}</p>@enderror

        <!-- DOB -->
        <div class="input-group">
            <input type="date" id="dob" name="dob">
            <label class="static-label">Date of Birth</label>
        </div>
        @error('dob')<p class="error">{{$message}}</p>@enderror
        <!-- GENDER -->
        <div class="input-group-select">
            <label class="select-label">Gender</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
            </select>
        </div>
        @error('gender')<p class="error">{{$message}}</p>@enderror

        <!-- NEWSLETTER -->
        <div class="input-group-select">
            <label class="select-label">Would you like to receive our newsletter?</label>
            <select id="newsletter" name="newsletter" required>
                <option value="" disabled selected>Select an option</option>
                <option>Yes</option>
                <option>No</option>
            </select>
        </div>

        <button type="submit" id="register_continue" class="btn">Continue</button>

        <p class="login-link">
            Already have an account? <a href="#">Login</a>
        </p>
    </form>
</div>

</body>
</html>
