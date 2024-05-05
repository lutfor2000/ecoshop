<table class = "table table-bordered text-center mb-4" id="table_delete">
    <thead>
        <tr>
            <th>Serial No</th>
            <th> Name</th>
            <th>Email</th>
            <th>Admin/Coustomer</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @if ($user->role == 1)
                    Admin
                @else
                    Coustomer
                @endif
            </td>
            <td>
            <img src="{{asset("uploads/user_photo/".$user->user_photo)}}" class="w-20 h-20"  alt="not found">
            </td>
            <td>
            <div class="btn-group text-center ">
                @php
                   $id =Crypt::encrypt($user->id);
                @endphp
                <a type="submit" class="btn btn-sm btn-outline-warning " 
                href = "{{route('profile',$id)}}"><i class="fa-regular fa-pen-to-square"></i></a>
                
                <a type="submit" class="btn btn-sm btn-outline-info user_delete_btn"
                data-id="{{$user->id}}"
                href = ""><i class="fa-regular fa-trash-can"></i></a>
            </div>
            </td>
        </tr> 
        @empty
        <tr class="text-center">
            <td colspan="20" class="text-danger"> <small>No Data To Show</small></td>
        </tr>
        @endforelse
    </tbody>
</table>
{{$users->links('pagination::bootstrap-5')}}