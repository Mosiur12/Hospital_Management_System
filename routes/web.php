<?php

use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/checkoutResult', function () {
    return view('frontend.checkoutResult');
});*/
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//Frontend route
Route::get('/', 'HomeController@index')->name('home');

//Course routes
Route::get('/course-details/{id}', 'HomeController@courseDetails')->name('course.details');
Route::get('/category-course/{id}', 'HomeController@categoryCourse')->name('course.category');
Route::get('/popular-course', 'HomeController@popularCourse')->name('course.popular');
Route::get('/featured-course', 'HomeController@featuredCourse')->name('course.featured');
Route::get('/new-course', 'HomeController@newCourse')->name('course.new');
Route::post('/search-course', 'HomeController@searchCourse')->name('course.search');
Route::get('/all-course', 'HomeController@allCourse')->name('course.all');

//Instructor & students routes
Route::get('/instructor', 'HomeController@instructor')->name('course.instructor');
Route::get('/instructor-details/{id}', 'HomeController@instructorDetails')->name('course.instructor.details');
Route::get('/student-login', 'HomeController@login')->name('student.login');
Route::get('/student-registration', 'HomeController@registration')->name('student.registration');

//About routes
Route::get('/about', 'HomeController@about')->name('about');

//Checkout routes
Route::get('/checkout/{id}', 'HomeController@checkout')->name('checkout')->middleware('auth');
Route::post('/checkout', 'HomeController@checkoutStore')->name('checkout.store')->middleware('auth');


//Contact routes
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@contactSubmit')->name('contact.submit');

//Subscription routes
Route::post('/subscription', 'HomeController@subscription')->name('subscription');


//Instructor & students routes
Route::get('/setting/terms', 'HomeController@terms')->name('setting.terms');
Route::get('/setting/privacy', 'HomeController@privacy')->name('setting.privacy');

//Event routes
Route::get('/event/list', 'HomeController@events')->name('event.list');
Route::get('/event/details/{id}', 'HomeController@eventDetails')->name('event.details');
Route::get('/event/registration/{id}', 'HomeController@eventRegistrationForm')->name('event.registration.form')->middleware('auth');
Route::post('/event/registration', 'HomeController@eventRegistration')->name('event.registration')->middleware('auth');

Route::get('student/demo/video/{id}','student\ContentController@video')->name('course.video')->middleware('cors');


//Admin Route
Route::group(['as'=>'admin.','prefix'=>'admin', 'namespace'=>'admin', 'middleware' => ['auth', 'admin']],function (){
    Route::get('dashboard','HomeController@index')->name('dashboard');
    Route::resource('roles', 'RoleController');
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController');
    Route::resource('instructors', 'InstructorController');
    Route::resource('students', 'StudentsController');
    Route::resource('teams', 'TeamController');

    //Course Routes
    Route::resource('courses', 'CourseController');
    Route::get('course/review/{id}','CourseController@review')->name('course.review');
    Route::put('course/review/update/{id}','CourseController@reviewUpdate')->name('course.review.update');

    //setting route
    Route::resource('subscriptions', 'SubscriptionController');
    //setting route
    Route::resource('contacts', 'ContactController');
    //setting route
    Route::resource('settings', 'SettingController');

    //subscription route
    Route::resource('subscriptions', 'SubscriptionController');

    //contact route
    Route::resource('contacts', 'ContactController');

    //profile route
    Route::get('profile','HomeController@profile')->name('profile');
    Route::get('profile/Edit','HomeController@profileEdit')->name('profileEdit');
    Route::put('profile/Update/{id}','HomeController@profileUpdate')->name('profileUpdate');

    //payment history
    Route::resource('payments', 'PaymentController');

    //event routes
    Route::resource('events', 'EventController');
    Route::get('events/registration/{id}','EventController@registration')->name('events.registration');

    //Withdraw history
    Route::get('withdraw/request','WithdrawHistoryController@request')->name('withdraw.request');
    Route::put('withdraw/request-update/{id}','WithdrawHistoryController@update')->name('withdraw.request.update');
    Route::get('withdraw/history','WithdrawHistoryController@history')->name('withdraw.history');

    //password change route
    Route::get('password/change','HomeController@changePassword')->name('password.change.form');
    Route::post('password/change','HomeController@passwordUpdate')->name('password.change');

    //Search Course
    Route::post('/search-course', 'CourseController@searchCourse')->name('course.search');

});


