@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title  d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">{{ __('Customers') }}</h2>
                    <button type="button" class="main-btn primary-btn btn-hover btn-sm" data-bs-target="#createModal"
                        data-bs-toggle="modal">
                        <i class="lni lni-plus mr-5"></i> New Customer</button>
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
                                Customers
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    @include('admin.users.create-user')

    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30">
            <div class="card-content">

                @if ($message = Session::get('success'))
                    <div class="alert-box success-alert">
                        <div class="alert">
                            {{-- <h4 class="alert-heading">Success</h4> --}}
                            <p class="text-medium">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                @endif

                <div class="table-wrapper table-responsive" id="table_wrapper">
                    <table class="table striped-table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>
                                    <h6>#</h6>
                                </th>
                                <th>
                                    <h6>Name</h6>
                                </th>
                                <th>
                                    <h6>Email</h6>
                                </th>
                                <th>
                                    <h6>Phone</h6>
                                </th>
                                <th>
                                    <h6>Created</h6>
                                </th>
                                <th data-orderable="false">
                                    <h6>Actions</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <p>{{ $user->id }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $user->first_name . ' ' . $user->last_name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $user->email }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $user->phone }}</p>
                                    </td>
                                    <td>
                                        <p>{{ date('Y-m-d', strtotime($user->created_at)) }}</p>
                                    </td>
                                    <td>
                                        <button class="edit-btn" data-bs-target="#editModal" data-bs-toggle="modal"
                                            data-id="{{ $user->id }}">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button class="destroy delete-btn ml-8" data-id="{{ $user->id }}">
                                            <i class="lni
                                            lni-trash-can"></i>
                                        </button>
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
    @include('admin.users.update-user')
@endsection

@section('script')
    // SHOW MODAL IF ERROR
    @if ($errors->has('first_name') || $errors->has('last_name') || $errors->has('email') || $errors->has('password'))
        <script>
            $(document).ready(function() {
                $('#createModal').modal('show');
            });
        </script>
    @endif

    @if ($errors->has('e_first_name') || $errors->has('e_last_name') || $errors->has('e_email') || $errors->has('e_pass'))
        <script>
            $(document).ready(function() {
                $('#editModal').modal('show');
            });
        </script>
    @endif

    <script>
        // EDIT
        $('#editModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var url = "{{ route('users.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#e_first_name').val(data.first_name);
                    $('#e_last_name').val(data.last_name);
                    $('#e_phone_number').val(data.phone);
                    $('#e_email').val(data.email);
                    $('#edit-form').attr('action', "{{ route('users.update', ':id') }}".replace(':id',
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


        // DATATABLES
        $(document).ready(function() {
            $("#table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                buttons: [
                    // {
                    //     extend: 'copyHtml5',
                    //     exportOptions: {
                    //         columns: 'th:not(:last-child)'
                    //     }
                    // },
                    {
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
            }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
