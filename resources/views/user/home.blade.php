@extends("user.layout.master")
@section("content")
      <!-- Main Content Section -->

  <div class=" mt-2">

    <div class="row">
        <div class="col-md-3">
            <!-- Aside Section -->
            <aside class="bg-light p-4">
              <h2 class="fs-5">Filter By Category</h2>
              <ul class="list-unstyled">
                <li class="my-2"><a class="text-decoration-none text-secondary" href="{{route("user#home")}}"><i class="fa-solid fa-list-ul me-2"></i>All </a></li>
              @foreach ($category as $c)

                <li class="my-2"><a class="text-decoration-none text-secondary" href="{{route("user#filter",$c->id)}}"><i class="fa-solid fa-list-ul me-2"></i>{{$c->name}} </a></li>


              @endforeach
            </ul>
            </aside>
          </div>

      <div class="col-md-9 product-base">
         <article>
          <div class="">
            <h3 class="text-center fs-3 text-white mb-5">Product Available</h3>
            <div class=" mb-3 ms-1">
               <a href="{{route("cart#page")}}" class="text-decoration-none">
                 <button class="btn btn-sm bg-danger position-relative">
                    <i class="fa-solid fa-cart-plus text-white fs-5 p-1"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                       {{count($cart)}}
                        </span>


            </button>
            </a>

               <a href="{{route("order#userOrderPage")}}"> <button class="btn btn-sm bg-danger ms-3"><i class="fa-solid fa-book text-white fs-5 p-1 "></i></button></a>
            </div>
           <div class="d-flex justify-content-between mb-5 ms-1">
            <form action="{{route("user#home")}}" method="GET">
                @csrf
                <div class="d-flex">
                    <input type="text" name="key"  class="form-control" value="{{request("key")}}" style="width: 170px" placeholder="Search Here"><button class="btn btn-md bg-primary ms-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <div class="me-3">

               <select name="sorting"  class="form-control" style="width: 170px" id="product-time">
                <option value="">Choose option...</option>
                <option value="asc">Oldest</option>
                <option value="desc">Newest</option>
               </select>
            </div>
           </div>
        </div>

            <div class="row" id="product-data-change">


                @if (count($product) !=0)
                @foreach ($product as $p)
                <div class=" col-xxl-4 col-xl-4 col-md-6 col-sm-6 my-2 d-flex justify-content-center detail-view">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset("storage/".$p->image)}}" class="w-100 img-thumbnail align-self-center" style="height:14rem"   alt="">
                        <div class="card-body">
                          <h4 class="card-title text-center">{{$p->name}}</h4>
                          <h5 class="text-primary">{{$p->category_name}}</h5>
                          <p class="card-text">{{Str::limit($p->description,40)}}</p>
                          <h5 class="text-success mb-3 text-center">{{$p->price}} MMK</h5>
                          <input type="hidden" name="" class="view_productId" value="{{$p->id}}">
                          <div class="d-flex justify-content-evenly align-items-center">

                            <a href="{{route("product#detail",[$p->id,$p->category_id])}}">     <button class="btn btn-dark forView" type="submit">       <i class="fa-solid fa-circle-info"></i> </button></a>

                                <a href="#"><button class="btn btn-dark"><i class="fa-solid fa-cart-shopping"></i></button></a>



                        </div>
                        </div>
                      </div>
                   </div>

                @endforeach
                <div class="mt-3 text-primary d-flex justify-content-center">
                    {{$product->links()}}
                   </div>

                @else
                   <h3 class="text-danger text-center p-5 mb-4">There is no product available currently</h3>
                @endif
            </div>

         </article>


    </div>

  </div>
@endsection
@section("script")
<script>
    $(document).ready(function(){
        $("#product-time").change(function(){
            $status = $("#product-time").val();

            if($status == "asc"){
                $.ajax({
                    "type" : "GET",
                    "url" : "/product/sortingList",
                    "data" : {
                        "status" : "asc"
                    },
                    "dataType" : "json",
                    success:function(response){
                        $list=``;
                        for($i=0;$i<response.length;$i++){


                         $list +=`   <div class=" col-xxl-4 col-xl-4 col-md-6 col-sm-6 my-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('storage/${response[$i].image}')}}" class="w-100 img-thumbnail align-self-center" style="height:14rem"   alt="">
                        <div class="card-body">
                          <h4 class="card-title text-center">${response[$i].name}</h4>
                          <h5 class="text-primary">${response[$i].category_name}</h5>
                          <p class="card-text">${response[$i].description.substr(0,100)}</p>
                          <h5 class="text-success mb-3 text-center">${response[$i].price} MMK</h5>
                          <div class="d-flex justify-content-evenly align-items-center">

                            <a href="">     <button class="btn btn-dark" type="submit">       <i class="fa-solid fa-circle-info"></i> </button></a>

                                <a href=""><button class="btn btn-dark"><i class="fa-solid fa-cart-shopping"></i></button></a>



                        </div>
                        </div>
                      </div>
                   </div>
                         `

                        }
                        $("#product-data-change").html($list);
                    }
                })
            }
            if($status == "desc"){
                $.ajax({
                    type : "GET",
                    url : "/product/sortingList",
                    data : {
                        "status" : "desc"
                    },
                    dataType : "json",
                    success:function(response){
                        $list = ``;
                        for($i=0;$i<response.length;$i++){
                            $list += `<div class=" col-xxl-4 col-xl-4 col-md-6 col-sm-6 my-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('storage/${response[$i].image}')}}" class="w-100 img-thumbnail align-self-center" style="height:14rem"   alt="">
                        <div class="card-body">
                          <h4 class="card-title text-center">${response[$i].name}</h4>
                          <h5 class="text-primary">${response[$i].category_name}</h5>
                          <p class="card-text">${response[$i].description.substr(0,100)}</p>
                          <h5 class="text-success mb-3 text-center">${response[$i].price} MMK</h5>
                          <div class="d-flex justify-content-evenly align-items-center">

                            <a href="">     <button class="btn btn-dark" type="submit">       <i class="fa-solid fa-circle-info"></i> </button></a>

                                <a href=""><button class="btn btn-dark"><i class="fa-solid fa-cart-shopping"></i></button></a>



                        </div>
                        </div>
                      </div>
                   </div>
                            `

                        }
                        $("#product-data-change").html($list);
                    }
                })
            }
        })
        $(".forView").click(function(){
              $parentNode = $(this).parents(".detail-view");
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