//Instructor Route
Route::group(['as'=>'instructor.','prefix'=>'instructor', 'namespace'=>'instructor', 'middleware' => ['auth', 'instructor']],function () {
    Route::get('dashboard','HomeController@index')->name('dashboard');
    Route::resource('courses', 'CourseController');
    Route::get('course/review/{id}','CourseController@review')->name('course.review');

    //profile route
    Route::get('profile','HomeController@profile')->name('profile');
    Route::get('profile/Edit','HomeController@profileEdit')->name('profileEdit');
    Route::put('profile/Update/{id}','HomeController@profileUpdate')->name('profileUpdate');

    //payment history
    Route::resource('payments', 'PaymentController');

    //Quiz routes
    Route::resource('quizzes', 'QuizController');
    Route::get('quiz/quiz-participants/{id}','QuizController@quizParticipants')->name('course.quiz.participants');
    Route::post('quiz/upload-quiz-mark','QuizController@uploadQuizMark')->name('course.quiz.uploadQuizMark');

    //Final Exam
    Route::resource('finals', 'FinalExamController');
    Route::get('finals/final-participants/{id}','FinalExamController@finalParticipants')->name('course.finals.participants');
    Route::post('final/upload-quiz-mark','FinalExamController@uploadFinalMarks')->name('course.quiz.uploadFinalMarks');

    //Mcq quiz routes
    Route::resource('mcqQuizzes', 'McqQuizController');
    Route::resource('questions', 'QuestionController');

    //Withdraw history
    Route::resource('withdraws', 'WithdrawController');

    //Chapter
    Route::get('content/{id}','CourseController@content')->name('courses.content');
    Route::resource('chapters', 'ChapterController');
    Route::resource('lectures', 'LectureController');

    //password change route
    Route::get('password/change','HomeController@changePassword')->name('password.change.form');
    Route::post('password/change','HomeController@passwordUpdate')->name('password.change');

});

//Student Route
Route::group(['as'=>'student.','prefix'=>'student', 'namespace'=>'student', 'middleware' => ['auth', 'student']],function () {
    Route::get('dashboard','HomeController@index')->name('dashboard');

    //profile route
    Route::get('profile','HomeController@profile')->name('profile');
    Route::get('profile/Edit','HomeController@profileEdit')->name('profileEdit');
    Route::put('profile/Update/{id}','HomeController@profileUpdate')->name('profileUpdate');

    //course route
    Route::resource('courses', 'CourseController');

    //payment history
    Route::resource('payments', 'PaymentController');
    Route::get('payments/invoice/{id}','PaymentController@invoice')->name('payment.invoice');

    //course content
    Route::get('course-content/{id}','ContentController@index')->name('course.content');
    Route::get('video/{id}','ContentController@video')->name('course.video')->middleware('cors');
    Route::get('audio/{id}','ContentController@audio')->name('course.audio')->middleware('cors');
    Route::get('pdf/{id}','ContentController@pdf')->name('course.pdf')->middleware('cors');
    Route::get('ppt/{id}','ContentController@ppt')->name('course.ppt')->middleware('cors');
    Route::get('quiz/{id}/{couseId}','ContentController@quiz')->name('course.quiz');
    Route::post('quiz/upload','ContentController@quizUpload')->name('course.quiz.upload');

    //Final Exam
    Route::get('final/{id}','ContentController@final')->name('course.final');
    Route::post('final/upload','ContentController@finalUpload')->name('course.final.upload');


    Route::get('quiz/mcq/question/{id}', 'Examcontroller@question')->name('myQuiz');
    Route::post('quiz/exams','Examcontroller@examPost')->name('quiz.exam');
    Route::get('quiz-exam/{id}', 'Examcontroller@startNewQuiz')->name('quiz.start.newQuiz');


    //password change route
    Route::get('password/change','HomeController@changePassword')->name('password.change.form');
    Route::post('password/change','HomeController@passwordUpdate')->name('password.change');


    //Review routes
    Route::resource('reviews', 'ReviewController');

    //Event route
    Route::get('event/event-list', 'EventRegistrationController@index')->name('event.list');
    Route::get('event/event-details/{id}', 'EventRegistrationController@show')->name('event.show');

    //Content view route routes
    Route::get('course/course-view/{id}', "CourseviewController@view")->name('course.view');

    //Certificates routes
    Route::get('course/course-finish/{id}', "CertificateController@finish")->name('course.finish');
    Route::get('course/course-complete/list', "CertificateController@index")->name('course.complete.list');
    Route::get('course/course-certificate/{id}', "CertificateController@certificate")->name('course.certificate');

});



//Auth Route
Auth::routes();


