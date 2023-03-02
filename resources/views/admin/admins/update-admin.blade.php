<!-- New User Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form id="edit-form" action="{{ route('admins.update', ':id') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row my-3">
                        <label for="e_name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="e_name" name="e_name" type="text"
                                class="form-control @error('e_name') is-invalid @enderror" value="{{ old('e_name') }}"
                                required autofocus>

                            @error('e_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="e_email" class="col-sm-3 col-form-label">Email Address <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="e_email" type="email"
                                class="form-control @error('e_email') is-invalid @enderror" name="e_email"
                                value="{{ old('e_email') }}" required autocomplete="email">

                            @error('e_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="e_pass" class="col-sm-3 col-form-label">Password
                            <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="password" id="e_pass"
                                class="form-control @error('e_pass') is-invalid @enderror" name="e_pass">

                            @error('e_pass')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="e_pass_confirmation" class="col-sm-3 col-form-label">Confirm
                            Password <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="e_pass_confirmation"
                                name="e_pass_confirmation">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn danger-btn-outline btn-sm"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="main-btn primary-btn btn-hover btn-sm" id="updateAdmin">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card-header -->
