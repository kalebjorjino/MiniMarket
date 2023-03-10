<!-- New User Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Brand</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row my-3">
                        <label for="name" class="col-sm-3 col-form-label">Brand Name <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="description" class="col-sm-3 col-form-label">Brand
                            Description</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="brand_image" class="col-sm-3 col-form-label">Brand Image <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="brand_image" name="brand_image"
                                accept=".png, .jpg, .jpeg">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn danger-btn-outline btn-sm"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="main-btn primary-btn btn-hover btn-sm" id="submit">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card-header -->
