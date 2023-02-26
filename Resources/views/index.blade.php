@extends('layouts.app')

@section('breadcrumbs')
    <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
        Module
        </div>
        <h2 class="page-title">
        Pages
        </h2>
    </div>
@endsection

@section('pagelinks')
@endsection

@section('content')

<div class="container">
    <div class="row">
            <div class="col-md-12">
                <p>
                    <a class="btn btn-sm btn-info" href="{{route('pagesIndex')}}">Pages</a>
                    <span class="float-end">
                        <a class="btn btn-sm btn-success" href="{{route('pagesCreate')}}">Add New</a>
                    </span>
                </p>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pages</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Published</th>
                                    <th width="120" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                    <tr>
                                    <td width="50" class="text-center">{{$page->id}}</td>
                                    <td width="90" class="text-center">
                                        @if($page->photo)
                                        <img src="{{url('images')}}/{{$page->photo}}" alt="{{$page->name}}" width="80" height="80" class="rounded">
                                        @else
                                        <span>Not Found!</span>
                                        @endif
                                    </td>
                                    <td>{{$page->name}}</td>
                                    <td width="80">
                                        @if($page->active)
                                        <span class="badge bg-success">Yes</span>
                                        @else
                                        <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td width="120">
                                        <a href="{{route('pagesEdit', $page->id)}}" class="btn btn-sm btn-info">Edit</a>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
