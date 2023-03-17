@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">{{ __('Products') }}</h2>
                    <a href="{{ route('products.create') }}" class="main-btn primary-btn btn-hover btn-sm">
                        <i class="lni lni-plus mr-5"></i> New Product</a>
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
                                Products
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
                                    <h6>Product</h6>
                                </th>
                                <th>
                                    <h6>Price</h6>
                                </th>
                                <th>
                                    <h6>Stock</h6>
                                </th>
                                <th>
                                    <h6>Category</h6>
                                </th>
                                <th>
                                    <h6>Brand</h6>
                                </th>
                                <th>
                                    <h6>Updated at</h6>
                                </th>
                                <th>
                                    <h6>Status</h6>
                                </th>
                                <th data-orderable="false">
                                    <h6>Actions</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <p>{{ $product->id }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $product->title }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $product->price }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $product->stocks }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $product->category->name }}</p>
                                    </td>
                                    <td>
                                        {{-- <p>{{ $product->brand->name }}</p> --}}
                                    </td>
                                    <td>
                                        <p>{{ $product->updated_at }}</p>
                                    </td>
                                    <td>
                                        @if ($product->status)
                                            <p>Active</p>
                                        @else
                                            <p>Inactive</p>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-content-end">
                                            <button class="edit-btn" data-bs-target="#editModal" data-bs-toggle="modal"
                                                data-id="{{ $product->id }}">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="destroy delete-btn ml-8" data-id="{{ $product->id }}">
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
    <script>
        // DATATABLES
        $(document).ready(function() {
            $("#data_table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
