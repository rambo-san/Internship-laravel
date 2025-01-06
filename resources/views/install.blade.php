<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install Application</title>
</head>
<body>
    <h1>Application Installation</h1>
    <form action="/" method="POST">
        @csrf
        <label for="name">Admin Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Admin Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br>
        
        <label for="auth_code">Authentication Code:</label>
        <input type="text" id="auth_code" name="auth_code" required><br>

        <button type="submit">Install</button>
    </form>

    @if(session('alert'))
        <div class="alert alert-{{ session('alert.type') }}">
            {{ session('alert.message') }}
        </div>
    @endif
    
</body>
</html>
