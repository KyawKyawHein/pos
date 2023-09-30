<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<body class="entry">
    <div class=" container" >
       <form class="wrapper mt-4" method="post" action="{{route("register")}}">
        @csrf
        <h3 class="">Register</h3>
        @error("terms")
            <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="input-box">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control mt-2" id="" placeholder="e.g. Mg Mg">
            @error("name")
            <small class="text-danger">{{$message}}</small>
            @enderror

        </div>
        <div class="input-box">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control mt-2" id="" placeholder="e.g. mgmg@gmail.com">
            @error("email")
            <small class="text-danger">{{$message}}</small>
            @enderror

        </div>
        <div class="input-box">
            <label for="">Phone</label>
            <input type="text" name="phone" class="form-control mt-2" id="" placeholder="e.g. 09xxxxxx">
            @error("phone")
            <small class="text-danger">{{$message}}</small>
            @enderror

        </div>
        <div class="input-box">
            <label for="">Address</label>
            <input type="text" name="address" class="form-control mt-2" id="" placeholder="e.g. Mandalay">
            @error("address")
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
        <div class="input-box">
            <label for="">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Password" id="">
            @error("password_confirmation")
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        {{-- <div class=" check">
           <input type="checkbox" name="" id="" class="check-box"> <span>I agree to the <a href=""><span>Term of Service</span></a></span>
        </div> --}}
        <button type="submit" class="btn button ">Register </button>
        <div class="register mb-3">
           <span> Already have an account?</span> <a href="{{route("auth#loginPage")}}">Login Here</a>
           </div>
       </form>

    </div>
</body>
</html>
