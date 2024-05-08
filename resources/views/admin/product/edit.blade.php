@extends('admin.admin_layouts')
@section('products') active show-sub @endsection
@section('product-sub') active @endsection
@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/admin/home') }}">Home</a>
        <span class="breadcrumb-item active">Product Edit Page</span>
    </nav>

    <div class="sl-pagebody">
        @foreach ( $product_edit as $product)

        <form action="{{ route('update.product',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="card pd-20 pd-sm-40">
                    <div class="d-flex justify-content-between align-items-center">
                        Update Product
                        <a href="{{ route('product.list') }}" class="btn btn-success btn-sm mb-2"> Product List</a>
                    </div>
                    <p class="border"></p>
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_name" value="{{ $product->product_name }}">
                                    @error('product_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_code" value="{{ $product->product_code }}">
                                    @error('product_code')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-3">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label"> Brand Name: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="brand_name" data-placeholder="Select Brand Name">
                                        <option label="Select Brand Name"></option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_name == $brand->id ? "selected":"" }}> {{ $brand->brand_name }}</option>

                                        @endforeach
                                    </select>
                                    @error('brand_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label"> Category Name: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="category_name" data-placeholder="Select Brand Name">
                                        <option label="Select Category Name"></option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{  $category->id == $product->category_name ?"selected":"" }}> {{ $category->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @foreach ($product_varient as $varient)
                                <div class="row border ml-0 mr-0 pb-3 form-row">
                                    <div class="col-sm-2">
                                        <label for="condition">Condition</label>
                                        <input type="text" class="form-control" value="{{$varient->condition}}" name="condition[]">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="color">Colors</label>
                                        <select name="color[]" class="form-control">
                                            <option value="" selected hidden>Select color</option>
                                            @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="storage">Storage</label>
                                        <input type="text" class="form-control" name="storage[]">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="price">Price</label>
                                        <input type="number" min="1" class="form-control" name="price[]">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="qty">Quantity</label>
                                        <input type="number" min="1" class="form-control" name="qty[]">
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-end">
                                        <div>
                                            <label class="d-sm-block"> </label>
                                            <label for="image " class="d-sm-none">Image</label>
                                            <input type="file" class="form-control" name="image[]">
                                        </div>
                                        <div class="ml-2">
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                    
                                @endforeach
                                <div id="form-container"></div>
                                <div class="col-12 text-right mt-1">
                                    <button type="button" id="add-row" class="btn btn-primary btn-sm">Add
                                        Row</button>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label"> Short Description: <span class="tx-danger">*</span></label>
                                    <textarea id="summernote2" name="sort_description" style="width: 100%; min-height:80px">{{ $product->sort_description }}</textarea>
                                    @error('sort_description')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label"> Long Description: <span class="tx-danger">*</span></label>
                                    <textarea id="summernote" name="long_description" style="width: 100%; min-height:80px"> {{ $product->long_description }} </textarea>
                                    @error('long_description')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="">
                            <button class="btn btn-info mg-r-5">Product Update Data</button>
                        </div>
        </form>
    </div>
    <p class="border mt-1"></p>
</div>
</div>

@endforeach
</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
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

<script>
    $(document).ready(function() {
        // Add row
        $('#add-row').click(function() {
            var newRow = `<div class="row border  ml-0 mr-0 pb-3 form-row">
                                <div class="col-sm-2">
                                    <label class="d-sm-block"> </label>
                                    <label for="condition " class="d-sm-none ">Condition</label>
                                    <input type="text" class="form-control" name="condition[]">
                                </div>
                                <div class="col-sm-2">
                                    <label class="d-sm-block"> </label>
                                    <label for="color " class="d-sm-none">Color</label>
                                    <select name="color[]" class="form-control">
                                        <option value="" selected hidden>Select color</option>
                                        @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                          @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="d-sm-block"> </label>
                                    <label for="storage " class="d-sm-none">Storage</label>
                                    <input type="text" class="form-control" name="storage[]">
                                </div>

                                <div class="col-sm-2">
                                        <label class="d-sm-block"> </label>
                                            <label for="price"  class="d-sm-none">Price</label>
                                            <input type="number" min="1" class="form-control" name="price[]">
                                 </div>

                                 <div class="col-sm-2">
                                    <label class="d-sm-block"> </label>
                                            <label for="qty" class="d-sm-none">Quantity</label>
                                            <input type="number" min="1" class="form-control" name="qty[]">
                                        </div>
                                <div class="col-sm-2 d-flex align-items-end">
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

@endsection