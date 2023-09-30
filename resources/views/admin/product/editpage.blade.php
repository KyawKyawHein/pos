@extends("admin.layout.master")
@section("content")
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Edit Your Product</h4>
                </div>
                <div class="card-body">
                    <form class="row" method="post" action="{{route('product#update')}}" enctype="multipart/form-data">
                        @csrf


                        <div class="col-4 offset-1">



                            <img src="{{asset("storage/".$product->image)}}" alt="" class="account-img img-thumbnail w-100">


                            <input type="file" name="image" class="form-control @error("image") is-invalid  @enderror mt-3" id="">
                            @error("image")
                            <span class="text-danger">{{$message}}</span>
                             @enderror
                        </div>

                        <input type="hidden" name="productId" value="{{$product->id}}">
                        <div class="col-4 offset-1">

                            <div class="form-group mb-2">
                                <label for="productName">Name</label>
                                <input type="text" class="form-control mt-1 @error("productName") is-invalid  @enderror" name="productName" value="{{$product->name}}" id="productName" placeholder="Enter your product name">
                            </div>
                            @error("productName")
                            <span class="text-danger">{{$message}}</span>
                             @enderror
                            <div class="form-group my-2">
                                <label for="categoryName">Category Name</label>
                                <select name="categoryName" class="form-control mt-1 @error("categoryName") is-invalid  @enderror" id="">
                                    @foreach ($category as $c)
                                        <option value="{{$c->id}}" @if ($product->category_id == $c->id)
                                            selected
                                        @endif>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("categoryName")
                            <span class="text-danger">{{$message}}</span>
                             @enderror
                            <div class="form-group my-2">
                                <label for="Descriptipn">Descriptipn</label>
                                <textarea name="productDescription" id="" cols="30" rows="10" class="form-control mt-1 @error("productDescription") is-invalid  @enderror" placeholder="Enter your product description">{{$product->description}}</textarea>
                            </div>

                            @error("productDescription")
                            <span class="text-danger">{{$message}}</span>
                             @enderror


                            <div class="form-group my-2">
                                <label for="Price">Price</label>
                                <input type="number" class="form-control mt-1 @error("productPrice") is-invalid  @enderror" name="productPrice" id="Price" placeholder="Enter your product price" value="{{$product->price}}">
                            </div>
                            @error("productPrice")
                            <span class="text-danger">{{$message}}</span>
                             @enderror


                            <div class="form-group my-2">
                                <label for="">View Count</label>
                                <input type="number" class="form-control mt-1" id="" placeholder="" disabled value="{{$product->view_count}}">
                            </div>


                        </div>
                        <div class="col-4 offset-6">
                            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
