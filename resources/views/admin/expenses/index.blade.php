@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">{{ __('Expenses') }}</h2>
                    <button type="button" class="main-btn primary-btn btn-hover btn-sm" data-bs-target="#createModal"
                        data-bs-toggle="modal">
                        <i class="lni lni-plus mr-5"></i> New Expense</button>
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
                            <li class="breadcrumb-item active" aria-current="page">
                                Expenses
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    @include('admin.expenses.create-expense')
    @include('admin.expenses.update-expense')

    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

                @if ($message = Session::get('success'))
                    <div class="alert-box success-alert">
                        <div class="alert">
                            <p class="text-medium">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                @endif

                <div id="data_table_wrapper" class="table-wrapper table-responsive">
                    <table id="data_table" class="table striped-table">
                        <thead>
                            <tr>
                                <th>
                                    <h6>#</h6>
                                </th>
                                <th>
                                    <h6>Expense Date</h6>
                                </th>
                                <th>
                                    <h6>Category</h6>
                                </th>
                                <th>
                                    <h6>Product</h6>
                                </th>
                                <th>
                                    <h6>Quantity</h6>
                                </th>
                                <th>
                                    <h6>Total Price (₱)</h6>
                                </th>
                                <th>
                                    <h6>Supplier</h6>
                                </th>
                                <th data-orderable="false">
                                    <h6>Actions</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>
                                        <p>{{ $expense->id }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $expense->expense_date }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $expense->product->category->name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $expense->product->title }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $expense->quantity }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $expense->total_price }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $expense->supplier }}</p>
                                    </td>
                                    <td>
                                        <div class="flex justify-content-end">
                                            <button class="edit-btn" data-bs-target="#editModal" data-bs-toggle="modal"
                                                data-id="{{ $expense->id }}">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="destroy delete-btn ml-8" data-id="{{ $expense->id }}">
                                                <i
                                                    class="lni
                                            lni-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->

                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
     {{-- SHOW MODAL IF ERROR --}}
    @if ($errors->has('name') || $errors->has('description'))
        <script>
            $(document).ready(function() {
                $('#createModal').modal('show');
            });
        </script>
    @endif

    @if ($errors->has('e_name') || $errors->has('e_description'))
        <script>
            $(document).ready(function() {
                $('#editModal').modal('show');
            });
        </script>
    @endif

    <script>
        // DATATABLES
        $(document).ready(function() {
            $("#data_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [ ],
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    }
                ]
            }).buttons().container().appendTo('#data_table_wrapper .col-md-6:eq(0)');
        });


        // CREATE 

        // Set expense date by default
        document.getElementById('expense_date').valueAsDate = new Date();


        // Load Category when Product Title is changed
        $('#product_id').change(function(e) {
            e.preventDefault();

            var id = this.value;

            console.log(id);
            $.ajax({
                url: '{{ route('getProduct') }}',
                method: 'get',
                data: {
                    'search': id
                },
                success: function(res) {
                    console.log(res);
                    $("#category").val(res.category_id);
                }
            });
        });


        // EDIT
        $('#editModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var url = "{{ route('expenses.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#e_expense_date').val(data.expense_date);
                    $('#e_product_id').val(data.product_id);
                    $('#e_category').val(data.product_id);
                    $('#e_quantity').val(data.quantity);
                    $('#e_total_price').val(data.total_price);
                    $('#e_supplier').val(data.supplier);
                    $('#edit-form').attr('action', "{{ route('expenses.update', ':id') }}".replace(
                        ':id',
                        id));
                }
            });
        })

        // DELETE  
        var url = window.location.href;

        $('body').on('click', '.destroy', function(e) {
            e.preventDefault();
            let id = $(this).data('id')
            console.log(id);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`${url}/${id}`).then(function(r) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'The record has been deleted.',
                            'success'
                        )
                    }).then(() => {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Action is cancelled',
                        'error'
                    )
                }
            })
        });
    </script>
@endsection
