@extends('layouts.app')

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Products</li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="mx-auto my-4 col-md-6 shadow rounded">
        <div class="p-2 text-dark">
          <form action="{{ route('edit-category', $productCategory) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control @error('name')
              border border-danger @enderror" value="{{ $productCategory->name }}" id="name">
              @error('name')
                  <div class="text-danger mt-2 fs-6">
                      {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" cols="30" class="form-control">{{ $productCategory->description }}</textarea>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="mb-3 btn btn-primary">Update</button>
          </form>
        </div>
      </div>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection