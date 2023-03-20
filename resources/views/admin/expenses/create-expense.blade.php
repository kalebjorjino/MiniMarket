<!-- New User Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Expense</h5>
                <button type="button" class="trans-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lni lni-close"></i></span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf

                    <div class="form-group row my-3">
                        <label class="col-sm-3 col-form-label">Expense Date <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="expense_date">
                        </div>
                    </div>

                    {{-- gawing select  --}}
                    <div class="form-group row my-3">
                        <label for="product_title" class="col-sm-3 col-form-label">Product Title <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select id="product_title" class="form-control" style="width: 100%;">
                                <option value="" selected disabled></option>
                                {{-- @foreach ($products as $product)
                                    <option value="{{ $item->product->id }}">{{ $item->product->title }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="category" class="col-sm-3 col-form-label">Product Category <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name="category" id="category"
                                class="form-control @error('category') is-invalid @enderror"
                                aria-label="Product Category select" disabled required>
                                <option value="" disabled selected>
                                </option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="quantity" class="col-sm-3 col-form-label">Quantity <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="quantity" name="quantity" type="number"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity') }}" placeholder="Enter quantity" required>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-3">
                        <label for="total_price" class="col-sm-3 col-form-label">Total Price <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="total_price" name="total_price" type="number"
                                class="form-control @error('total_price') is-invalid @enderror"
                                value="{{ old('total_price') }}" placeholder="Enter total price" required>
                            @error('total_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row my-3">
                        <label for="supplier" class="col-sm-3 col-form-label">Supplier <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input id="supplier" name="supplier" type="text"
                                class="form-control @error('supplier') is-invalid @enderror"
                                value="{{ old('supplier') }}" placeholder="Enter supplier" required>

                            @error('supplier')
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
