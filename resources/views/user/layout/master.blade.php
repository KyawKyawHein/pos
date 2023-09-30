<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title")</title>
  <!-- Link to Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset("css/user.css")}}">
</head>
<body class="bg-light">
  <!-- Navigation Bar -->


    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">

    <a class="navbar-brand ms-2" href="" title="Shwe Hin Thar"><img src="{{asset("image/logo.jpg")}}" style="width:80px" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item mx-1">
          <a class="nav-link" href="{{route("user#home")}}">Home</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item mx-1">
          <a class="nav-link" href="#">Services </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link" href="#">History</a>
          </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="#footer">Contact</a>
        </li>
    </ul>
        <div class="d-flex ms-2">
            <div class="">
               @if (Auth::user()->image == null)
                <img src="{{asset("image/default.png")}}" alt="" class="account-img img-thumbnail" style="width:80px">

                @else
                <img src="{{asset("storage/".Auth::user()->image)}}" alt="" class="account-img img-thumbnail" style="width:80px">

               @endif
            </div>
            <div class="dropdown ms-3 me-4">




                <div class="mt-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                       {{Auth::user()->name}}
                      </button>
                      <ul class="dropdown-menu dropdown-menu-dark" >

                        <li><a class="dropdown-item" href="{{route("user#account")}}"><i class="fa-solid fa-user me-2"></i> Account  </a></li>
                        <li><a class="dropdown-item" href="{{route("user#changePasswordPage")}}"><i class="fa-solid fa-key me-2"></i>Security</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li><form action="{{route("logout")}}" method="post">
                            @csrf
                           <a href="" class="dropdown-item"> <button class="btn btn-sm bg-dark text-white" type="submit">Log Out</button></a>
                        </form></li>

                      </ul>
                </div>

          </div>
           </div>




    </div>

</nav>




    @yield("content")


  <footer class="bg-dark text-white mt-5" id="footer">
    <div class="container">

        <div class="row">
          <div class="col-4">
            <h5 class="text-white text-center">About</h5>
            <small class="text-white">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage,covered the undoubtable source</small>
          </div>

          <div class="col-4">
            <h5 class="text-white text-center">Information</h5>
            <small class="text-white">the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</small>
          </div>

          <div class="col-4">
            <h5 class="text-white text-center">Contact</h5>
            <div class="d-flex justify-content-around align-items-center mt-4">
                <p class="fs-4"><a href="" class="text-decoration-none text-white"><i class="fab fa-facebook"></i></a></>
                <p class="fs-4"><a href="" class="text-decoration-none text-white"><i class="fab fa-instagram"></i></a></p>
                <p class="fs-4"><a href="" class="text-decoration-none text-white"><i class="fas fa-envelope"></i></a></p>
                <p class="fs-4"><a href="" class="text-decoration-none text-white"><i class="fab fa-twitter"></i></a></p>
            </div>
            <div class="d-flex justify-content-center mt-3">

              <h5>You can leave a message!</h5>
          </div>
            <div class="d-flex justify-content-center mt-3">

                <a href="{{route("user#contactPage")}}"><button class="btn btn-md btn-danger ms-2">Contact</button></a>
            </div>
          </div>

        </div>
      </div>
    <div class="container">

      <div class="row">
        <div class="col-12">
          <p class="text-center">&copy; 2023 Shwe Hin Thar Company. All rights reserved.</p>
        </div>

      </div>
    </div>
  </footer>
  <!-- Link to Bootstrap JS (Optional for some features) -->


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield("script")
</html>


