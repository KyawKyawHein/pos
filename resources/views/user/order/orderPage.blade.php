@extends("user.layout.master")
@section("content")

    <div class="container mt-4">

        <div class="row">
            <div class="col-12 mb-4">
                <div class="text-center ">
                    <i class="fa-solid fa-circle-check text-success order-page-sign"></i>
                </div>
                <h3 class="text-center text-capitalize mb-4">Your Orders are placed and processing to be delivered !</h3>
                <div class="text-center mb-1">
                    <p class=" p-1 text-danger">You can check your order detail by clicking the order code <i class="fa-solid fa-circle-info"></i></p>
                </div>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-info text-center">
                    <thead>
                        <tr>

                            <th>Username</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($order as $o)
                            <tr>
                                <td>{{$o->user_name}}</td>
                                <td><a href="{{route("user#orderDetailPage",$o->order_code)}}" class="text-decoration-none text-danger">{{$o->order_code}}</a></td>
                                <td>{{$o->total_price}}</td>
                                <td>{{$o->created_at->format("j-F-Y")}}</td>
                                <td>@if ($o->status == 0)
                                   <div class="">
                                    <span class="text-warning me-1">Pending</span> <i class="fa-solid fa-question text-warning"></i>
                                   </div>
                                @elseif ($o->status == 1)
                                <div class="">
                                    <span class="text-success me-2">Shipped</span><i class="fa-solid fa-truck-fast text-success"></i>
                                </div>
                                @elseif($o->status ==2)
                                <div class="">
                                    <span class="text-success me-2">Delievered</span><i class="fa-solid fa-circle-check text-success"></i>
                                </div>
                                @elseif ($o->status == 3)
                                <div class="">
                                    <span class="text-danger me-2">Rejected</span><i class="fa-solid fa-circle-exclamation text-danger"></i>
                                   </div>
                                @endif
                            </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
