@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Create New Blog Page
                            <span class="float-end">
                                <a href="{{route('pagesIndex')}}" class="btn btn-md btn-warning">Back</a>
                            </span>
                        </h5>
                      <form action="{{route('pagesStore')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('POST')

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Publish</label>
                                    <div class="form-selectgroup-boxes row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                        <input type="radio" name="active" value="1" class="form-selectgroup-input" checked>
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Publish</span>
                                            <span class="d-block text-muted">Make this publicly visible.</span>
                                            </span>
                                        </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-selectgroup-item">
                                        <input type="radio" name="active" value="0" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Draft</span>
                                            <span class="d-block text-muted">Only visible to to admins.</span>
                                            </span>
                                        </span>
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="tinymce-mytextarea" class="form-control" cols="15" rows="5"></textarea>
                                </div>
                            </div>
                            @if(Schema::hasTable('seos') && Module::isEnabled('Seo'))
                                @include('seo::form')
                            @endif
                            <div class="row">
                                <div class="col-md-12 mt-3 text-end">
                                    <button type="submit" class="btn btn-md btn-primary">Save</button>
                                </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{asset('template/dist/libs/tinymce/tinymce.min.js')}}" defer></script>
<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        let options = {
          selector: '#tinymce-mytextarea',
          height: 300,
          menubar: false,
          statusbar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
          ],
          toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat',
          content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        }
        if (localStorage.getItem("tablerTheme") === 'dark') {
          options.skin = 'oxide-dark';
          options.content_css = 'dark';
        }
        tinyMCE.init(options);
      })
      // @formatter:on
    </script>
@endsection

