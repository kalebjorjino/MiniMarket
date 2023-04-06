<!-- New User Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Customer</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="form-group row my-3">
                        <label for="first_name" class="col-sm-3 col-form-label">First Name <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="first_name" name="first_name" type="text"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}" required autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="last_name" class="col-sm-3 col-form-label">Last Name <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="last_name" name="last_name" type="text"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}" required>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="phone_number" class="col-sm-3 col-form-label">Phone Number<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="phone_number" type="text" name="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                value="{{ old('phone_number') }}">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="address" class="col-sm-3 col-form-label">Address <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="address" type="text"
                                class="form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address') }}" required>

                            @error('address')
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
                <button type="submit" class="main-btn primary-btn btn-hover btn-sm" id="submit">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card-header -->
