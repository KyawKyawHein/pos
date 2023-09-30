@extends("admin.layout.master")
@section("content")
<div class="container">
    <div class="body-wrapper row">
        <div class="col-12 mt-2 header-title">
            <div class="new-category ">
                <a href="{{route("product#createPage")}}">
                    <button class="btn-sm btn bg-primary p-2 text-white right-btn">Add new product</button>
                </a>
                <h2 class="heading-text fs-2"> Product List

                </h2>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-6 mt-4 ms-4 ">
           <h4 class="text-primary"> Search :: {{request("key")}}</h4>
        </div>
        <div class="col-5 d-flex justify-content-end mt-4">
           <form action="{{route("category#list")}}" method="GET">
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

@if (count($product) != 0)


            <div class="table-responsive">
                <table class="table mt-5 ">
                    <thead>
                        <tr class="align-middle text-center">

                            <th class="col">Image</th>
                            <th class="col">Name</th>
                            <th class="col">Category Name</th>
                            <th class="col">Description</th>
                            <th class="col">Price</th>
                            <th class="col">View Count</th>
                            <th class="col">Updated At</th>


                            <th class="col-1">More Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $p)
                        <tr class="align-middle text-center">

                            <td class="col">
                               <img src="{{asset("storage/".$p->image)}}" class="img-thumbnail" style="width:100px;height:80px" alt="">
                            </td>
                            <td class="col">{{$p->name}}</td>
                            <td class="col">{{$p->category_name}}</td>
                            <td class="col">{{Str::limit($p->description,40)}}</td>
                            <td class="col">{{$p->price}}</td>
                            <td class="col">{{$p->view_count}}</td>
                            <td class="col">{{$p->updated_at->format("j-F-Y")}}</td>
                            <td class="col">
                                <div class="d-flex">
                                    <span class="me-2 fs-4 "><a href="{{route("product#editPage",$p->id)}}"><i class="fa-solid fa-pen-to-square text-dark "></i></a></span>
                                    <span class="fs-4 ms-2"><a href="{{route("product#delete",$p->id)}}"><i class="fa-solid fa-trash text-dark"></i></a></span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
@else
        <h1 class="text-muted offset-4 mt-5">There is no product</h1>
@endif

<div class="mt-3 d-flex justify-content-center align-item-center">
    {{$product->links()}}
</div>

@endsection
