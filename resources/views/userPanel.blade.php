<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>File Manager</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/light.css') }}"> --}}
    <!-- etc. -->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    {{--  BEGIN: fontawesome css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}">
    {{--  END: fontawesome css --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css') }}">

    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/forms/form-number-input.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">  --}}

</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <div class="container-fluid">

        <!-- BEGIN: Content-->
        <div class="app-content content m-0 w-100">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper w-100 p-0">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">All Files</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <section id="ajax-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    @if (Session::has('message'))
                                        <p
                                            class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3">
                                            {{ Session::get('message') }}</p>
                                    @endif
                                    <div class="card-header border-bottom">
                                        <form action="">
                                            <div class="form-group search">
                                                <label for="search">Search File Name</label>
                                                <input type="text" name="search" value="{{ $search }}"
                                                    id="search" class="form-control" placeholder="Search">
                                                <a href="{{ route('User') }}" type="button" class="btn"><i
                                                        class="fa fa-rotate-right"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-datatable overflow-auto">
                                        <table class="datatables-ajax table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Sl.No.</th>
                                                    <th>File Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($allFiles) > 0)
                                                    @foreach ($allFiles as $key => $file)
                                                        <tr>
                                                            <td>{{ $allFiles->firstItem() + $key }}</td>
                                                            <td>{{ $file->name }}</td>
                                                            <td class="d-flex">
                                                                <button type="button" class="btn btn-outline-warning viewFileBtn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#large"
                                                                    data-file-id="{{ $file->id }}"
                                                                    data-file-password="{{ $file->password }}"><i
                                                                        class="fa fa-eye"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="8" class="text-center">No Data Found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if (count($allFiles) > 0)
                                    {{ $allFiles->links('pagination::bootstrap-5') }}
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- END: Content-->
    </div>
    <!-- MODAL -->
    <div class="modal-size-lg d-inline-block" id="modal">
        <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel">Enter File Password To See The File</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!--CARD -->
                    <div class="content-body">

                        <!-- Basic File Browser start -->
                        <section id="input-file-browser">
                            <div class="card">
                                <div class="card-body pt-1">
                                    <!-- form -->
                                    <form action="" method="POST" enctype="multipart/form-data"
                                        id="enterPasswordForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-12 mb-1">
                                                <div class="input-group form-password-toggle">
                                                    <input class="form-control" type="password" value=""
                                                        name="validatePassword" />
                                                    @error('passwordInput')
                                                        <small class="-mt-3 text-red-500">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <!--/ form -->
                            </div>
                        </section>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL END-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- END: Body-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light d-flex justify-content-center">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy;
                {{ date('Y') }}<a class="ms-25" href="" target="_blank"> File Manager</a><span
                    class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    {{-- Begin Jquery --}}
    {{-- <script src="{{asset('assets/jquery.min.js')}}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.0/jquery-ui.min.js"></script>
    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> --}}
    <!-- END: Page JS-->

    <!-- BEGIN: fontawesome JS-->
    <script src="{{ asset('assets/all.min.js') }}"></script>
    <script src="{{ asset('assets/popper.min.js') }}"></script>
    <!-- END: fontawesome JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-validation.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

    <!-- BEGIN:Custom Page JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/graph.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>

    <!-- END:Custom Page JS-->

    <!-- BEGIN: Select2 JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <!-- END: Select2 JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-ecommerce-checkout.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    {{-- <script src="{{asset('app-assets/js/scripts/charts/chart-chartjs.js')}}"></script> --}}
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <script>
        // $(document).on('click','.viewFileBtn',function(){
        //     let fileId =$(this).data().fileId;
        //     $('#enterPasswordForm').attr("action","validate-file-password/"+fileId);
        // })

        // let viewFileBtns=document.getElementsByClassName('viewFileBtn');
        // let a=Array.from(viewFileBtns);
        // a.forEach(addEventListener('click'),function(element){
        //     console.log(element);
        // });
      
const buttons = document.querySelectorAll('.viewFileBtn');
// Attach event listener to each button
buttons.forEach(function(button) {
  button.addEventListener('click', function() {
   let fileId =this.getAttribute("data-file-id");
   document.getElementById('enterPasswordForm').setAttribute("action","validate-file-password/"+fileId);
  });
});
 
        // console.log(viewFileBtns);
        // .addEventListener('click', function(element) {
        
        // });
        // console.log(console.log(fileId));
        //     let fileId = element.target.getAttribute("data-file-id");
        //     document.getElementById('enterPasswordForm').setAttribute("action","/validate-file-password/" +
        //     fileId);
        //     console.log(fileId);
    </script>
    {{-- SweetAlert message --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
</body>
<!-- END: Body-->

</html>
