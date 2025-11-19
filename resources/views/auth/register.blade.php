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
    <form class="form-box" action="" method="POST">
        @csrf
        <h2>Create Account</h2>

        <!-- FIRST NAME -->
        <div class="input-group">
            <input type="text" id="first_name" name="first_name" required>
            <label>First Name</label>
        </div>

        <!-- LAST NAME -->
        <div class="input-group">
            <input type="text" id="last_name" name="last_name" required>
            <label>Last Name</label>
        </div>

        <!-- EMAIL -->
        <div class="input-group">
<<<<<<< Updated upstream
            <input type="text" id="email_or_phone" name="email_or_phone" required>
            <label>Email</label>
        </div>

        <!-- Phone -->
         <div class="input-group">
            <input type="text" id="phone" name="phone" required>
            <label>Phone</label>
=======
            <input type="text" id="email_id" name="email_id" required>
            <label>Enter Email</label>
        </div>

        <!-- PHONE -->
         <div class="input-group">
            <input type="text" id="phone_id" name="phone_id" required>
            <label>Enter Phone</label>
>>>>>>> Stashed changes
        </div>

        <!-- DOB -->
        <div class="input-group">
            <input type="date" id="dob" name="dob">
            <label class="static-label">Date of Birth</label>
        </div>

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
