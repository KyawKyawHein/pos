@extends("admin.layout.master")
@section("Title")

@endsection
@section("content")

<div class="row">
    <div class="col-4 mt-4 ms-4 ">
       <h4> Search ::</h4>
    </div>
    <div class="col-2 offset-5 mt-4">
       <form action="{{route("admin#list")}}" method="GET">
        @csrf
        <div class="d-flex"><input type="text" name="key" class="form-control" placeholder="Search here" value="{{request("key")}}">
            <a href="">
                <button class="btn bg-primary ms-2" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </a>
        </div>

       </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table mt-5 offset-1 w-75 text-center">
        <thead>
            <tr class="">

                <th class="col-1">Image</th>
                <th class="col-1">Name</th>
                <th class="col-1">Email</th>
                <th class="col-1">Phone</th>
                <th class="col-1">Address</th>
                <th class="col-1">Role</th>


                <th class="col-1">More Option</th>
            </tr>
        </thead>
       @foreach ($user as $u)
       <tbody id="tbody">

        <tr class="">
            <input type="hidden" name="" id="userId" value="{{$u->id}}">
            <td class="col-1">@if ($u->image == null)
                <img src="{{asset("image/default.png")}}" class="w-75 img-thumbnail shadow-sm" alt="">
            @else
                <img src="{{asset("storage/".$u->image)}}" class="w-75 img-thumbnail shadow-sm" alt="">
            @endif</td>
            <td class="col-1">{{$u->name}}</td>
            <td class="col-1">{{$u->email}}</td>
            <td class="col-1">{{$u->phone}}</td>
            <td class="col-1">{{$u->address}}</td>
            <td class="col-1">
                <select name="" class="form-control userList" id="" @if ($u->id == Auth::user()->id) disabled  @endif>

                    <option value="user"@if ($u->role == "user") selected  @endif>User</option>
                    <option value="admin">Admin</option>

                </select>
            </td>
            <td class="col-1">
                <div class="d-flex justify-content-center align-item-center">

                   @if ($u->id == Auth::user()->id)
                   <span class="fs-4 "><i class="fa-solid fa-circle-exclamation text-dark"></i></span>
                   @else
                   <span class="fs-4"><a href="{{route("admin#delete",$u->id)}}"><i class="fa-solid fa-trash text-dark"></i></a></span>
                   @endif
                </div>
            </td>
        </tr>

    </tbody>
       @endforeach
    </table>

</div>



<div class="mt-3 d-flex justify-content-center align-item-center">
    {{$user->links()}}
</div>

@endsection
@section("javaScript")
<script>
 $(document).ready(function(){
   $(".userList").change(function(){
    $currentStatus = $(this).val();
    $parentNode = $(this).parents("tr");
    $userId = $parentNode.find("#userId").val();
    $data = {
        "role" : $currentStatus,
        "id" : $userId
    }
    $.ajax({
        type : "get",
        url : "/admin/user/role/change",
        data : $data,
        dataType : "json",
        success:function(response){
            location.reload();
        }
    });



   })
 });
</script>
@endsection
