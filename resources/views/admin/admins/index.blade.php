@extends('admin.layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap mb-30">
                    <h2 class="mr-40">{{ __('Admins') }}</h2>
                    <button type="button" class="main-btn primary-btn btn-hover btn-sm" data-bs-target="#createAdminModal"
                        data-bs-toggle="modal">
                        <i class="lni lni-plus mr-5"></i> New admin</button>
                    {{--  <a href="#" class="main-btn primary-btn btn-hover btn-sm">
                        <i class="lni lni-plus mr-5"></i> New admin</a> --}}
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
                                Admins
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    @include('admin.admins.create-admin')

    {{-- <button type="button" class="btn btn-default btn-sm" id="editAdmin"
                                                    data-id="1" data-target="#editAdminModal" data-toggle="modal"
                                                    style="background-color:#DDAB54; border-color:#B48845; color: white;">Edit</button> --}}
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

                <div class="table-wrapper table-responsive">
                    <table class="table striped-table">
                        <thead>
                            <tr>
                                <th>
                                    <h6>Name</h6>
                                </th>
                                <th>
                                    <h6>Email</h6>
                                </th>
                                <th>
                                    <h6>Actions</h6>
                                </th>
                            </tr>
                            <!-- end table row-->
                        </thead>
                        <tbody>
                            @foreach ($admins as $a)
                                <tr>
                                    <td>
                                        <p>{{ $a->name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $a->email }}</p>
                                    </td>
                                    <td>
                                        <button class="edit-btn">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button class="destroy delete-btn ml-8" data-id="{{ $a->id }}">
                                            <i class="lni
                                            lni-trash-can"></i>
                                        </button>
                                        {{-- <button class="main-btn btn-sm primary-btn">
                                            Edit
                                        </button>
                                        <button class="main-btn btn-sm danger-btn delete-btn ml-10">
                                            Delete
                                        </button> --}}
                                    <td>
                                </tr>
                            @endforeach
                            <!-- end table row -->
                        </tbody>
                    </table>
                    <!-- end table -->


                    {{ $admins->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (count($errors) > 0)
        <script>
            $(document).ready(function() {
                $('#createAdminModal').modal('show');
            });
        </script>
    @endif


    <script>
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
