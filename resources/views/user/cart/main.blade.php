@extends("user.layout.master")
@section("content")

       <div class="container">
        <div class="row">
            <h3 class="text-center my-3">Your Cart</h3>
            <div class="col-lg-8 col-sm-12 col-md-12 table-responsive">

                <table class="table table-striped " id="cartTable">
                    <thead class="text-center">
                        <tr>
                            <th class="col">Image</th>
                            <th class="col">Name</th>
                            <th class="col">Price</th>
                            <th class="col  text-center">Quantity</th>
                            <th class="col">Total</th>
                            <th class="col"></th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @foreach ($cart as $c)
                        <tr class="align-middle">
                            <input type="hidden" name="" id="cartOrderId" value="{{$c->id}}">
                            <input type="hidden" name="" id="productId" value="{{$c->product_id}}">
                            <input type="hidden" name="" id="userId" value="{{$c->user_id}}">
                            <td class="col"><img src="{{asset("storage/".$c->product_image)}}" class="img-thumbnail" alt="" style="width: 70px;" ></td>
                            <td class="col ">{{$c->product_name}}</td>
                            <td class="col" id="price">{{$c->product_price}} MMK</td>

                            <td class="col">
                                <div class="d-flex justify-content-center text-center align-items-center mx-auto">
                                    <button class="btn btn-minus ">-</button>
                                    <input type="text" name="" class="form-control border-0 cart-amount-input text-center mx-2" style="width: 50px" value="{{$c->quantity}}" id="qty">
                                    <button class="btn btn-plus ">+</button>
                                </div>
                            </td>
                            <td class="col" id="indivTotal">{{$c->product_price * $c->quantity}} MMK</td>
                            <td class="col">
                                <button class="removeBtn text-danger btn fs-3"><i class="fa-solid fa-circle-xmark"></i></button>
                            </td>
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
                                    <p id="subTotal">{{$totalPrice}} MMK</p>
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
                                    <p id="finalTotalPrice">{{$totalPrice + 1500}} MMK</p>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn bg-danger text-white" id="clearCartBtn">Clear Cart</button>
                        <button class="btn bg-primary text-white" id="checkoutCartBtn">Checkout</button>
                    </div>
            </div>

        </div>
       </div>

@endsection
@section("script")
       <script>
            $(document).ready(function(){
                $(".btn-minus").click(function(){
                    $parentNode = $(this).parents("tr");
                    $amount = $parentNode.find("#qty").val();
                    if($amount > 0){
                        $amount--;
                        $parentNode.find("#qty").val($amount);
                    }




                    $price = $parentNode.find("#price").text().replace("MMK","");
                    $qty = Number($parentNode.find("#qty").val());
                    $total = $price * $qty;
                    $parentNode.find("#indivTotal").html($total + " MMK")

                    summaryCalculation();
                })

                $(".btn-plus").click(function(){
                    $parentNode = $(this).parents("tr");



                    $amount = $parentNode.find("#qty").val();

                        $amount++;
                        $parentNode.find("#qty").val($amount);





                    $price = $parentNode.find("#price").text().replace("MMK","");
                    $qty = Number($parentNode.find("#qty").val());
                    $total = $price * $qty;
                    $parentNode.find("#indivTotal").html($total + " MMK")


                    summaryCalculation();
                })

                //individual product remove btn

                $(".removeBtn").click(function(){
                   $parentNode = $(this).parents("tr");
                   $orderId = $parentNode.find("#cartOrderId").val();
                   $productId = $parentNode.find("#productId").val();
                   $parentNode.remove();
                   summaryCalculation();
                   $.ajax({
                        type : "GET",
                        url : "/cart/removeBtn",
                        data : {
                            "orderId" : $orderId,
                            "productId" : $productId,
                        },
                        dataType : "json",

                   })

                })

                //clear entire cart btn

                $("#clearCartBtn").click(function(){
                   $("#cartTable tbody tr").remove();
                   $("#subTotal").html("0 MMK");
                   $("#finalTotalPrice").html("1500 MMK");



                   $.ajax({
                    type : "GET",
                    url : "/cart/clearCartBtn",
                    dataType : "json",
                    success: function(response){

                       if(response.message == "success"){
                        window.location.href = "/user/home"
                       }
                    }
                   })
                })

                //order Btn

                $("#checkoutCartBtn").click(function(){
                    $orderList = [];
                    $random = Math.floor(Math.random()* 10000000000);

                    $("#cartTable tbody tr").each(function(index,row){
                        $orderList.push({
                            "user_id" : $(row).find("#userId").val(),
                            "product_id" : $(row).find("#productId").val(),
                            "quantity" : $(row).find("#qty").val(),
                            "total" : $("#finalTotalPrice").html().replace("MMK",""),
                            "order_code" : "SHT"+$random,
                        })
                        console.log($orderList);
                    })

                    $.ajax({
                        type : "GET",
                        url : "/cart/checkoutBtn",
                        data : Object.assign({},$orderList),
                        dataType : "json",

                        success:function(response){
                            if(response.status == "success"){
                                window.location.href = "/user/home"
                            }
                        }

                    })
                })


                function summaryCalculation(){
                    //this is an all item total calculation for entire cart

                    $totalPrice = 0;
                    $("#cartTable tbody tr").each(function(index,row){
                        $totalPrice += Number($(row).find("#indivTotal").text().replace("MMK",""));
                        $("#subTotal").html(`${$totalPrice} MMK`);
                        $("#finalTotalPrice").html(`${$totalPrice + 1500} MMK`)
                    })

                }
            })
       </script>
@endsection

