@extends('admin.layouts.admin',['title' => 'my tests list'])

@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Test</h1>
    <a href="{{route('admin.tests.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create New Test </a>
</div>
@endsection

@section('content')
    Welcome, {{auth()->user()->first_name ?? auth()->user()->email}}

    @if ($tests->count() > 0)
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Questions</th>
                        <th>Status</th>
                        <th>Publish Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $test)
                        <tr>
                            <td> {{$test->title}} </td>
                            <td> <a href="{{route('admin.test-items.index',['slug' => $test->slug])}}"> {{$test->items->count()}} </a> </td>
                            <td> {{$test->is_approved == 1 ? 'Approved' : 'Pending'}} </td>
                            <td> {{$test->getPublishDate()}} </td>
                            <td>  
                                <a href="{{route('test.show',['slug' => $test->slug])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview" target="_blank"> <i class="far fa-eye"></i> </a>
                                &nbsp;
                                <a href="{{route('admin.tests.edit',['test' => $test->slug])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"> <i class="far fa-edit"></i> </a>
                                &nbsp;
                                <a href="{{route('admin.test-items.create',['slug' => $test->slug])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add More Questions"><i class="fas fa-plus-circle"></i></a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
    @else
        No tests created yet.
    @endif
@endsection