@extends('layouts.simple.master')
@section('content')
<div class="main-seciton-wrapper">
    <div class="card">
        <div class="card-body pb-0">
            <h4 class="mb-1">Show Company</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb border-bottom-0">
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}"> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('company.index') }}"> Manage Companies</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Show Company</li>
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
                    <div class="button-row">
                        <!-- /.card-body -->


                        <button type="button" class="btn btn-outline-dark w-30" id="cancle_button"
                            onclick="location.href='{{ route('company.index') }}'">Back</button>
                    </div>
                    <div class="input-row mb-3 mt-4">
                        <label for="website">Name : </label>
                        <input type="text" class="form-control" id="name" placeholder="Company name"
                            name="name"  value="{{ old('name',$company->name) }}" disabled>
                    </div>

                    <div class="input-row mb-3">
                        <label for="email">Email : </label>
                        <input type="text" class="form-control" id="email" placeholder="email"
                            name="email" value="{{ old('email',$company->email) }}" disabled>
                    </div>

                    <div class="input-row mb-3">
                        <label for="company_logo">Company Logo : </label>
                    </div>
                    <div class="input-row mb-3">
                        @if (isset($company->logo) && !empty($company->logo))
                            <img src="{{ asset('storage/company_logo/' . $company->logo) }}" height="75" width="75">
                        @endif
                    </div>
                    <div class="input-row mb-3">
                        <label for="website">Website : </label>
                        <input type="text" class="form-control" id="website" placeholder="Website"
                            name="website" value="{{ old('website',$company->website) }}" disabled>
                    </div>

                </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

@endsection
@section('script')
@endsection
