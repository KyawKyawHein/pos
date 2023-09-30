@extends("user.layout.master")
@section("content")
<div class="col-6 mt-2  offset-3">
    @if (session("Match"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <small>{{session("Match")}}</small>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@elseif (session("notMatch"))

   <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <small>{{session("notMatch")}}</small>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
</div>
    <div class="row mt-5">

<form class="col-xl-6 col-md-7 col-sm-8 col-8 col-7 card offset-3 mt-3 " method="post" action="{{route("user#changePassword")}}">
    @csrf



            <h3 class="text-center py-4 text-primary">Change Password Page</h3>


        <div class="form-group ms-5 mb-4">
            <label for="oldPassword" class="mb-2">Old Password</label>
            <input type="password" class="form-control w-75 @error("oldPassword") is-invalid   @enderror" name="oldPassword" id="oldPassword" placeholder="Enter your old password" >
           @error("oldPassword")
           <small class="text-danger">{{$message}}</small>
           @enderror
        </div>
        <div class="form-group ms-5 mb-4">
            <label for="Phone" class="mb-2">New Password</label>
            <input type="password" class="form-control w-75 @error("newPassword") is-invalid   @enderror" name="newPassword" id="phone" placeholder="Enter your new password" >
            @error("newPassword")
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group ms-5 mb-4 ">
            <label for="Phone" class="mb-2">Confirm Password</label>
            <input type="password" class="form-control w-75 @error("confirmPassword") is-invalid   @enderror" name="confirmPassword" id="phone" placeholder="Confirm  your password" >
            @error("confirmPassword")
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>


        <div class="d-flex justify-content-center mb-5">
            <button class="btn btn-md btn-primary w-25 ">Update</button>
        </div>







</form>
</div>



@endsection
