<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!--favicon-->
    <link rel="icon" href="/{{ setting('site_favicon') }}" type="image/png" />

    <!--plugins-->
    <link href="{{ asset('backend/assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/fullcalendar/css/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/notifications/css/lobibox.min.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" /> --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- loader-->

    <script>
        var obj_config = {
            limit: "{{ LIMIT }}",
        };
    </script>
    @FilemanagerScript
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/icons.css') }}" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dark-theme.css') }}" />

    <!-- vuejs -->
    <link rel="stylesheet" href="{{ asset('css/vue.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/assets/css/custome.css') }}" />
    @stack('css')

</head>


<body>
    <div id="preloader">
        <div class="loading-component">
            <div class="spinner-border" role="status">
            </div>
        </div>
    </div>
    <div class="wrapper" id="app">
        <img class="centered" src="/images/ajax-loader.gif" alt="" srcset="">

        <!--sidebar-wrapper-->
        @include('backend.partials.sidebar')
        <!--end sidebar-wrapper-->

        <!--header-->
        @include('backend.partials.header')
        <!--end header-->

        <!--page-wrapper-->
        <div class="page-wrapper">
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </div>
        <!--end page-wrapper-->

        <!--start overlay-->
        <div class="overlay toggle-btn-mobile"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <!--footer -->
        @include('backend.partials.footer')
        <!-- end footer -->
    </div>

    <!--start switcher-->
    {{-- @include('backend.partials.switcher') --}}
    <!--end switcher-->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script> --}}
    <!--plugins-->
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fullcalendar/js/main.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/datetimepicker/js/legacy.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/datetimepicker/js/picker.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/datetimepicker/js/picker.time.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/datetimepicker/js/picker.date.js') }}"></script>
    <script src="{{ asset('backend/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- datetimepicker  -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!--notification js -->
	<script src="{{ asset('backend/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset('backend/assets/plugins/notifications/js/notifications.min.js') }}"></script>
	<script src="{{ asset('backend/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    {{-- <script src="{{ asset('backend/assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script> --}}

    <script src="{{ asset('backend/assets/js/function.js') }}"></script>

    <!--vuejs-->
    <script src="{{ asset('js/vue.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script type="text/javascript">
        window.onload = function() {
            if (sessionStorage.getItem('darktheme')) {
                $("html").addClass("dark-theme");
                $('#darkmode').prop('checked', true);
                $('#lightmode').prop('checked', false);
            }
        }
    </script>
    @include('auth.toast')

    <script>
        $(document).on('click', '.delete-confirm', function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Khi bạn đồng ý, bạn sẽ không thể quay lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vâng, Xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
    <script>
        $(document).on('click', '.delete-confirm1', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Khi bạn đồng ý, bạn sẽ không thể quay lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vâng, Xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        });
    </script>
    {{-- multiple image preview --}}
    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove</span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }

        });
    </script>


    @stack('js')
</body>

</html>
