@extends("user.layout.master")
@section("content")
   <div class="container">
    <div class="row mt-4">
        <div class="col-12 text-center">
            <h3>Contact Us</h3>
        </div>
    </div>
    <div class="row ">
        <div class=" d-flex justify-content-center col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12 mt-4">
            <div class="">
                <div class="d-flex my-3">
                    <div class="fs-3 text-danger"><i class="fa-solid fa-phone"></i></div>
                    <div class="fs-5 ms-3">
                        <div class="">Phone</div>

                        <div class="">09751833827</div>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="fs-3 text-danger"><i class="fa-solid fa-envelope"></i></div>
                    <div class="fs-5 ms-3">
                        <div class="">Email</div>

                        <div class="">shwehinthar@gmail.com</div>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="fs-3 text-danger"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="fs-5 ms-3">
                        <div class="">Address</div>

                        <div class="">Madaya</div>
                    </div>
                </div>


            </div>

        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-4">
            @if (session("createSuccess"))
                  <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session("createSuccess")}}
                        <i class="fa-solid fa-check"></i>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>



             @endif
            <div class="contact-form">
                <form action="{{route("user#contactMessage")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label for="" class="text-danger mb-2">Your Name</label>
                            <input type="text" placeholder="Username" name="userName" value="{{Auth::user()->name}}"  class="@error("userName") is-invalid @enderror form-control-lg form-control border-0 fs-6">
                            @error("userName")
                            <small class="text-danger">{{$message}}</small>
                             @enderror
                        </div>

                        <div class="col-lg-7 mb-4">
                            <label for="" class="text-danger mb-2">Your Phone</label>
                            <input type="number" placeholder="User Phone" name="userPhone" value="{{Auth::user()->phone}}"  class="@error("userPhone") is-invalid @enderror form-control-lg form-control border-0 fs-6">
                            @error("userPhone")
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <label for="" class="text-danger mb-2">Your Email</label>
                            <input type="email" placeholder="User Email" name="userEmail" value="{{Auth::user()->email}}"  class="@error("userEmail") is-invalid @enderror form-control-lg form-control border-0 fs-6">
                            @error("userEmail")
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <textarea name="userMessage" id="" cols="30" rows="10" class="@error("userMessage") is-invalid @enderror form-control-lg form-control border-0 fs-6" placeholder="Your Message"></textarea>
                            @error("userMessage")
                            <small class="text-danger">{{$message}}</small>
                             @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <button class="btn btn-danger px-3">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>
@endsection
