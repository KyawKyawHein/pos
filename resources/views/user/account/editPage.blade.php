@extends("user.layout.master")
@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Edit Your Account</h4>
                </div>
                <div class="card-body">
                    <form class="row" method="post" action="{{route("user#accountUpdate",Auth::user()->id)}}" enctype="multipart/form-data">
                        @csrf


                        <div class="col-lg-5 col-md-9 offset-1 col-sm-9 col-10">
                            @if (Auth::user()->image == null)
                             <img src="{{asset("image/default.png")}}" alt="" class="account-img img-thumbnail w-75 ">

                             @else
                            <img src="{{asset("storage/".Auth::user()->image)}}" alt="" class="account-img img-thumbnail w-75 ">

                             @endif
                            <input type="file" name="userImage" class="form-control mt-3" id="">

                        </div>


                        <div class="col-lg-5 offset-1 col-md-9 col-sm-9 col-10">
                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                            <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" class="form-control" name="userName" value="{{Auth::user()->name}}" id="username" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="userEmail" id="email" placeholder="Enter your email" value="{{Auth::user()->email}}">
                            </div>
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="number" class="form-control" name="userPhone" id="phone" placeholder="Enter your Phone" value="{{Auth::user()->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="userAddress" id="address" placeholder="Enter your Address" value="{{Auth::user()->address}}">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="userGender" class="form-control" id="gender">

                                    <option value="" @if (Auth::user()->gender == null ) selected  @endif >I rather not say </option>
                                    <option value="male" @if (Auth::user()->gender == "male") selected  @endif>Male</option>
                                    <option value="female" @if (Auth::user()->gender == "female") selected  @endif >Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" placeholder="" disabled value="{{Auth::user()->role}}">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
