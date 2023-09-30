<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<body class="entry">
    <div class=" container" >
       <form class="wrapper mt-4" action="{{route("login")}}" method="post">
        @csrf
        <h3 class="">Login</h3>
        <div class="input-box">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control mt-2" id="" placeholder="Enter your email">
            @error("email")
            <small class="text-danger">{{$message}}</small>
            @enderror

        </div>
        <div class="input-box">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control mt-2" placeholder="Password" id="">
            @error("password")
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        {{-- <div class=" check">
           <input type="checkbox" name="" id="" class="check-box"> <span>I agree to the <a href=""><span>Term of Service</span></a></span>
        </div> --}}
        <button type="submit" class="btn button ">Login </button>
        <div class="register mb-4">
           <span> Dont have an account?</span> <a href="{{route("auth#registerPage")}}">Sign Up Here</a>
           </div>
       </form>

    </div>
</body>
</html>
