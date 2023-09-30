@extends("admin.layout.master")
@section("content")
    <div class="d-flex justify-content-center align-items-center w-100 ">
        <form action="{{route("product#create")}}" class="card py-3 px-5 mt-5" method="post" enctype="multipart/form-data" >
            @csrf
            <h2 class="">Create Product</h2>
            <div class="mb-2">
                <label for="" class="mb-2">Name</label>
                 <input type="text" name="productName" class="form-control @error("productName") is-invalid @enderror">
            </div>
            @error("productName")
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="mb-2">
                <label for=""class="mb-2">Category Name</label>

                 <select name="categoryName" id="" class="form-control  @error("categoryName") is-invalid @enderror">
                    <option value="" selected>Choose a category</option>
                    @foreach ($category as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                 </select>

            </div>
            @error("categoryName")
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="mb-2">
                <label for="" class="mb-2">Description</label>
                 <textarea name="productDescription" class="form-control  @error("productDescription") is-invalid @enderror" id="" cols="30" rows="10"></textarea>
            </div>
            @error("productDescription")
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="mb-2">
                <label for="" class="mb-2">Price</label>
                 <input type="number" class="form-control  @error("productPrice") is-invalid @enderror" name="productPrice">
            </div>
            @error("productPrice")
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="mb-2">
                <label for="" class="mb-2">Image</label>
                 <input type="file" class="form-control  @error("image") is-invalid @enderror" name="image">
            </div>
            @error("image")
            <span class="text-danger">{{$message}}</span>
            @enderror

            <button class="btn btn-primary mt-4">Create</button>
        </form>
    </div>
@endsection
