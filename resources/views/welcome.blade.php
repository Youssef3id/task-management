<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to My Website</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f3f4f6;
            color: #2d3748;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 3rem;
            color: #1a202c;
        }

        p {
            font-size: 1.25rem;
            color: #4a5568;
        }

        .btn {
            background-color: #3182ce;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #63b3ed;
        }
    </style>
</head>

<body>
    <h1>Welcome to My Task Management System</h1>
    <p>This is a simple, efficient platform to manage your tasks and projects. Get started by creating your first
        project!</p>

    @if (Auth::check())
        <a href="{{ route('dashboard') }}" class="btn">Go to Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="btn">Login</a>
        <p>or</p>
        <a href="{{ route('register') }}" class="btn">Register</a>
    @endif
</body>

</html>
