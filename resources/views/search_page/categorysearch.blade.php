<table class = "table table-bordered text-center mb-4">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{ucwords(strtolower($category->category_name))}}</td>
            <td>
               <img src="{{asset("uploads/category_photo/".$category->category_photo)}}" class="w-20 h-20"  alt="not found">
            </td>
            <td>
            <div class="btn-group text-center ">
                <a type="submit" class="btn btn-sm btn-warning category_edit_btn"
                data-bs-toggle="modal" data-bs-target="#ctegoryUpadeModal"
                data-id="{{$category->id}}" 
                data-category_name="{{$category->category_name}}" 
                data-category_photo="{{$category->category_photo}}" 
                href = ""><i class="fa-regular fa-pen-to-square"></i></a>
                
                <a type="submit" class="btn btn-sm btn-info banner_delete_btn"
                {{-- data-id="{{$banner->id}}" --}}
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
{{$categories->links('pagination::bootstrap-5')}}