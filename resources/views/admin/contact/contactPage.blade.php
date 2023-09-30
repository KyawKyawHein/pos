@extends("admin.layout.master")
@section("content")
    <div class="container-lg">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h3>User Feedbacks</h3>
            </div>
        </div>
        <div class="row mb-5">
            <div class="table-responsive mt-5">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>

                            <th class="col">Username</th>
                            <th class="col">Email</th>
                            <th class="col">Phone</th>

                            <th class="col">Message</th>
                            <th class="col">Date</th>


                        </tr>
                    </thead>
                    <tbody id="data">

                        @foreach ($data as $d)
                        <tr>


                            <td class="col">{{$d->name}}</td>

                            <td class="col">{{$d->email}}</td>
                            <td class="col">{{$d->phone}}</td>
                            <td class="col"><a href="{{route("admin#contactDetail",$d->id)}}" class="text-danger text-decoration-none">{{Str::limit($d->message,30)}}</a></td>
                            <td class="col">{{$d->created_at->format("j-F-Y")}} </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
