@extends("admin.layout.master")
@section("content")
    <div class="container">
        <div class="row mt-5">
            <div class="col-6">
               <h3>Orders List</h3>
            </div>
            <div class="col-6  d-flex justify-content-center">
                <h3 class="me-3">Total :</h3>
                <h4><i class="fa-solid fa-database me-2"></i>{{count($order)}}</h4>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card my-2">
                <div class="card-body d-flex justify-content-between">
                    <div class="">
                        <p class="text-muted">Pending Orders</p>
                        <b>{{count($pOrder)}}</b>
                    </div>
                    <div class="text-danger">
                        <img src="{{asset("image/graph-time-series.svg")}}" style="width:70px" class=""  alt="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card my-2">
                    <div class="card-body d-flex justify-content-between">
                        <div class="">
                            <p class="text-muted">Shipped Orders</p>
                            <b>{{count($sOrder)}}</b>
                        </div>
                        <div class="text-danger">
                            <img src="{{asset("image/shipped-graph.svg")}}" style="width:70px" class=""  alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card my-2">
                <div class="card-body d-flex justify-content-between">
                    <div class="">
                        <p class="text-muted">Delivered Orders</p>
                        <b>{{count($dOrder)}}</b>
                    </div>
                    <div class="text-danger">
                        <img src="{{asset("image/success.svg")}}" style="width:70px" class=""  alt="">
                    </div>
                </div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card my-2">
                    <div class="card-body d-flex justify-content-between">
                        <div class="">
                            <p class="text-muted">Rejected Orders</p>
                            <b>{{count($rOrder)}}</b>
                        </div>
                        <div class="text-danger">
                            <img src="{{asset("image/loss-graph-finance.svg")}}" style="width:70px" class=""  alt="">
                        </div>
                    </div>
                   </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6  ">
                <h3 class="text-primary">Search :: {{request("key")}}</h3>
            </div>
            <div class="col-6">
                <form action="{{route("admin#orderlist")}}">
                    @csrf
                    <div class="d-flex justify-content-end">
                       <div class="">
                        <input type="text" name="key" class="form-control" placeholder="Search Here" value="{{request("key")}}">
                       </div>
                       <div class="">
                        <a href="">
                            <button class="btn bg-primary ms-2" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </a>
                       </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row mt-5">
            <h5>Order Status</h5>
            <div class="col-xl-5 col-lg-6 col-md-7 col-sm-7 col-7">
                <form action="{{route("order#orderStatus")}}" method="GET" class="d-flex justify-content-start">
                    @csrf

                    <select name="orderStatus" id="" class="form-control w-50" id="">
                        <option value="">All</option>
                        <option value="0"@if (request("orderStatus") == "0") selected @endif>Pending</option>
                        <option value="1"@if (request("orderStatus") == "1") selected @endif>Shipped</option>
                        <option value="2"@if (request("orderStatus") == "2") selected @endif>Delivered</option>
                        <option value="3"@if (request("orderStatus") == "3") selected @endif>Rejected</option>
                    </select>


                    <button class="btn bg-primary ms-3">Search</button>

                </form>
            </div>

        </div>
        <div class="row mb-5">
            <div class="table-responsive mt-5 col-12">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th class="col">Order Code</th>
                            <th class="col">Username</th>
                            <th class="col">Email</th>
                            <th class="col">Amount</th>
                            <th class="col">Order Date</th>
                            <th class="col">Status</th>


                        </tr>
                    </thead>
                    <tbody id="data">
                        @foreach ($order as $o)
                        <tr>

                            <td class="col"><a href="{{route("admin#orderDetail",$o->id)}}" class="text-danger text-decoration-none">{{$o->order_code}}</a></td>
                            <td class="col">{{$o->user_name}}</td>
                            <input type="hidden" value="{{$o->id}}" id="orderId">
                            <td class="col">{{$o->user_email}}</td>
                            <td class="col">{{$o->total_price}} MMK</td>
                            <td class="col">{{$o->created_at->format("j-F-Y")}}</td>
                            <td class="col">
                                <select name="" style="width:140px;" class="currentOrderStatus form-control text-center
                                        @if ($o->status == "0") orderStatus-yellow
                                        @elseif ($o->status == "1") orderStatus-blue
                                        @elseif ($o->status == "2") orderStatus-green
                                        @elseif ($o->status == "3") orderStatus-red
                                        @endif">
                                    <option value="0" @if ($o->status == "0") selected  @endif>Pending</option>
                                    <option value="1" @if ($o->status == "1") selected  @endif>Shipped</option>
                                    <option value="2" @if ($o->status == "2") selected  @endif>Delivered</option>
                                    <option value="3" @if ($o->status == "3") selected  @endif>Rejected</option>
                                </select>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section("javaScript")
    <script>
        $(document).ready(function(){
            $(".currentOrderStatus").change(function(){
                $status = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find("#orderId").val();
                $.ajax({
                    type : "get",
                    url : "/order/changeOrderStatus",
                    data : {
                        "id" : $orderId,
                        "status" : $status,
                    },
                    dataType : "json",
                    success:function(response){

                        location.reload();
                    }

                })

            })
        })
    </script>
@endsection
