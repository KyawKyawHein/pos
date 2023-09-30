@extends("admin.layout.master")
@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>My Account Info</h4>
                </div>
                <div class="card-body row mb-5">

                        <div class=" col-xxl-5 col-md-12 col-lg-5 mb-5">
                            @if (Auth::user()->image == null)
                             <img src="{{asset("image/default.png")}}" alt="" class="account-img img-thumbnail w-75">

                             @else
                            <img src="{{asset("storage/".Auth::user()->image)}}" alt="" class="account-img img-thumbnail w-75">

                             @endif


                        </div>


                        <div class=" col-xxl-5 col-md-12 col-lg-5 ms-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-user me-3"></i>{{Auth::user()->name}}</h5>
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-envelope me-3"></i>{{Auth::user()->email}}</h5>
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-phone me-3"></i>{{Auth::user()->phone}}</h5>
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-location-dot me-3"></i>{{Auth::user()->address}}</h5>
                            <h5 class="fw-bold mb-3">@if (Auth::user()->gender =="male")
                                <i class="fa-solid fa-mars-stroke me-3"></i>

                                @elseif (Auth::user()->gender == "female")
                                <i class="fa-solid fa-venus me-3"></i>
                                @else
                                <i class="fa-solid fa-genderless me-3"></i>
                                @endif
                                @if (Auth::user()->gender == null)
                                    I rather not say
                                @else
                                    {{Auth::user()->gender}}
                                @endif
                            </h5>

                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-certificate me-3"></i>{{Auth::user()->role}}</h5>
                            <a href="{{route("admin#editPage")}}"><button type="submit" class="btn btn-primary mt-3 w-50">Edit Profile</button></a>

                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
