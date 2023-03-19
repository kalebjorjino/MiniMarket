@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Edit Product') }}</h2>
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
                                Edit Product
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
            <form action="{{ route('products.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="card-style-3 mb-30">
                            <div class="card-content">

                                <div class="card-body ">
                                    <div class="row justify-content-around">

                                        <div class="form-group col-md-6 mb-2">
                                            <label for="title" class="col-form-label">Product Title <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input id="title" name="title" type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title', $record->title) }}" placeholder="Enter Product Title"
                                                required autofocus>
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

                                            <select name="category" id="category"
                                                class="form-control @error('category') is-invalid @enderror"
                                                aria-label="Product Category select" required>

                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}" @selected(old('category', $record->category_id) == $cat->id)>
                                                        {{ $cat->name }}</option>
                                                @endforeach
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

                                            <select name="brand" id="brand"
                                                class="form-control @error('brand') is-invalid @enderror"
                                                aria-label="Product brand select">

                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" @selected(old('brand', $record->brand_id) == $brand->id)>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
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
                                                value="{{ old('price', $record->price) }}"
                                                placeholder="Enter Product Price" required>
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
                                                value="{{ old('stocks', $record->stocks) }}"
                                                placeholder="Enter no of stocks" required>
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
                                                value="{{ old('stock_alert', $record->stock_alert) }}" required>
                                            @error('stock_alert')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label for="description" class="col-form-label">Product Description</label>
                                            <textarea type="text" rows="3" class="form-control" id="description" name="description"
                                                placeholder="Enter Product Description">{{ old('description', $record->description) }}</textarea>
                                        </div>
                                        <div class="form-check col-md-12 my-2 ms-4">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="featured" name="featured" @checked(old('featured', $record->featured))>
                                            <label class="form-check-label" for="featured">
                                                Featured
                                            </label>
                                            <label class="form-check-label" style="display:block;" for="featured">
                                                Specify if the product is featured
                                            </label>
                                        </div>
                                        <div class="form-check col-md-12  mb-2  ms-4">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="status" name="status" @checked(old('status', $record->status))>
                                            <label class="form-check-label" for="status">
                                                Status
                                            </label>
                                            <label class="form-check-label" style="display:block;" for="status">
                                                Specify the status of the product (active/inactive)
                                            </label>
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
                                            name="product_cover" accept=".png, .jpg, .jpeg"
                                            onchange="previewImage(event)">
                                    </div>


                                    <div id="preview-container" class="mt-2"
                                        style="display:none; max-width: 200px; max-height: 200px; overflow:hidden;">
                                        <img id="preview" src="#" alt="Preview Image" style="display:none;"
                                            class="img-thumbnail">
                                    </div>

                                    @if ($record->product_cover)
                                        <div class="mt-3" style="width: 200px; max-height: 200px; overflow:hidden;">
                                            <img src="{{ url('storage/' . $record->product_cover) }}" alt="Product Cover"
                                                id="cover" class="img-thumbnail img-fluid">
                                        </div>
                                    @endif
                                </div>

                                <label for="document">Upload Product Previews</label>
                                <span class="text-sm text-danger">Note: <i>Uploading will overwrite current preview
                                        image/s</i></span>
                                <div class="form-group row mb-3 px-2">
                                    <div class="needsclick dropzone" id="document-dropzone">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    @unless(count($mediaItems) == 0)
                                        <p>Product Preview Images</p>
                                        @foreach ($mediaItems as $media)
                                            <div class="col mt-2"
                                                style="width: 125px; max-width: 125px; max-height: 125px; overflow:hidden;">
                                                <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                                    class="img-thumbnail">
                                                {{-- {{ $media->getUrl() }} --}}
                                                {{-- <a href="#" class="btn btn-danger"
                                                onclick="deleteMedia({{ $media->id }})">Delete</a> --}}
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No previews found</p>
                                    @endunless
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="mt-2 col-md-12">
                        <button type="submit" class="main-btn primary-btn btn-hover btn-sm"
                            id="submit">Submit</button>
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
            var pContainer = document.getElementById("preview-container");
            var cover = document.getElementById("cover");

            preview.style.display = "block";
            pContainer.style.display = "block";
            cover.style.display = "none";

            var reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>

    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('products.storeMedia') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($product) && $product->document)
                    var files = {!! json_encode($product->document) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }
    </script>
@endsection
