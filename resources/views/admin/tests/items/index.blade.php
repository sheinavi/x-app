@extends('admin.layouts.admin')

@push('styles')
    <style>
        img.thumbnail{
            max-width:100px;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-9"><h4>Questions list for <span class="text-primary"> {{$items->first()->test->title}} </span> </h4></div>
    <div class="col-md-3 d-flex justify-content-end">
        <a href="{{route('admin.test-items.create',['slug' => $items->first()->test->slug])}}" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New </a>
    </div>
</div>


<table class="table mt-5">
    <thead>
        <tr>
            <th>Question</th>
            <th>Featured Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td> {{$item->question}} </td>
                <td> <img src="{{asset($item->featured_image)}}" alt="" class="thumbnail"> </td>
                <td> 
                    <a href="{{route('admin.test-items.edit',['test_item' => $item])}}" class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"> <i class="far fa-edit"></i> </a> 
                    &nbsp;<button type="button" class="btn btn-link text-secondary delete-item" data-val="{{$item->id}}" data-title="{{$item->question}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<!-- confirm delete modal -->
<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      
        <form action="" id="deleteForm" class="modal-content" method="POST">
            
        
            @csrf
            @method('DELETE')

            <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span id="delete_title"></span>?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>

    </div>
  </div>
<!-- end confirm delete modal -->

@endsection

@push('scripts')
    <script>
        $(function(){
            var delete_modal = $('#confirmDeleteModal');

            $('button.delete-item').on('click',function(){
                let item_id = $(this).data('val');
                let title = $(this).data('title');
                let url = "/admin/test-items/"+item_id;
                
                $('span#delete_title').text(title);
                $('form#deleteForm').attr('action',url);
                delete_modal.modal('show');
            });
        });
    </script>
@endpush