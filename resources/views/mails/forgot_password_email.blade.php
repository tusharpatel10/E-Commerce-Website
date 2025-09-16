<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Hi, we have received your request for password reset.</p>

    {{-- <p>Please click <a href="{{ env('APP_URL') . 'resetPassword/' . $token . '?email=' . urlencode($email) }}">Here</a> --}}
    <p>Please click <a href="{{ 'http://127.0.0.1:8000/resetPassword/' . $token . '?email=' . urlencode($email) }}">Here</a>
        to reset your password.</p>

    <h4>Thanks</h4>
    <h4>E-commerce site.</h4>
</body>

</html>
