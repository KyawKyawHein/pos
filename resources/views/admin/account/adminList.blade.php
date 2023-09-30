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
       @foreach ($admin as $a)
       <tbody id="tbody">

        <tr class="">
            <input type="hidden" name="" id="adminId" value="{{$a->id}}">
            <td class="col-1">@if ($a->image == null)
                <img src="{{asset("image/default.png")}}" class="w-75 img-thumbnail shadow-sm" alt="">
            @else
                <img src="{{asset("storage/".$a->image)}}" class="w-75 img-thumbnail shadow-sm" alt="">
            @endif</td>
            <td class="col-1">{{$a->name}}</td>
            <td class="col-1">{{$a->email}}</td>
            <td class="col-1">{{$a->phone}}</td>
            <td class="col-1">{{$a->address}}</td>
            <td class="col-1">
                <select name="" class="form-control adminList" id="" @if ($a->id == Auth::user()->id) disabled  @endif>

                    <option value="admin"@if ($a->role == "admin") selected  @endif>Admin</option>
                    <option value="user">User</option>

                </select>
            </td>
            <td class="col-1">
                <div class="d-flex justify-content-center align-item-center">

                   @if ($a->id == Auth::user()->id)
                   <span class="fs-4 "><i class="fa-solid fa-circle-exclamation text-dark"></i></span>
                   @else
                   <span class="fs-4"><a href="{{route("admin#delete",$a->id)}}"><i class="fa-solid fa-trash text-dark"></i></a></span>
                   @endif
                </div>
            </td>
        </tr>

    </tbody>
       @endforeach
    </table>

</div>



<div class="mt-3 d-flex justify-content-center align-item-center">
    {{$admin->links()}}
</div>

@endsection
@section("javaScript")
<script>
 $(document).ready(function(){
   $(".adminList").change(function(){
    $currentStatus = $(this).val();
    $parentNode = $(this).parents("tr");
    $adminId = $parentNode.find("#adminId").val();
    $data = {
        "role" : $currentStatus,
        "id" : $adminId
    }
    $.ajax({
        type : "get",
        url : "/admin/list/change",
        data : $data,
        dataType : "json"
    })

    location.reload();

   })
 });
</script>
@endsection
