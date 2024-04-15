<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>HELLOAIBOX | Sign up</title>
    <style>
        .create_user{
            width: 400px;
            margin-left: 480px;
            margin-top: 40px;
            box-shadow: 0 5px 25px rgba(1 1 1/ 30%);
            border-radius: 20px;
            padding: 30px;
        }
        h2{
            margin-bottom: 10px;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 110px;
            font-weight: bold;
        }
        button{
            width: 100%;
            margin-bottom: 20px;
        }
        a{
            text-decoration: none;
            color: orange;
        }
        p{
            margin-left: 80px;
        }
        .Sign{
            width: 230px;
            margin-left: 55px;
        }
        #in{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form_add create_user">
        <form method="POST" action="{{route('store_compte')}}" >
            @csrf
            <h2>Sgin up</h2>
            <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name">
            @error('name')
            <div  class="form-text text-danger" >{{$message}}</div>
            @enderror
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
            </div>
            <div class="mb-3">
            <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password">
            @error('password')
            <div  class="form-text text-danger">{{$message}}</div>
            @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <p>Already Registred? <a href="{{route('show')}}"> Sign in</a></p>
        </form>
        <a href="auth/google/redirect"  class="btn btn-light active Sign"  id="in">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-1 mb-1" x="0px" y="0px" width="23" height="23" viewBox="0 0 48 48">
                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
            </svg>
            Sign up with Google
        </a>
        <a href="auth/github/redirect" class="btn btn-dark Sign ">
            <svg class="me-1 mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16" >
                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
            </svg>
            Sign up with Github
        </a>
    </div>
</body>
</html>
