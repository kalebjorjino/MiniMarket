@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">{{ __('Brand') }}</h2>
                    <button type="button" class="main-btn primary-btn btn-hover btn-sm" data-bs-target="#createModal"
                        data-bs-toggle="modal">
                        <i class="lni lni-plus mr-5"></i> New Brand</button>
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
                                Category
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    @include('admin.brands.create-brand')
    @include('admin.brands.update-brand')
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
                                    <h6>Brand Image</h6>
                                </th>
                                <th>
                                    <h6>Brand Name</h6>
                                </th>
                                <th>
                                    <h6>Brand Description</h6>
                                </th>
                                <th>
                                    <h6>Actions</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @foreach ($brands as $b)
                                <tr>
                                    <td>
                                        <p>{{ $b->id }}</p>
                                    </td>
                                    <td>
                                        @if ($b->brand_image != '')
                                            <img src="{{ url('storage/' . $b->brand_image) }}" alt="{{ $b->name }}"
                                                width="50px" height="50px" class="img-thumbnail img-fluid">
                                        @endif
                                    </td>
                                    <td>
                                        <p>{{ $b->name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $b->description }}</p>
                                    </td>
                                    <td>
                                        <div class="flex justify-content-end">
                                            <button class="edit-btn" data-bs-target="#editModal" data-bs-toggle="modal"
                                                data-id="{{ $b->id }}">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="destroy delete-btn ml-8" data-id="{{ $b->id }}">
                                                <i class="lni lni-trash-can"></i>
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
    // SHOW MODAL IF ERROR
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
                "ordering": false,
                // "info": false,
            })
        });


        // EDIT
        $('#editModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var url = "{{ route('brands.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#e_id').val(data.id);
                    $('#e_name').val(data.name);
                    $('#e_description').val(data.description);
                    $('#edit-form').attr('action', "{{ route('brands.update', ':id') }}".replace(
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
