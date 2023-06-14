@extends('layouts.simple.master')
@section('content')

    <div class="main-seciton-wrapper">
        <div class="card">
            <div class="card-body pb-0">
                <div class="d-flex flex-wrap">
                    <div class="item me-auto">
                        <h4 class="mb-1">Manage Companies</h4>
                    </div>
                    <div class="item pb-3">
                        <a href="{{ route('company.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add
                            New
                            Company</a>
                    </div>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Manage Companies</li>
                    </ol>
                </nav>
                <ul class="nav nav-tabs mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">MANAGE COMPANIES</a>
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
                                    <th>Company name</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Website</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$get_all_company->isEmpty())

                                    @foreach ($get_all_company as $key => $c)
                                        <tr>
                                            <td>{{ correct_pagination_numbers($get_all_company->currentPage(), $get_all_company->perPage(), $key+1) }}
                                            </td>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->email }}</td>
                                            <td>
                                                @if (!empty($c->logo))
                                                    <img src="{{ asset('storage/company_logo/' . $c->logo) }}" height="50"
                                                        width="50">
                                                @else
                                                    {{ 'No Image' }}
                                                @endif
                                            </td>
                                            <td>{{ $c->website }}</td>
                                            <td class="">
                                                <span title="Show" data-bs-toggle="tooltip">
                                                    <a class="btn btn-action btn-light"
                                                        href="{{ route('company.show', ['company' => $c->id]) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </span>
                                                <span title="Edit" data-bs-toggle="tooltip">
                                                    <a class="btn btn-action btn-light"
                                                        href="{{ route('company.edit', ['company' => $c->id]) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </span>
                                                <span title="Delete" data-bs-toggle="tooltip">
                                                    <a class="btn btn-action btn-light delete_company" href="javascript:"
                                                        company_id="{{ $c->id }}">
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
                            {!! $get_all_company->links() !!}
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
                    <h5 class="modal-title">Are you sure you want to delete this company ?</h5>
                    <p>
                        Please check the company's details before you delete it from our list!
                    </p>
                    <input type="hidden" id="company_id" name="company_id">
                    <div class="d-flex mt-4">
                        <button type="button" class="btn flex-fill  me-4 btn-primary me-auto"
                            id="delete_company_button">Delete</button>
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
        $('.delete_company').on('click', function() {
            var cid = $(this).attr('company_id');
            $('#company_id').val(cid);
            $('#delete_confirmation').modal('show');



        })
        $('#delete_company_button').on('click', function() {
            var cid = $('#company_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: base_url + "/company/" + cid,
                // <-- what to expect back from the PHP script, if anything
                type: 'delete',
                success: function(response) {
                    location.reload(true)
                }
            });
        })
    </script>
@endsection
