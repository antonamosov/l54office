<?php

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

Route::get('/', 'SessionController@listForUsers')->name('main.page');

Route::get('/sendAutomaticPreEntryEmail/{student}', 'SendEmailController@sendAutomaticPreEntryEmail');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/order', 'OrderController@store');
Route::post('/user/create', 'StudentController@storePublic');
Route::get('/sig', 'SignatureController@get')->name('main.sig');
Route::post('/sig', 'SignatureController@update');

/*
 * Api
 */
Route::group(['prefix' => 'api'], function()
{
    Route::get('session/{session}/free', 'Api\SessionController@free');
    Route::get('student/{student}/confirm', 'Api\StudentController@confirm');
    Route::get('student/{student}/exam_already_taken', 'Api\StudentController@examAlreadyTaken');
    Route::get('student/{student}/delete', 'Api\StudentController@destroy');
    Route::get('exam/{exam}', 'Api\ExamController@get');
    Route::get('exam', 'Api\ExamController@index');
    Route::get('summary_title/{exam}', 'Api\ExamController@summaryTitle');
    Route::get('last-students', 'Api\StudentController@lastStudents');
    Route::get('last-created', 'Api\StudentController@lastCreated');
    Route::get('last-updated', 'Api\StudentController@lastUpdated');
    Route::get('is-editing/{student}', 'Api\StudentController@editing');
    Route::get('check-editing/{student}', 'Api\StudentController@alreadyEditing');
    Route::get('select-as-memo/{student}', 'Api\StudentController@selectAsMemo');

    // Emails
    Route::get('email/expired_pre_entry', 'SendEmailController@templateExpired');
    Route::get('email/test/{student}', 'SendEmailController@alertAdminsForNewSubscription');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function()
{

    Route::get('email/test/{email}', 'SendEmailController@template');
    Route::get('email/template/{email}', 'SendEmailController@template');
    Route::post('email/templates/{email}', 'SendEmailController@templates');
    Route::post('email/invoice', 'SendEmailController@sendInvoice');
    Route::post('email/invoice/send/{invoice}', 'SendEmailController@repeatSendInvoice');
});
/*
 * Admin
 */
Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/logout', 'AuthController@logout');

    Route::get('user', 'StudentController@index');
    Route::get('user/print', 'StudentController@userPrint');
    Route::get('{session}/user/create', 'StudentController@getCreate')->name('student.create');
    Route::post('{session}/user/create', 'StudentController@store');
    Route::get('user/edit/{student}', 'StudentController@getUser')->name('student');
    Route::get('user/edit/{student}/print', 'StudentController@getUserPrint');
    Route::post('user/update/{student}', 'StudentController@update');
    Route::get('order/{order}/user/create', 'StudentController@createFromOrders');

    Route::get('session/create', 'SessionController@create');
    Route::get('session', 'SessionController@index')->name('session.index');
    Route::get('session/edit/{session}', 'SessionController@edit')->name('session');
    Route::get('session/delete/{session}', 'SessionController@destroy');
    Route::post('session/create', 'SessionController@store');
    Route::post('session/edit/{session}', 'SessionController@update');

    Route::get('session/type', 'SessionTypeController@index');
    Route::post('session/type', 'SessionTypeController@store');
    Route::get('session/type/{sessionType}/delete', 'SessionTypeController@destroy');

    Route::get('session/course', 'CourseTypeController@index');
    Route::post('session/course', 'CourseTypeController@store');
    Route::get('session/course/{courseType}/delete', 'CourseTypeController@destroy');

    Route::get('exam', 'ExamController@index')->name('exam.index');
    Route::post('exam', 'ExamController@store');
    Route::get('exam/{exam}/edit', 'ExamController@edit');
    Route::post('exam/{exam}/edit', 'ExamController@update');
    Route::get('exam/{exam}/delete', 'ExamController@destroy');

    Route::get('email', 'EmailController@index')->name('email.index');
    Route::get('email/create', 'EmailController@create');
    Route::post('email/create', 'EmailController@store');
    Route::get('email/{email}/edit', 'EmailController@edit')->name('email.edit');
    Route::post('email/{email}/edit', 'EmailController@update');
    Route::get('email/{email}/delete', 'EmailController@destroy');
    Route::get('email/{email}/pdf/preview/{student?}', 'SendEmailController@templateDynamicPDFPreview');

    Route::get('attachment/{attachment}/delete', 'AttachmentController@destroy');

    Route::get('email/{email}/pdf/create', 'EmailPdfAttachmentController@create');
    Route::post('email/{email}/pdf/create', 'EmailPdfAttachmentController@store');
    Route::get('pdf/{pdf}/edit', 'EmailPdfAttachmentController@edit');
    Route::post('pdf/{pdf}/edit', 'EmailPdfAttachmentController@update');
    Route::get('pdf/{pdf}/delete', 'EmailPdfAttachmentController@destroy');

    Route::get('/order', 'OrderController@index');
    Route::get('/{order}/delete', 'OrderController@destroy');

    Route::post('/excel', 'ExcelController@create');

    Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');
    Route::get('/invoice/{invoice}/show', 'InvoiceController@show')->name('invoice.show');
    Route::get('/invoice/show/{student}', 'InvoiceController@createAndShow');
    Route::get('/invoice/{invoice}/toeic_show/{student}', 'InvoiceController@toeicShow');
    Route::get('/invoice/toeic_show/{student}', 'InvoiceController@toeicCreateAndShow');
    Route::get('/invoice/{invoice}/html', 'InvoiceController@html');
    Route::get('/invoice/{invoice}/delete', 'InvoiceController@destroy');
    Route::get('/invoice/{invoice}/edit', 'InvoiceController@edit');
    Route::post('/invoice/{invoice}/edit', 'InvoiceController@update');

    Route::get('/receipt/{student}/show', 'ReceiptController@show')->name('receipt.show');
    Route::get('/receipt/{student}/html', 'ReceiptController@html');

    Route::get('/image/upload', 'ImageController@upload');
    Route::post('/image/upload', 'ImageController@upload');

    Route::get('txt/university', 'TxtController@university');

    Route::get('/manager', 'UserController@index');
    Route::post('/manager', 'UserController@store');
    Route::get('/manager/edit/{user}', 'UserController@edit');
    Route::post('/manager/edit/{user}', 'UserController@update');
    Route::get('/manager/delete/{user}', 'UserController@destroy');

    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings', 'SettingsController@update');

    Route::get('/import/upload_excel', 'ExcelController@uploadExcelFilePageStep1')->name('import.excel');
    Route::post('/import/upload_excel', 'ExcelController@postUploadExcel');
    Route::get('/import/upload_csv', 'ExcelController@uploadCSVFilePageStep2');
    Route::post('/import/upload_csv', 'ExcelController@postUploadCSV');
});





