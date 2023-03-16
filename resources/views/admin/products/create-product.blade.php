@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Create Product') }}</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('adminDashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.index') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Product
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
    <div id="app">
        <div class="card-styles">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-style-3 mb-30">
                        <div class="card-content">
                            <form action="/admin/booking/insert" method="GET">
                                @csrf
                                <div class="card-body ">
                                    <div class="row justify-content-around">

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="title" class="col-form-label">Product Title <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="title" name="title" type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title') }}" placeholder="Enter Product Title" required
                                                autofocus>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="category" class="col-form-label">Category <span
                                                    class="text-danger">*</span>
                                            </label>

                                            <select onchange="toggleRadio(this.value)" name="category" id="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                aria-label="Product Category select" required>
                                                <option value="" selected disabled>Choose category
                                                </option>
                                                <option value="1">Cat-1</option>
                                                <option value="2">Cat-2</option>
                                            </select>

                                            @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="brand" class="col-form-label">Brand <span
                                                    class="text-danger">*</span>
                                            </label>

                                            <select onchange="toggleRadio(this.value)" name="brand" id="brand"
                                                class="form-control @error('brand') is-invalid @enderror"
                                                aria-label="Product brand select" required>
                                                <option value="" selected disabled>Choose brand
                                                </option>
                                                <option value="1">Brand-1</option>
                                                <option value="2">Brand-2</option>
                                            </select>

                                            @error('brand')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="price" class="col-form-label">Price <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="price" name="price" type="number"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}" placeholder="Enter Product Price" required>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="stocks" class="col-form-label">Stocks <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="stocks" name="stocks" type="number"
                                                class="form-control @error('stocks') is-invalid @enderror"
                                                value="{{ old('stocks') }}" placeholder="Enter no of stocks" required>
                                            @error('stocks')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="stock_alert" class="col-form-label">Stock Alert<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="stock_alert" name="stock_alert" type="number"
                                                class="form-control @error('stock_alert') is-invalid @enderror"
                                                value="{{ old('stock_alert') ? old('stock_alert') : 0 }}" required>
                                            @error('stock_alert')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="description" class="col-form-label">Product Description</label>
                                            <textarea type="text" class="form-control" id="description" name="description"
                                                placeholder="Enter Product Description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-style-3 mb-30">
                        <div class="card-body ">

                            <div class="form-group row mb-4">
                                <label for="product_cover" class="col-form-label">Product Cover Image <span
                                        class="text-danger">*</span>
                                </label>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-sm" type="file" id="product_cover"
                                        name="product_cover" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                                </div>
                                <img id="preview" src="#" alt="Preview Image" style="display:none; width:150px"
                                    class="img-thumbnail img-fluid mx-3 mt-2">
                            </div>

                            <div class="form-group row">
                                <p>Product Preview Images</p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="mt-2 col-md-12">
                    <button type="submit" class="main-btn primary-btn btn-hover btn-sm" id="submit">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById("preview");

            preview.style.display = "block";

            var reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
