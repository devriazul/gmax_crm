@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


    <link href="/dist/libs/selectize/dist/css/selectize.css" rel="stylesheet">
    <link href="/dist/libs/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin Manager </h3>
            <button type="button" data-toggle="modal" data-target="#modal-simple"
                style="float: right; right:0; margin-right:10px; position: absolute;"
                class="btn btn-warning btn-sm">Add New Admin</button>
        </div>
        
        <div class="table-responsive" style="margin-top: -7px;">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
                <table id="example" style="border-top:solid 2px #efefef;"
                    class="table card-table table-vcenter text-nowrap datatable dataTable no-footer" role="grid">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="Name : activate to sort column descending"
                            style="width: 10px;"> </th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name : activate to sort column descending"
                                style="width: 106px;">Name </th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Email : activate to sort column ascending" style="width: 208px;">Email </th>
                           
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Type : activate to sort column ascending" style="width: 57px;">Type </th>
                            
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Added: activate to sort column ascending" style="width: 113px;">Added</th>
                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                aria-label="Agent: activate to sort column ascending" style="width: 72px;"></th>
                           
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                        <tr role="row" class="odd">
                            <td>
                                <span class="avatar" data-toggle="tooltip" data-placement="bottom" title=""
                                    style="background-image: url({{$user->profile_photo_url}})"
                                    data-original-title="Ajith Jojo "></span>
                            </td>
                            <td class="sorting_1"><a href="#" class="text-reset"
                            tabindex="-1">{{ $user->name}}</a></td>
                            <td>
                               
                                {{ $user->email}}
                            </td>
                       
                            <td>
                                @if($user->usertype==1)
                                <span class="badge bg-cyan">Admin </span>
                                @else
                                <span class="badge bg-lime">Staff </span>
                                @endif
                               
                            </td>
                         
                           
                            <td>  {{ $user->created_at->diffForHumans() }}</td>
                           
                            <td class="text-right">
                                <span class="dropdown ml-1">
                                    <button class="btn btn-white btn-sm dropdown-toggle align-text-top"
                                        data-boundary="viewport" data-toggle="dropdown">Actions</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#updateuser{{$user->id}}">
                                            Edit User
                                        </a>
                                        <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                    href="/admin/deleteadmin/{{$user->id}}">
                                            Delete User
                                        </a>
                                    </div>
                                </span>

                              
                            
                            </td>
                        </tr>
                        <div class="modal modal-blur fade" id="updateuser{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Edit {{$user->name}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <form action="{{route('updateadmin')}}" method="post">
                                @csrf
                            <input type="hidden" value="{{$user->id}}" name="id">
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label class="form-label">Name</label>
                                    <input type="text" value="{{$user->name}}" class="form-control" name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input type="text" value="{{$user->email}}" class="form-control" name="email" placeholder="Enter Email">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Password</label>
                                        <input type="text"  class="form-control" name="password" placeholder="Enter password">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">User Type</label>
                                        <select class="form-control" name="usertype">
                                              <option value="1"> Admin </option>  
                                              <option value=""> Staff </option>  
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success" >Save changes</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                    
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">Showing <span> {{$users->count()}}</span> entries</p>
            <ul class="pagination m-0 ml-auto">
                {{$users->links()}}
            </ul>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create New Admin</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form action="{{route('createnewadmin')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-2">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter Email">
                </div>
                <div class="mb-2">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Enter password">
                </div>
                <div class="mb-2">
                    <label class="form-label">User Type</label>
                    <select class="form-control" name="usertype">
                          <option value="1"> Admin </option>  
                          <option value=""> Staff </option>  
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success" >Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>





    <script>
        function advancedsearch() {
            var x = document.getElementById("advancedsearch");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>


@endsection
