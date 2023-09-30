@extends("admin.layout.master")
@section("content")
   <div class="row">
        <div class="col-4 offset-4 mt-5 ">
            <div class="d-flex justify-content-center mt-5 align-items-center create-space">
                <form class="wrapper mt-4" method="post" action="{{route("category#create")}}">
                    @csrf
                    <h3 class="text-warning mb-5">Create Category</h3>
                    @error("terms")
                        <small class="text-danger">{{$message}}</small>
                    @enderror

                    <div class="mt-5">
                        <label for="" class="text-white mb-3 fs-5">Category Name</label>
                        <input type="text" name="categoryName" class="form-control mb-2 @error("categoryName")

                        @enderror" id="" placeholder="e.g. Fan">
                    </div>
                    @error("categoryName")
                    <small class="text-warning">{{$message}}</small>
                    @enderror
                    <div class="create-button">
                        <button type="submit" class="btn btn-lg mt-3 bg-primary mb-4 ">Create </button>
                    </div>

                   </form>
            </div>
        </div>
   </div>

@endsection
