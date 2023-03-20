<!-- New User Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Category</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row my-3">
                        <label for="name" class="col-sm-3 col-form-label">Category Name <span
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
                        <label for="category_icon" class="col-sm-3 col-form-label">Category Icon <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="category_icon" name="category_icon"
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
