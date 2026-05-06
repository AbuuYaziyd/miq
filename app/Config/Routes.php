<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 
$routes->get('/', 'Home::index');
$routes->get('locale/(:any)', 'Home::locale/$1');
$routes->get('image/(:any)/(:num)', 'Home::image/$1/$2');
$routes->get('test', 'Home::test');
$routes->get('rooms', 'Home::rooms');

/*
 * --------------------------------------------------------------------
 * Custom Routes My Auth Routings
 * --------------------------------------------------------------------
 */
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::auth');
$routes->get('change/password', 'AuthController::pass', ['filter' => 'auth']);
$routes->post('change/password/(:num)', 'AuthController::change/$1', ['filter' => 'auth']);
$routes->get('logout', 'AuthController::logout');
$routes->get('recover', 'AuthController::recover');
$routes->post('password', 'AuthController::password');
$routes->get('reset/(:num)', 'AuthController::reset/$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Routes Groups Website Routings
 * --------------------------------------------------------------------
 */
$routes->group('web', function ($routes) {
    $routes->get('/', 'WebsiteController::index', ['filter' => 'admin']);
    $routes->get('carousel', 'WebsiteController::carousel', ['filter' => 'admin']);
    $routes->post('carousel', 'WebsiteController::carouselUpdate', ['filter' => 'admin']);
    $routes->get('about', 'WebsiteController::about', ['filter' => 'admin']);
    $routes->post('about', 'WebsiteController::aboutUpdate', ['filter' => 'admin']);
    $routes->post('about-text', 'WebsiteController::aboutTextUpdate', ['filter' => 'admin']);
    $routes->get('image/(:num)', 'WebsiteController::image/$1', ['filter' => 'admin']);
    $routes->post('image', 'WebsiteController::imageChange', ['filter' => 'admin']);
    $routes->get('delete-image/(:num)', 'WebsiteController::deleteImage/$1', ['filter' => 'admin']);
    $routes->get('admission', 'WebsiteController::admission', ['filter' => 'admin']);
    $routes->post('admission', 'WebsiteController::admissionUpdate', ['filter' => 'admin']);
    $routes->get('contact', 'WebsiteController::contact', ['filter' => 'admin']);
    $routes->post('contact', 'WebsiteController::contactUpdate', ['filter' => 'admin']);
    $routes->post('hero', 'WebsiteController::hero', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups User Routings
 * --------------------------------------------------------------------
 */
$routes->group('user', function ($routes) {
    $routes->get('/', 'UserController::index', ['filter' => 'auth', 'as' => 'user']);
    $routes->get('profile/(:num)', 'UserController::profile/$1', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'UserController::show/$1', ['filter' => 'auth', 'as' => 'user.show']);
    $routes->post('update', 'UserController::update/$1', ['filter' => 'auth', 'as' => 'user.update']);
    // $routes->post('image', 'UserController::image', ['filter' => 'admin');
    // $routes->get('delete-image/(:num)', 'UserController::deleteImage/$1', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Admin Routings
 * --------------------------------------------------------------------
 */
$routes->group('admin', function ($routes) {
    $routes->get('/', 'AdminController::index', ['filter' => 'admin']);
    $routes->get('setting', 'AdminController::setting', ['filter' => 'admin']);
    $routes->get('registration', 'AdminController::registration', ['filter' => 'admin']);
    // $routes->get('show-user-register/(:num)', 'AdminController::showReg/$1', ['filter' => 'admin']);
    // $routes->get('register-delete/(:num)', 'AdminController::regDelete/$1', ['filter' => 'admin']);
    // $routes->post('register', 'AdminController::register', ['filter' => 'admin']);
    // $routes->post('malipo', 'AdminController::malipo', ['filter' => 'admin']);
    $routes->get('rooms', 'AdminController::rooms', ['filter' => 'admin']);
    $routes->post('room', 'AdminController::room', ['filter' => 'admin']);
    $routes->get('delete-room/(:num)', 'AdminController::DeleteRoom/$1', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Grades Results Routings
 * --------------------------------------------------------------------
 */
$routes->group('grade', function ($routes) {
    $routes->get('/', 'GradeController::index', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'GradeController::show/$1', ['filter' => 'auth']);
    $routes->post('update', 'GradeController::update', ['filter' => 'auth']);
    // $routes->get('add', 'GradeController::add', ['filter' => 'auth']);
    // $routes->post('create', 'GradeController::create', ['filter' => 'auth']);
    // $routes->get('delete/(:num)', 'GradeController::delete/$1', ['filter' => 'auth']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Years Routings
 * --------------------------------------------------------------------
 */
$routes->group('year', function ($routes) {
    $routes->get('/', 'YearController::index', ['filter' => 'admin']);
    $routes->get('add', 'YearController::add', ['filter' => 'admin']);
    $routes->post('create', 'YearController::create', ['filter' => 'admin']);
    $routes->get('show/(:num)', 'YearController::show/$1', ['filter' => 'admin']);
    $routes->post('update', 'YearController::update', ['filter' => 'admin']);
    $routes->get('change/(:num)', 'YearController::change/$1', ['filter' => 'admin']);
    // $routes->get('delete/(:num)', 'YearController::delete/$1', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Students Routings
 * --------------------------------------------------------------------
 */
$routes->group('student', function ($routes) {
    $routes->get('/', 'StudentController::index', ['filter' => 'auth']);
    $routes->get('view/(:num)', 'StudentController::view/$1', ['filter' => 'teacher']);
    $routes->get('new', 'StudentController::new', ['filter' => 'admin']);
    $routes->post('create', 'StudentController::create', ['filter' => 'admin']);
    $routes->get('assign/(:num)/(:num)', 'StudentController::assign/$1/$2', ['filter' => 'admin']);
    $routes->get('page/(:num)', 'StudentController::page/$1', ['filter' => 'auth']);
    $routes->get('data', 'StudentController::data', ['filter' => 'admin', 'as' => 'student.data']);
    $routes->get('id/(:num)', 'StudentController::id/$1', ['filter' => 'auth']);
    $routes->get('class-change/(:num)/(:num)', 'StudentController::classChange/$1/$2', ['filter' => 'admin']);
    $routes->get('upgrade/(:num)', 'StudentController::upgrade/$1', ['filter' => 'admin']);
    $routes->post('edit/(:num)', 'StudentController::edit/$1', ['filter' => 'admin']);
    // $routes->get('change-class/(:num)/(:any)', 'StudentController::changeClass/$1/$2', ['filter' => 'admin']);
    // $routes->get('back/(:num)', 'StudentController::back/$1', ['filter' => 'auth']);
    // $routes->get('add', 'StudentController::new', ['filter' => 'auth']);
    // $routes->get('show/(:num)', 'StudentController::show/$1', ['filter' => 'auth']);
    // $routes->get('cases', 'StudentController::cases', ['filter' => 'auth']);
    // $routes->get('add/(:num)', 'StudentController::addStudents/$1', ['filter' => 'auth']);
    // $routes->post('addStd', 'StudentController::create', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Teacher Routings
 * --------------------------------------------------------------------
 */
$routes->group('teacher', function ($routes) {
    $routes->get('/', 'TeacherController::index', ['filter' => 'teacher']);
    $routes->get('add', 'TeacherController::add', ['filter' => 'auth']);
    $routes->get('data', 'TeacherController::data', ['filter' => 'auth']);
    $routes->post('create', 'TeacherController::create', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'TeacherController::show/$1', ['filter' => 'auth']);
    $routes->get('id/(:num)', 'TeacherController::id/$1', ['filter' => 'auth']);
    $routes->get('edit/(:num)', 'TeacherController::edit/$1', ['filter' => 'auth']);
    $routes->post('update', 'TeacherController::update', ['filter' => 'auth']);
    $routes->get('page/(:num)', 'TeacherController::page/$1', ['filter' => 'auth']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Khirrij Routings
 * --------------------------------------------------------------------
 */
$routes->group('khirrij', function ($routes) {
    $routes->get('/', 'KhirrijController::index', ['filter' => 'auth']);
    // $routes->get('show/(:num)', 'KhirrijController::show/$1', ['filter' => 'auth']);
    // $routes->get('year/(:num)', 'KhirrijController::year/$1', ['filter' => 'auth']);
    // $routes->get('info/(:num)', 'KhirrijController::info/$1', ['filter' => 'auth']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Mafsul Routings
 * --------------------------------------------------------------------
 */
$routes->group('mafsul', function ($routes) {
    $routes->get('/', 'MafsulController::index', ['filter' => 'auth']);
    // $routes->get('add/(:num)', 'MafsulController::add/$1', ['filter' => 'auth']);
    // $routes->get('show/(:num)', 'MafsulController::show/$1', ['filter' => 'auth']);
    // $routes->post('create', 'MafsulController::create', ['filter' => 'auth']);
    // $routes->get('back/(:num)', 'MafsulController::back/$1', ['filter' => 'auth']);
    // $routes->post('update', 'MafsulController::update', ['filter' => 'auth']);
    // $routes->get('info/(:num)', 'MafsulController::info/$1', ['filter' => 'auth']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups School Routings
 * --------------------------------------------------------------------
 */
$routes->group('school', function ($routes) {
    $routes->get('/', 'SchoolController::index', ['filter' => 'admin']);
    $routes->get('add', 'SchoolController::add', ['filter' => 'admin']);
    $routes->get('show/(:num)', 'SchoolController::show/$1', ['filter' => 'admin']);
    $routes->post('create', 'SchoolController::create', ['filter' => 'admin']);
    $routes->post('update', 'SchoolController::update', ['filter' => 'admin']);
    // $routes->get('delete/(:num)', 'SchoolController::delete/$1', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Courses Routings
 * --------------------------------------------------------------------
 */
$routes->group('course', function ($routes) {
    $routes->get('show/(:num)', 'CourseController::show/$1', ['filter' => 'admin']);
    $routes->post('update', 'CourseController::update', ['filter' => 'admin']);
    $routes->get('attendance/(:segment)/(:num)', 'CourseController::attendance/$1/$2', ['filter' => 'admin']);
    $routes->get('settings/(:num)', 'CourseController::settings/$1', ['filter' => 'admin']);
    $routes->get('students/(:num)', 'CourseController::students/$1', ['filter' => 'admin']);
    $routes->get('add/(:num)', 'CourseController::add/$1', ['filter' => 'admin']);
    $routes->post('create', 'CourseController::create', ['filter' => 'admin']);
    $routes->get('links', 'CourseController::links', ['filter' => 'admin']);
    $routes->post('link', 'CourseController::link', ['filter' => 'admin']);
    $routes->get('delete-link/(:num)', 'CourseController::deleteLink/$1', ['filter' => 'admin']);
    $routes->get('delete/(:num)', 'CourseController::delete/$1', ['filter' => 'admin']);
    $routes->get('delete/(:num)', 'CourseController::delete/$1', ['filter' => 'admin']);
    $routes->get('class/(:num)/(:num)', 'CourseController::class/$1/$2', ['filter' => 'teacher']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Subjects Routings
 * --------------------------------------------------------------------
 */
$routes->group('subject', function ($routes) {
    $routes->get('course/(:num)', 'SubjectController::course/$1', ['filter' => 'admin']);
    $routes->get('add/(:num)', 'SubjectController::add/$1', ['filter' => 'admin']);
    $routes->post('create', 'SubjectController::create', ['filter' => 'admin']);
    $routes->get('show/(:num)', 'SubjectController::show/$1', ['filter' => 'auth']);
    $routes->post('update', 'SubjectController::update', ['filter' => 'admin']);
    $routes->get('about/(:num)', 'SubjectController::about/$1', ['filter' => 'teacher']);
    $routes->post('book', 'SubjectController::book', ['filter' => 'teacher']);
    $routes->get('debook/(:num)', 'SubjectController::debook/$1', ['filter' => 'teacher']);
    $routes->get('delete/(:num)', 'SubjectController::delete/$1', ['filter' => 'teacher']);
    $routes->get('put/(:num)/(:num)', 'SubjectController::put/$1/$2', ['filter' => 'admin']);
    $routes->get('class/(:num)', 'SubjectController::class/$1', ['filter' => 'teacher']);
});

/*
 * --------------------------------------------------------------------
 * Routes Attendance Routings
 * --------------------------------------------------------------------
 */
$routes->group('attendance', function ($routes) {
    $routes->get('/', 'AttendanceController::index', ['filter' => 'auth']);
    $routes->post('create', 'AttendanceController::create', ['filter' => 'auth']);
    $routes->post('update', 'AttendanceController::update', ['filter' => 'auth']);
    $routes->get('student/(:num)', 'AttendanceController::student/$1', ['filter' => 'auth']);
    $routes->post('date', 'AttendanceController::date', ['filter' => 'auth']);
    $routes->get('appeal/(:num)', 'AttendanceController::appeal/$1', ['filter' => 'auth']);
    $routes->post('submit-appeal', 'AttendanceController::submitAppeal', ['filter' => 'auth']);
    $routes->get('reply/(:num)', 'AttendanceController::reply/$1', ['filter' => 'auth']);
    $routes->get('accept/(:num)', 'AttendanceController::accept/$1', ['filter' => 'auth']);
    $routes->get('dismiss/(:num)', 'AttendanceController::dismiss/$1', ['filter' => 'auth']);
    $routes->get('delete/(:num)', 'AttendanceController::delete/$1', ['filter' => 'auth']);
});

/*
 * --------------------------------------------------------------------
 * Routes Periods Routings
 * --------------------------------------------------------------------
 */
$routes->group('period', function ($routes) {
    $routes->get('/', 'PeriodController::index', ['filter' => 'auth']);
    $routes->get('add', 'PeriodController::add', ['filter' => 'auth']);
    $routes->post('create', 'PeriodController::create', ['filter' => 'auth']);
    $routes->get('show/(:num)', 'PeriodController::show/$1', ['filter' => 'auth']);
    $routes->post('update', 'PeriodController::update', ['filter' => 'auth']);
    $routes->get('delete/(:num)', 'PeriodController::delete/$1', ['filter' => 'auth']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups class Academy Routings
 * --------------------------------------------------------------------
 */
$routes->group('timetable', function ($routes) {
    $routes->get('/', 'TimetableController::index', ['filter' => 'auth']);
    $routes->get('mustawa/(:num)', 'TimetableController::mustawa/$1', ['filter' => 'admin']);
    $routes->post('create', 'TimetableController::create', ['filter' => 'admin']);
    $routes->post('add', 'TimetableController::add', ['filter' => 'admin']);
    $routes->get('delete/(:num)', 'TimetableController::delete/$1', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups Results Routings
 * --------------------------------------------------------------------
 */
$routes->group('result', function ($routes) {
    $routes->get('/', 'ResultController::index', ['filter' => 'admin']);
    $routes->get('open', 'ResultController::open', ['filter' => 'teacher']);
    $routes->get('(:segment)/add', 'ResultController::add/$1', ['filter' => 'teacher']);
    $routes->get('(:segment)/marks/(:num)', 'ResultController::marks/$1/$2', ['filter' => 'teacher']);
    $routes->get('(:segment)/calculation', 'ResultController::calculation/$1', ['filter' => 'teacher']);
    $routes->get('sign/(:num)/(:segment)', 'ResultController::sign/$1/$2', ['filter' => 'teacher']);
    $routes->post('(:segment)/update', 'ResultController::update/$1', ['filter' => 'teacher']);
    $routes->get('(:segment)/done/(:num)', 'ResultController::done/$1/$2', ['filter' => 'teacher']);
    $routes->get('(:segment)/gpa/(:num)', 'ResultController::gpa/$1/$2', ['filter' => 'teacher']);
    $routes->get('(:segment)/position/(:num)', 'ResultController::position/$1/$2', ['filter' => 'teacher']);
    $routes->get('(:segment)/show/(:num)/(:num)', 'ResultController::show/$1/$2/$3', ['filter' => 'teacher']);
    $routes->get('view/(:segment)/(:num)/(:num)', 'ResultController::view/$1/$2/$3', ['filter' => 'teacher']);
    $routes->get('student/(:num)', 'ResultController::student/$1', ['filter' => 'auth']);
    $routes->get('user/(:num)/(:num)', 'ResultController::user/$1/$2', ['filter' => 'auth']);
    $routes->post('change', 'ResultController::change', ['filter' => 'auth']);
    $routes->post('change-final', 'ResultController::changeFinal', ['filter' => 'auth']);
    $routes->get('teacher/(:num)', 'ResultController::teacher/$1', ['filter' => 'teacher']);
    $routes->get('(:segment)/(:num)', 'ResultController::edit/$1/$2', ['filter' => 'teacher']);
    $routes->get('insert/(:num)', 'ResultController::insert/$1', ['filter' => 'admin']);
});

/*
 * --------------------------------------------------------------------
 * Routes Groups GPA Routings
 * --------------------------------------------------------------------
 */
$routes->group('gpa', function ($routes) {
    $routes->get('class/(:segment)/(:num)/(:num)', 'GpaController::class/$1/$2/$3', ['filter' => 'admin']);
    $routes->get('kashf/(:num)/(:num)', 'GpaController::kashf/$1/$2', ['filter' => 'auth']);
    // $routes->post('edit', 'GpaController::edit', ['filter' => 'auth']);
    // $routes->get('make/(:num)', 'GpaController::make/$1', ['filter' => 'admin']);
    $routes->get('view/(:num)/(:num)', 'GpaController::view/$1/$2', ['filter' => 'teacher']);
    $routes->get('progress/(:num)', 'GpaController::progress/$1', ['filter' => 'auth']);
    // $routes->get('search/(:any)', 'GpaController::search/$1', ['filter' => 'auth']);
    // $routes->get('position/(:num)', 'GpaController::position/$1', ['filter' => 'admin']);
});