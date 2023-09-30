@extends("admin.layout.master")
@section("content")

    <div class="container">
        <div class="row mt-5">
            <div class="col-12">

                    <div class="">
                        <h4>Order Number <b class="text-danger">#{{$detail[0]->order_code}}</b></h4>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-danger align-middle text-center">
                            <thead>
                                <tr>
                                    <th class="col-2">Image</th>
                                    <th class="col">Name</th>
                                    <th class="col">Qty</th>
                                    <th class="col">Price</th>
                                    <th class="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $d)
                                <tr>
                                    <td class="col-2">
                                        <img src="{{asset("storage/".$d->product_image)}}" style="width:110px" alt="">
                                    </td>
                                    <td class="col">{{$d->product_name}}</td>
                                    <td class="col">{{$d->quantity}}</td>
                                    <td class="col">{{$d->product_price}} MMK</td>
                                    <td class="col">{{$d->quantity * $d->product_price}} MMK</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


            </div>

        </div>
        <div class="row mb-5">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h4> Customer Details </h4>
                    </div>
                    <div class="card-body bg-">
                        <div class="d-flex justify-content-between my-4 align-items-center">
                            <b>Customer Image</b>
                            <div class="">
                                @if ($detail[0]->user_image != null)
                                <img src="{{asset("storage/".$detail[0]->user_image)}}" class="img-thumbnail" style="width:100px;height:98px" alt="">
                                @else
                                <img src="{{asset("image/default.png")}}" class="img-thumbnail" style="width:100px;height:98px" alt="">
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between my-4">
                            <b>Customer Name</b>
                        <b>{{$detail[0]->user_name}}</b>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between my-4">
                            <b>Customer Phone</b>
                        <b>{{$detail[0]->user_phone}}</b>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between my-4">
                            <b>Customer Email</b>
                        <b>{{$detail[0]->user_email}}</b>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between my-4">
                            <b>Customer Address</b>
                        <b>{{$detail[0]->user_address}}</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mt-5">
                <div class="card">

                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <p>Order Status</p>
                            @if ($detail[0]->status == 0)
                            <p class="text-warning">Pending</p>
                             @elseif($detail[0]->status == 1)
                             <p class="text-primary">Shipped</p>
                             @elseif($detail[0]->status == 2)
                             <p class="text-success">Delivered</p>
                            @elseif($detail[0]->status == 3)
                            <p class="text-danger">Rejected</p>
                             @endif

                        </div>
                        <div class="d-flex justify-content-between my-3">
                            <p>Order Created</p>
                        <p>{{$detail[0]->created_at->format("j-F-Y")}}</p>
                        </div>

                        <div class="d-flex justify-content-between my-3">
                            <p>Order Time</p>
                        <p>{{$detail[0]->created_at->format("g:i A")}}</p>
                        </div>
                        <div class="d-flex justify-content-between my-3">
                            <p>Subtotal</p>
                        <p>{{$detail[0]->total_price -1500}} MMK</p>
                        </div>
                        <div class="d-flex justify-content-between my-3">
                            <p>Delivery Fee</p>
                        <p>1500 MMK</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between mb-2">
                            <p>Total</p>
                        <p>{{$detail[0]->total_price}} MMK</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
