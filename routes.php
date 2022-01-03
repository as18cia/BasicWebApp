<?php
include_once("./classes/route.php");
include_once("./controller/home_controller.php");
include_once("./controller/login_controller.php");
include_once("./controller/dashboard_controller.php");
include_once("./controller/logout_controller.php");
include_once("./controller/sign_up_controller.php");
include_once("./controller/upload_controller.php");
include_once("./controller/file_controller.php");

Route::set_route('/BasicWebApp/', function() {
    HomeController::create_view();
});

Route::set_route('/BasicWebApp/view/sign_up.php', function() {
    SignUpController::create_view();
});

Route::set_route('/BasicWebApp/controller/sign_up_controller.php', function() {
    SignUpController::process_info_and_create_view();
});

Route::set_route('/BasicWebApp/controller/login_controller', function() {
    LoginController::create_view();
});

Route::set_route('/BasicWebApp/view/dashboard', function() {
    DashboardController::create_view();
});

Route::set_route('/BasicWebApp/controller/logout_controller.php', function() {
    LogoutController::create_view();
});

Route::set_route('/BasicWebApp/controller/upload_controller.php', function() {
    UploadController::process_upload();
});

Route::set_route('/BasicWebApp/controller/file_controller.php', function() {
    FileController::download_file();
});


