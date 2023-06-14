@extends('layouts.simple.master')
@section('content')

    <div class="main-seciton-wrapper">
        <div class="card">
            <div class="card-body pb-0">
                <div class="d-flex flex-wrap">
                    <div class="item me-auto">
                        <h4 class="mb-1">Manage Employees</h4>
                    </div>
                    <div class="item pb-3">
                        <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add
                            New
                            Employee</a>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Manage Employees</li>
                    </ol>
                </nav>
                <ul class="nav nav-tabs mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">MANAGE EMPLOYEES</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main content -->
        <div class="card">
            <div class="card-body space-md">
                <div class="table-body">
                    <div class="table-responsive">
                        <table id="companies" class="table table-bordered text-nowrap">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$get_all_employee->isEmpty())

                                    @foreach ($get_all_employee as $key => $e)
                                        <tr>
                                            <td>{{ correct_pagination_numbers($get_all_employee->currentPage(), $get_all_employee->perPage(), $key+1) }}
                                            </td>
                                            <td>{{ $e->first_name }}</td>
                                            <td>{{ $e->last_name }}</td>
                                            <td>{{ !empty($e->company_details)?$e->company_details->name:"" }}</td>
                                            <td>{{ $e->email }}</td>
                                            <td>{{ $e->phone }}</td>
                                            <td class="">
                                                <span title="Show" data-bs-toggle="tooltip">
                                                    <a class="btn btn-action btn-light"
                                                        href="{{ route('employee.show', ['employee' => $e->id]) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </span>
                                                <span title="Edit" data-bs-toggle="tooltip">
                                                    <a class="btn btn-action btn-light"
                                                        href="{{ route('employee.edit', ['employee' => $e->id]) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </span>
                                                <span title="Delete" data-bs-toggle="tooltip">
                                                    <a class="btn btn-action btn-light delete_employee" href="javascript:"
                                                        employee_id="{{ $e->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </span>




                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $get_all_employee->links() !!}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <!-- /.container-fluid -->
    <div class="modal fade" id="delete_confirmation" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="modal-icon fa fa-trash"></span>
                    <h5 class="modal-title">Are you sure you want to delete this employee ?</h5>
                    <p>
                        Please check the employee's details before you delete it from our list!
                    </p>
                    <input type="hidden" id="employee_id" name="employee_id">
                    <div class="d-flex mt-4">
                        <button type="button" class="btn flex-fill  me-4 btn-primary me-auto"
                            id="delete_employee_button">Delete</button>
                        <button type="button" class="btn flex-fill ms-4 btn-outline-dark" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

@endsection
@section('script')

    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var base_url = '{{ url('') }}';


    </script>
    @if ($request->session()->has('status'))
        <script>
            var msg = "{{ $request->session()->get('status') }}";
            Swal.fire(
                msg,
                '',
                'success'
            )
        </script>
    @endif
    <script>
        $('.delete_employee').on('click', function() {
            var cid = $(this).attr('employee_id');
            $('#employee_id').val(cid);
            $('#delete_confirmation').modal('show');



        })
        $('#delete_employee_button').on('click', function() {
            var eid = $('#employee_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: base_url + "/employee/" + eid,
                // <-- what to expect back from the PHP script, if anything
                type: 'delete',
                success: function(response) {
                    location.reload(true)
                }
            });
        })
    </script>
@endsection
