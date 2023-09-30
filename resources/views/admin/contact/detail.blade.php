@extends("admin.layout.master")
@section("content")
    <div class="container">
        <div class="row text-center mt-5">
            <h3>Customer Feedback Detail</h3>
        </div>
        <div class="row mb-5">
            <div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12  mt-5">
                <div class="card">
                    <div class="card-header py-4 text-center">
                        <h5>Customer Detail</h5>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="">
                            <div class="d-flex my-3">
                                <div class="fs-3 text-danger"><i class="fa-solid fa-user"></i></div>
                                <div class="fs-5 ms-3">
                                    <div class="">Name</div>

                                    <div class="">{{$contact->name}}</div>
                                </div>
                            </div>
                            <div class="d-flex my-3">
                                <div class="fs-3 text-danger"><i class="fa-solid fa-phone"></i></div>
                                <div class="fs-5 ms-3">
                                    <div class="">Phone</div>

                                    <div class="">{{$contact->phone}}</div>
                                </div>
                            </div>
                            <div class="d-flex my-3">
                                <div class="fs-3 text-danger"><i class="fa-solid fa-envelope"></i></div>
                                <div class="fs-5 ms-3">
                                    <div class="">Email</div>

                                    <div class="">{{$contact->email}}</div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-5">
                <div class="card">
                    <div class="card-header py-4 text-center">
                        <h5>Cutsomer's Message</h5>
                    </div>
                    <div class="card-body">
                       <div class="d-flex ">
                        <div class="fs-1 text-danger ms-2">
                            <i class="fa-solid fa-comment"></i>
                        </div>
                        <div class="fs-5 ms-3">
                            <p>{{$contact->message}}</p>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
