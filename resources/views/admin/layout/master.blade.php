<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("Title")</title>
    <link rel="stylesheet" href="{{asset("css/admin.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>



    <div class="ryry bg-secondary">

        <div class="container">


                <nav class="row py-3 navbar">
                    <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-6 container-fluid text-center"><h3 class="fs-2 text-info">Shwe Hin Thar</h3></div>
                   <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6 d-flex justify-content-end">
                    <div class="">
                       @if (Auth::user()->image == null)
                        <img src="{{asset("image/default.png")}}" alt="" class="account-img img-thumbnail">

                        @else
                        <img src="{{asset("storage/".Auth::user()->image)}}" alt="" class="account-img img-thumbnail" style="width:80px">

                       @endif
                    </div>
                    <div class="dropdown ms-3">




                        <div class="mt-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                               {{Auth::user()->name}}
                              </button>
                              <ul class="dropdown-menu dropdown-menu-dark" >
                                <li><a class="dropdown-item" href="{{route("admin#detail")}}"><i class="fa-solid fa-user me-2"></i> Account  </a></li>
                                <li><a class="dropdown-item" href="{{route("admin#passwordChangePage")}}"><i class="fa-solid fa-key me-2"></i>Security</a></li>
                                <li><a class="dropdown-item" href="{{route("admin#list")}}"><i class="fa-solid fa-user-tie me-2"></i>Admins List</a></li>
                                <li><a class="dropdown-item" href="{{route("admin#userList")}}"><i class="fa-solid fa-user-tie me-2"></i>Users List</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><form action="{{route("logout")}}" method="post">
                                    @csrf
                                   <a href="" class="dropdown-item"> <button class="btn btn-sm bg-dark text-white" type="submit">Log Out</button></a>
                                </form></li>

                              </ul>
                        </div>

                  </div>
                   </div>
                </nav>

        </div>
        <div class=" row">
            {{--aside start--}}

                <div class="col-lg-2 col-md-3 col-sm-12  menu-sidebar d-flex justify-content-center align-items-center">
                    <div class="">
                        <nav class="navbar-sidebar ">
                            <ul class="list-unstyled fs-5">
                                <li>
                                    <a href="{{route("category#list")}}"><i class="fa-solid fa-list me-2"></i>Category</a>
                                </li>
                                <li>
                                    <a href="{{route("product#list")}}"><i class="fa-solid fa-fan me-2"></i>Product</a>
                                </li>
                                <li>
                                    <a href="{{route("admin#orderlist")}}"><i class="fa-solid fa-list me-2"></i>Order</a>
                                </li>
                                <li>
                                    <a href="{{route("admin#contactPage")}}"><i class="fa-solid fa-list me-2"></i>Contact</a>
                                </li>


                            </ul>
                        </nav>
                    </div>
                </div>

            {{-- aside end --}}


                     {{-- list body start --}}


                     <div class="col-lg-10 col-md-9 col-sm-12 list-body">


                            @yield("content")

                    </div>


                        {{-- list body end --}}

         </div>

    </div>



</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
@yield("javaScript")
</html>


