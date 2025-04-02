<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('assets/img/logo/logo.jpg')}}" rel="icon"  sizes="32x32">
  <title>Ministry of Home Affairs Login</title>
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #254260; border-color: #254260; color: white;
      /* background: linear-gradient(135deg, #4a90e2, #50e3c2); */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
    }

    .forgot-password-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 2.5rem;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .forgot-password-container h2 {
      margin-bottom: 1.5rem;
      font-size: 2rem;
      color: #333;
      font-weight: 600;
    }

    .forgot-password-container .input-group {
      margin-bottom: 1.5rem;
      text-align: left;
      position: relative;
    }

    .forgot-password-container .input-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #555;
    }

    .forgot-password-container .input-group input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
      padding-left: 40px;
    }

    .forgot-password-container .input-group input:focus {
      border-color: #4a90e2;
      box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
      outline: none;
    }

    .forgot-password-container .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 1.1rem;
    }

    .forgot-password-container button {
      width: 100%;
      padding: 0.75rem;
      background-color: #254260; border-color: #254260; color: white;
      /* background: linear-gradient(135deg, #4a90e2, #50e3c2); */
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .forgot-password-container button:hover {

      background-color: #254260; border-color: #254260; color: white;
      /* background: linear-gradient(135deg, #4a90e2, #50e3c2); */
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
    }

    .forgot-password-container .back-to-login {
      margin-top: 1rem;
      font-size: 0.9rem;
      color: #666;
    }

    .forgot-password-container .back-to-login a {
      color: #4a90e2;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .forgot-password-container .back-to-login a:hover {
      color: #50e3c2;
    }
  </style>
</head>
<body>
  <div class="forgot-password-container">
    <h2>Forgot Password</h2>
    @if(Session::has('message'))
<div class="alert alert-success" style="color: red;">
{{Session::get('message')}}
</div>
                @endif
    <form action="{{ route('admin.reset') }}" method="POST">
        @csrf
      <div class="input-group">
        

        <label for="email">Enter your email address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        @if($errors->any())
        <div style="color: red;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

      </div>

      <button type="submit">Submit</button>
    </form>

    <div class="back-to-login">
      <a href="{{ route('admin.login') }}">Back to Login</a>
    </div>
  </div>
</body>
</html>
