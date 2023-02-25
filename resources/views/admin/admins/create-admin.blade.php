<!-- New User Modal -->
<div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Admin</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admins.store') }}" method="POST">
                    @csrf
                    <div class="form-group row my-3">
                        <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span>
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

                    <div class="form-group row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email Address <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password
                            <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm
                            Password <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="main-btn danger-btn-outline btn-sm"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="main-btn primary-btn btn-hover btn-sm" id="submitAdmin">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card-header -->
