@extends('admin.admin_layouts')
@section('slider') active show-sub @endsection
@section('slider-sub') active @endsection
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/admin/home') }}">Home</a>
            <span class="breadcrumb-item active">Slider Page</span>
        </nav>
        <div class="sl-pagebody">
            
            <form action="{{ route('add.slider') }}" method="post" enctype="multipart/form-data">
                @csrf
        
                    <div class="card pd-20 pd-sm-40">
                        <div class="d-flex justify-content-between align-items-center">
                            Add New Slider
                            <a href="{{ route('slider.list') }}" class="btn btn-success btn-sm mb-2"> Slider List</a>
                        </div>
                        <p class="border"></p>
                        <div class="form-layout">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Slider Title: </label>
                                        <input class="form-control" type="text" name="slider_title"
                                            value="{{ old('slider_title') }}" placeholder="Slider title">
                                        @error('slider_title')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                    </div>
                                </div><!-- col-4 -->
                            
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Slider Image: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="slider_image"
                                                    id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                                                @error('slider_image')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-1-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="form-layout-footer">
                                <button class="btn btn-info mg-r-5">Slider Upload</button>
                            </div>
                       
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview2(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-2-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview3(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-3-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
