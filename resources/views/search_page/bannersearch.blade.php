<table class = "table table-bordered text-center mb-4">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($banners as $banner)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$banner->banner_title}}</td>
            <td>{{$banner->banner_desc}}</td>
            <td>
               <img src="{{asset("uploads/banner_photo/".$banner->banner_photo)}}" class="w-20 h-20"  alt="not found">
            </td>
            <td>
            <div class="btn-group text-center ">
                <a type="submit" class="btn btn-sm btn-warning banner_edit_btn"
                data-bs-toggle="modal" data-bs-target="#bannerUpdateModal"
                data-id="{{$banner->id}}" 
                data-banner_title="{{$banner->banner_title}}" 
                data-banner_desc="{{$banner->banner_desc}}" 
                data-banner_photo="{{$banner->banner_photo}}" 
                href = ""><i class="fa-regular fa-pen-to-square"></i></a>
                
                <a type="submit" class="btn btn-sm btn-info banner_delete_btn"
                data-id="{{$banner->id}}"
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
{{$banners->links('pagination::bootstrap-5')}}