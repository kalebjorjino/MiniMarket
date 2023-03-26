<!-- New User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Expense</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form id="edit-form" action="{{ route('expenses.update', ':id') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row my-3">
                        <label for="e_expense_date" class="col-sm-3 col-form-label">Expense Date <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="e_expense_date" name="e_expense_date">
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="e_product_id" class="col-sm-3 col-form-label">Product Title <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select id="e_product_id" name="e_product_id" class="form-control" style="width: 100%;" disabled required>
                                <option value="" selected></option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="e_category" class="col-sm-3 col-form-label">Product Category <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name="e_category" id="e_category"
                                class="form-control"
                                aria-label="Product Category select" disabled required>
                                <option value="" disabled selected>
                                </option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->category->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="e_quantity" class="col-sm-3 col-form-label">Quantity <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="e_quantity" name="e_quantity" type="number"
                                class="form-control @error('e_quantity') is-invalid @enderror"
                                value="{{ old('e_quantity') }}" placeholder="Enter quantity" required>
                            @error('e_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="e_total_price" class="col-sm-3 col-form-label">Total Price <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="e_total_price" name="e_total_price" type="number"
                                class="form-control @error('e_total_price') is-invalid @enderror"
                                value="{{ old('e_total_price') }}" placeholder="Enter total price" required>
                            @error('e_total_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row my-3">
                        <label for="e_supplier" class="col-sm-3 col-form-label">Supplier <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="e_supplier" name="e_supplier" type="text"
                                class="form-control @error('e_supplier') is-invalid @enderror"
                                value="{{ old('e_supplier') }}" placeholder="Enter supplier" required>

                            @error('e_supplier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
