@extends('admin.admin_layouts')
@section('products')
    active show-sub
@endsection
@section('product-sub')
    active
@endsection
<style>
    .d-sm-none_custom{
        display: none;
        visibility: hidden;
    }
</style>
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->


    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/admin/home') }}">Home</a>
            <span class="breadcrumb-item active">Product Page</span>
        </nav>
        <div class="sl-pagebody">
            <form action="{{ route('add.product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="card pd-20 pd-sm-40">
                        <div class="d-flex justify-content-between align-items-center">
                            Add New Product
                            <a href="{{ route('product.list') }}" class="btn btn-success btn-sm mb-2"> Product List</a>
                        </div>
                        <p class="border"></p>
                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Name: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_name"
                                            value="{{ old('product_name') }}" placeholder="Enter product name">
                                        @error('product_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Code: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_code"
                                            value="{{ old('product_code') }}" placeholder="Enter code">
                                        @error('product_code')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Price: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="product_price"
                                            value="{{ old('product_price') }}" placeholder="Enter Price">
                                        @error('product_price')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Product Quantity: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="product_quantity"
                                            value="{{ old('product_quantity') }}" placeholder="Enter quantity">
                                        @error('product_quantity')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label"> Brand Name: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="brand_name"
                                            data-placeholder="Select Brand Name">
                                            <option label="Select Brand Name"></option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                            @endforeach
                                        </select>
                                        @error('brand_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label"> Category Name: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="category_name"
                                            data-placeholder="Select Brand Name">
                                            <option label="Select Category Name"></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 ">
                                    <div class="row border ml-0 mr-0 pb-3 form-row">
                                        <div class="col-sm-3">
                                            <label for="condition">Condition</label>
                                            <input type="text" class="form-control" name="condition[]">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="color">Color</label>
                                            <select name="color[]" class="form-control">
                                                <option value="" selected hidden>Select color</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="storage">Storage</label>
                                            <input type="text" class="form-control" name="storage[]">
                                        </div>
                                        <div class="col-sm-3">
                                                <label for="image">Image</label>
                                                <input type="file" class="form-control" name="image[]">
                                        </div>
                                    </div>
                                    <div id="form-container"></div>
                                    <div class="col-12 text-right mt-1">
                                        <button type="button" id="add-row" class="btn btn-primary btn-sm">Add More</button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label"> Short Description: <span
                                                class="tx-danger">*</span></label>
                                        <br>

                                        <textarea id="summernote" name="sort_description" style="width: 100%; "></textarea>
                                        @error('sort_description')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label"> Long Description: <span
                                                class="tx-danger">*</span></label>
                                        <br>
                                        <textarea id="summernote2" name="long_description" style="width: 100%;"></textarea>
                                        @error('long_description')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Product Image 1: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_img_one"
                                                    id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                                                @error('product_img_one')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-1-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Product Image 2: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_img_two"
                                                    id="file-ip-2" accept="image/*" onchange="showPreview2(event);">
                                                @error('product_img_two')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-2-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Product Image 3: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_img_three"
                                                    id="file-ip-3" accept="image/*" onchange="showPreview3(event);">
                                                @error('product_img_three')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-3-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Product Image 4: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_img_four"
                                                    id="file-ip-3" accept="image/*" onchange="showPreview4(event);">
                                                @error('product_img_four')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-4-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Product Image 5: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_img_five"
                                                    id="file-ip-3" accept="image/*" onchange="showPreview5(event);">
                                                @error('product_img_five')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-5-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Product Image 6: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="product_img_six"
                                                    id="file-ip-3" accept="image/*" onchange="showPreview6(event);">
                                                @error('product_img_six')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="preview">
                                                <img class="w-75" id="file-ip-6-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-layout-footer">
                                <button class="btn btn-info mg-r-5">Product Added</button>
                            </div><!-- form-layout-footer -->
                        </div><!-- form-layout -->
                    </div><!-- card -->
                </div>
            </form>
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <script>
        $(document).ready(function() {
            // Add row
            $('#add-row').click(function() {
                var newRow = `<div class="row border  ml-0 mr-0 pb-3 form-row">
                                <div class="col-sm-3">
                                    <label class="d-sm-block"> </label>
                                    <label for="condition " class="d-sm-none ">Condition</label>
                                    <input type="text" class="form-control" name="condition[]">
                                </div>
                                <div class="col-sm-3">
                                    <label class="d-sm-block"> </label>
                                    <label for="color " class="d-sm-none">Color</label>
                                    <select name="color[]" class="form-control">
                                        <option value="" selected hidden>Select color</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="d-sm-block"> </label>
                                    <label for="storage " class="d-sm-none">Storage</label>
                                    <input type="text" class="form-control" name="storage[]">
                                </div>
                                <div class="col-sm-3 d-flex align-items-end">
                                    <div>
                                        <label class="d-sm-block"> </label>
                                        <label for="image " class="d-sm-none">Image</label>
                                        <input type="file" class="form-control" name="image[]">
                                    </div>
                                    <div class="ml-2">
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </div>
                                </div>
                            </div>`;
                $('#form-container').append(newRow);
            });
        
            // Remove row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.form-row').remove();
            });
        });
        </script>

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

        function showPreview4(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-4-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview5(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-5-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview6(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-6-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
