@extends('layouts.simple.master')
@section('content')
<div class="main-seciton-wrapper">
    <div class="card">
        <div class="card-body pb-0">
            <h4 class="mb-1">Edit Company</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb border-bottom-0">
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}"> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}"> Manage Companies</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Edit Company</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="card">
        <div class="card-body">
            <div class="w-700">
                <form method="POST" id="edit_company_form" action="{{ route('company.update',['company'=>$company->id]) }}"
                    autocomplete="off" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="input-row mb-3">
                        <label for="name">Name : </label>
                        <input type="text" class="form-control" id="name" placeholder="Company name"
                            name="name"  value="{{ old('name',$company->name) }}">
                        @error('name')
                            <span class="error-msg" id="name_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-row mb-3">
                        <label for="email">Email : </label>
                        <input type="text" class="form-control" id="email" placeholder="email"
                            name="email" value="{{ old('email',$company->email) }}">
                        @error('email')
                            <span class="error-msg" id="email_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-row mb-3">
                        <label for="company_logo">Company Logo : </label>
                        <input type="file" class="form-control" id="company_logo" placeholder="Company Logo" name="company_logo"
                            value="Select company logo">
                        @error('company_logo')
                            <span class="error-msg" id="company_logo_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="input-row mb-3">
                        @if (isset($company->logo) && !empty($company->logo))
                            <img src="{{ asset('storage/company_logo/' . $company->logo) }}" height="75" width="75">
                        @endif
                    </div>
                    <div class="input-row mb-3">
                        <label for="website">Website : </label>
                        <input type="text" class="form-control" id="website" placeholder="Website"
                            name="website" value="{{ old('website',$company->website) }}">
                        @error('website')
                            <span class="error-msg" id="website_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                </form>
                <div class="button-row">
                    <!-- /.card-body -->

                    <button type="button" class="btn btn-primary w-100 mb-3" id="update_company">Save</button>
                    <button type="button" class="btn btn-outline-dark w-100" id="cancle_button"
                        onclick="location.href='{{ route('company.index') }}'">Cancel</button>
                </div>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

@endsection
@section('script')

    <script>

        $(function() {

            $('#update_company').on('click', function() {

                    $('#edit_company_form').submit();

            })
        });
    </script>
@endsection
