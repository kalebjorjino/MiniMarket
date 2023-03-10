<!-- New User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Brand</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form id="edit-form" action="{{ route('brands.update', ':id') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="form-group row mb-3">
                        <label for="e_id" class="col-sm-3 col-form-label">Brand ID <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input id="e_id" name="e_id" type="text" class="form-control"
                                value="{{ old('e_id') }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="e_name" class="col-sm-3 col-form-label">Brand Name <span
                                class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input id="e_name" name="e_name" type="text"
                                class="form-control @error('e_name') is-invalid @enderror" value="{{ old('e_name') }}"
                                autofocus>

                            @error('e_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="e_description" class="col-sm-3 col-form-label">Brand
                            Description</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="e_description" name="e_description">{{ old('e_description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="e_brand_image" class="col-sm-3 col-form-label">Brand Image <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="e_brand_image" name="e_brand_image"
                                accept=".png, .jpg, .jpeg">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn danger-btn-outline btn-sm"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="main-btn primary-btn btn-hover btn-sm" id="update">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card-header -->
