@extends("admin.layout.master")
@section("content")
    <div class="container">
        <div class="body-wrapper row">
            <div class="col-12 mt-2 header-title">
                <div class="new-category ">
                    <a href="{{route("category#createPage")}}">
                        <button class="btn-sm btn bg-primary p-2 text-white right-btn">Add new category</button>
                    </a>
                    <h2 class="heading-text fs-2"> Category List

                    </h2>
                </div>
            </div>


        </div>


        <div class="row">
            <div class="col-4 mt-4 ms-4 ">
               <h4 class="text-primary"> Search :: {{request("key")}}</h4>
            </div>
            <div class="col-7 d-flex justify-content-end mt-4">
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

     @if (count($category) != 0)


            <div class="table-responsive">
                <table class="table table-info mt-5 align-middle text-center">
                    <thead>
                        <tr class="">

                            <th class="col">Id</th>
                            <th class="col">Name</th>
                            <th class="col">Updated_at</th>

                            <th class="col">More Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $c)
                        <tr class="">

                            <td class="col">{{$c->id}}</td>
                            <td class="col">{{$c->name}}</td>
                            <td class="col">{{$c->updated_at->format("j-F-Y")}}</td>
                            <td class="col">
                                <div class="d-flex justify-content-center">
                                    <span class="me-2 fs-4 "><a href="{{route("category#editPage",$c->id)}}"><i class="fa-solid fa-pen-to-square text-dark "></i></a></span>
                                    <span class="fs-4 ms-2"><a href="{{route("category#delete",$c->id)}}"><i class="fa-solid fa-trash text-dark"></i></a></span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>


</div>
    @else
            <h1 class="text-muted offset-4 mt-5">There is no category</h1>
    @endif

    <div class="mt-3 d-flex justify-content-center align-item-center">
        {{$category->links()}}
    </div>

@endsection

