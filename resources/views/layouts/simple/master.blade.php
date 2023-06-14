<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('layouts.simple.css')
    @yield('style')
</head>

<body>

    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        @include(' layouts.simple.header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <!-- Page Sidebar Start-->
        <main class="main-wrapper">
            @include('layouts.simple.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="content-wrapper">
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts.simple.footer')
        </main>


    </div>

    <!-- latest jquery-->
    @include('layouts.simple.script')
    <!-- Plugin used-->


</body>

</html>
