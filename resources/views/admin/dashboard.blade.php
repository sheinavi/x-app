@extends('admin.layouts.admin')

@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
@endsection

@section('content')
    Welcome, {{auth()->user()->first_name ?? auth()->user()->email}}
@endsection