@extends("user.layout.master")
@section("content")
    <div class="container">

        <div class="row">
            <div class="col-12 card mt-4">
                <div class="d-flex justify-content-between align-items-center order-thing">
                        <p class="m-4">Order Code #  <span class="text-danger">{{$detail[0]->order_code}} </span> </p>
                        <p class="m-4">Expected Arrival {{$futureDate->format("j-F-Y")}}</p>
                </div>
                @if ($order->status == 3)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry, your order is rejected! </strong> <span class="ms-1">You should try contacting us for more info</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
                <input type="hidden" value="{{$order->status}}" id="status">
                <div class="progress mb-4" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar"  id="progress-bar"  style="width:2%">
                    </div>
                  </div>
                <div class="row">
                    <div class="col-3" id="rejectState">
                      <div class="ms-3"> <i class="fa-solid fa-triangle-exclamation fs-3 text-center"></i></div><p class="">Rejected</p>
                    </div>
                    <div class="col-3 text-center" id="processState"><i class="fa-solid fa-laptop-code fs-3"></i><p class="">Processing</p></div>
                    <div class="col-3 text-center" id="shippedState"><i class="fa-solid fa-truck-fast fs-3"></i><p>Shipped</p></div>
                    <div class="col-3 text-center"id="successState"><i class="fa-solid fa-house-circle-check fs-3"></i><p>Delievered</p></div>
                </div>


            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-8 col-md-12 table-responsive">
                <table class="table table-danger">
                    <thead class="text-center">
                        <tr>
                            <th class="col">Image</th>
                            <th class="col">Name</th>
                            <th class="col">Price</th>
                            <th class="col">Quantity</th>
                            <th class="col">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">
                        @foreach ($detail as $p)
                        <tr>
                            <td class="col-1"><img src="{{asset("storage/".$p->product_image)}}" style="width:100px; height:80px" alt=""></td>
                            <td class="col-2">{{$p->product_name}}</td>
                            <td class="col-2">{{$p->product_price}}</td>
                            <td class="col-2">{{$p->quantity}}</td>
                            <td class="col">{{$p->product_price * $p->quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 cart-checkout-total ">
                <div class="cart-total">
                   <div class="cart-total-header card-header">
                    <h5 class="">Order Summary</h5>
                   </div>
                    <div class="cart-total-body mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="my-3">
                                <p>Subtotal :</p>
                                <p>Shipping :</p>

                            </div>
                            <div class="my-3">
                                <p id="subTotal">{{$detail[0]->total -1500}} MMK</p>
                                <p>1500  MMK</p>


                            </div>

                        </div>
                    </div>
                    <div class="cart-total-footer mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="">

                                <h5 class="">Total :</h5>

                            </div>
                            <div class="">
                                <p id="finalTotalPrice">{{$detail[0]->total}} MMK</p>
                            </div>
                        </div>
                    </div>


                </div>

        </div>

        </div>

    </div>
@endsection

@section("script")
    <script>
        $(document).ready(function(){
            $status = $("#status").val();
            $progress = $("#progress-bar");

            if($status == 0){
                $progress.css("width","38%");
                $("#processState").css("color","blue")
            }
            if($status == 1){
                $progress.css("width","64%")
                $("#shippedState").css("color","blue")
            }
            if($status == 2){
                $progress.css("width","100%")
                $("#successState").css("color","blue")
            }
            if($status == 3){
                $progress.css("width","0%")
                $("#rejectState").css("color","red")
            }
        })
    </script>
@endsection
