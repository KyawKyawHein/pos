@extends("user.layout.master")
@section("content")
    <div class="container ">
        <div class="row">

            <div class="mt-3 col-xxl-6 col-xl-6  col-lg-7 col-md-12 col-sm-12  d-flex justify-content-center align-items-center py-5 detail-product-img">
                <img src="{{asset("storage/".$product->image)}}" class="img-thumbnail  shadow-sm w-50" alt="">
            </div>
            <div class="mt-3 col-xxl-6 col-xl-6 col-lg-5 col-md-12 col-sm-12">
                <div class=" card detail-product">
                    <h3 class="text-center card-header">    {{$product->name}}</h3>
                    <input type="hidden" name="" id="product-id" value="{{$product->id}}">
                    <input type="hidden" name="" id="user-id" value="{{Auth::user()->id}}">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-list me-3 text-primary"></i>{{$product->category_name}}</h5>
                       <div class="">
                        <i class="fa-solid fa-file-lines me-3 text-primary fs-4"></i><small class=" text-muted">{{$product->description}}</small>
                       </div>
                       <div class="mt-2">
                        <i class="fa-solid fa-eye me-2 text-primary fs-5"></i> {{$product->view_count}} times viewed
                       </div>
                       <div class="mt-2">
                        <i class="fa-solid fa-dollar-sign fs-4 text-primary me-3"></i>{{$product->price}} MMK
                       </div>
                       <div class="my-2">
                        <i class="fa-solid fa-calendar-days text-primary fs-5  me-2"></i> {{$product->updated_at->format("j-F-Y")}}
                       </div>

                        <div class="my-2 text-center">
                            <div class="input-group" style="width: 130px">
                               <div class="input-group-btn">
                                   <button class="btn btn-minus">
                                       <i class="fa fa-minus"></i>
                                   </button>
                               </div>
                               <input type="number" name="" class="form-control border-0 text-center" value="1" id="product-amount">
                               <div class="input-group-btn">
                                   <button class="btn btn-plus">
                                       <i class="fa fa-plus"></i>
                                   </button>
                               </div>
                            </div>
                            <div class="text-center mt-3">
                               <button class="btn btn-dark text-center shadow-lg" id="buyBtn">Buy Now<i class="fa-solid fa-cart-plus ms-2"></i></button>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div class="text-center mb-4">
        <h3>You May Also Like</h3>
    </div>
    <div class="container">
        <div class="row">

            @foreach ($categoryP as $cP)

            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 d-flex justify-content-center detail-view">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset("storage/".$cP->image)}}" class="w-100 img-thumbnail align-self-center" style="height:14rem"   alt="">
                    <div class="card-body">
                      <h5 class="card-title">{{$cP->name}}</h5>
                      <p class="card-text">{{Str::limit($cP->description,40)}}</p>
                      <h5 class="text-success mb-3 text-center">{{$cP->price}} MMK</h5>
                      <input type="hidden" name="" class="view_productId" value="{{$cP->id}}">
                      <div class="d-flex justify-content-evenly align-items-center">

                        <a href="{{route("product#detail",[$cP->id,$cP->category_id])}}">     <button class="btn btn-dark forView" type="submit">       <i class="fa-solid fa-circle-info"></i> </button></a>

                            <a href=""><button class="btn btn-dark"><i class="fa-solid fa-cart-shopping"></i></button></a>



                    </div>
                    </div>
                  </div>
               </div>

            @endforeach

        </div>

    </div>
@endsection

@section("script")
    <script>
        $(document).ready(function(){
            $(".btn-minus").click(function(){
                $amount= $("#product-amount").val();
                if($amount > 1){
                    $amount--;
                    $("#product-amount").val($amount);

                }

            })

            $(".btn-plus").click(function(){
               $amount = $("#product-amount").val();
               $amount++;
               $("#product-amount").val($amount);

            })

            $("#buyBtn").click(function(){
                $amount = $("#product-amount").val();
                $productId = $("#product-id").val();
                $userId = $("#user-id").val();
                $.ajax({
                    "type" : "GET",
                    "url" : "/cart/addToCart",
                    "data" : {
                        "quantity" : $amount,
                        "product_id"     : $productId,
                        "user_id" : $userId,
                    },
                    "dataType" : "json",
                    success:function(response){
                       window.location.href = "/user/home"
                    }
                })
            })
            $(".forView").click(function(){
              $parentNode = $(this).parents(".detail-view")
              $productId = $parentNode.find(".view_productId").val();
              $.ajax({
                "type" : "GET",
                "url"  : "/product/viewCount",
                "data" : {
                    "productId" : $productId,
                },
                "dataType" : "json",

              })
        })
        })
    </script>



@endsection
