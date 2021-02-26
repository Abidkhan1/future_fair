<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\FacebookSocialiteController;

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
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);

Route::get('/redirect', [FacebookSocialiteController::class, 'redirectToProvider']);
Route::get('/callback', [FacebookSocialiteController::class, 'handleProviderCallback']);



//Video Chat Routes starts here
  // Route::get('video_chat', function ()
  // { dd('hello'); })->name('video_chat');
  Route::get('staff_video_chat', 'VideoChatController@videoChat')->name('staff_video_chat');

  Route::get('video_chat', 'VideoChatController@index')->name('video_chat');
  Route::post('auth/video_chat', 'VideoChatController@auth');
  Route::get('videoCall/room_name/{room_name}/username/{username}','VideoChatController@videoCall');

//Video Chat Routes ends here

Route::post('getFriends', 'HomeController@getFriends')->name('getFriends');
Route::post('getFriend/{id}', 'HomeController@getFriend')->name('getFriend');
Route::post('/session/create', 'SessionController@create');
Route::post('/session/{session}/chats', 'ChatController@chats');
Route::post('/session/{session}/read', 'ChatController@read');
Route::post('/session/{session}/clear', 'ChatController@clear');
Route::post('/session/{session}/block', 'ChatController@block');
Route::post('/session/{session}/unblock', 'ChatController@unblock');
Route::post('/send/{session}', 'ChatController@send');


Auth::routes();

Route::get('/chat', 'ChatController@chat')->name('chat');

Route::post('signup', 'Auth\RegisterUserController@register')->name('signup');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('send_notification','Admin\VideoController@send_notification');

Route::group(['middleware'=>['auth','web']],function(){
    Route::group(['namespace' => 'Admin','middleware' => 'role:admin'], function(){

        //Notification Routes
        Route::get('create_notification','VideoController@create_notification')->name('create_notification');

        //Notification Routes

        // Company Routes starts here
        Route::resource('pavillions','PavillionController');
        Route::get('delete_pavillion/{id}','PavillionController@delete_pavillion')->name('delete_pavillion');
        Route::get('events_list','PavillionController@events_list')->name('events_list');
        Route::get('event_pavillions/{event_id}/company/{company_id}','PavillionController@event_pavillions')->name('event_pavillions');
        // Company Routes starts here

        // Company Routes starts here
        Route::resource('companies','CompanyController');
        Route::get('delete_company/{id}','CompanyController@delete_company')->name('delete_company');
        Route::get('register_event_index/{company_id}','CompanyController@register_event_index')->name('register_event_index');
        Route::post('register_event','CompanyController@register_event')->name('register_event');
        // Company Routes starts here

        // Event Routes starts here
        Route::resource('events','EventController');
        Route::get('delete_event/{id}','EventController@delete_event')->name('delete_event');
        // Event Routes starts here

        // Slot Routes starts here
        Route::resource('slots','SlotController');
        Route::get('delete_slot/{id}','SlotController@delete_slot')->name('delete_slot');
        // Slot Routes starts here

        Route::get('user_dashboard_data','SettingController@user_dashboard_data')->name('user_dashboard_data');
        Route::get('user_dashboard','SettingController@user_dashboard')->name('user_dashboard');
        Route::post('user_dashboard','SettingController@save_settings')->name('user_dashboard');
    });//Admin Routes

    Route::get('/chats', 'ChatController@index')->name('chats');
    Route::get('/messages', 'ChatController@fetchAllMessages')->name('messages');
    Route::post('/messages', 'ChatController@sendMessage')->name('messages');

    // Route::group(['namespace' => 'Staff','middleware' => 'role:staff'],function (){
    //
    // });// staff Routes

    Route::group(['namespace' => 'Company','middleware' => 'role:company'], function(){
        // Event Routes starts here
        Route::get('company_events', 'CompanyRoleController@index')->name('company_events');

        Route::get('event_detail/{id}','CompanyRoleController@event_detail')->name('event_detail');
        // Event Routes starts here

        //Staff Routes starts here
        Route::resource('staff','StaffController');
        Route::get('delete_staff/{id}','StaffController@delete_staff')->name('delete_staff');
        //Staff Routes ends here

        //Gallery Routes starts here
        Route::resource('gallery','GalleryController');
        //Gallery Routes ends here

        //Profile Routes
        Route::resource('company_profile','CompanyProfileController');
        Route::post('comp_prof_details','CompanyProfileController@comp_prof_details')->name('comp_prof_details');

        Route::get('comp_banner_poster','CompanyProfileController@comp_banner_poster')->name('comp_banner_poster');
        Route::get('get_banner_poster','CompanyProfileController@get_banner_poster')->name('get_banner_poster');
        Route::post('comp_banner_poster','CompanyProfileController@save_banner_poster')->name('comp_banner_poster');

        Route::get('comp_documents','CompanyProfileController@comp_documents')->name('comp_documents');
        Route::get('get_documents','CompanyProfileController@get_documents')->name('get_documents');
        Route::post('comp_documents','CompanyProfileController@save_documents')->name('comp_documents');
        Route::post('remove_document','CompanyProfileController@remove_document')->name('remove_document');

        Route::get('comp_videos','CompanyProfileController@videos')->name('comp_videos');
        Route::post('upload_videos','CompanyProfileController@upload_videos')->name('upload_videos');
        Route::get('get_videos','CompanyProfileController@get_videos')->name('get_videos');
        Route::post('remove_video','CompanyProfileController@remove_video')->name('remove_video');

        Route::get('design','CompanyProfileController@design')->name('design');
        Route::get('get_design','CompanyProfileController@get_design')->name('get_design');
        Route::post('save_design','CompanyProfileController@save_design')->name('save_design');
        //Profile Routes

        Route::get('company_video','VideoController@video')->name('company_video');
        //Offers routes starts here
        Route::resource('offer','OfferController');
        Route::get('delete_offer/{id}','OfferController@delete_offer')->name('delete_offer');
        //Offers routes ends here

        //Visitors routes starts here
        Route::resource('visitor','VisitorController');
        //Visitors routes ends here

    });//Company Routes

    // Enduser(Public) routes starts here
    Route::group(['namespace' => 'EndUser','middleware' => 'role:public'],function (){
      Route::get('pavillion','EndUserController@pavillion')->name('pavillion1');

      Route::get('event_select/{id}','EndUserController@event_select')->name('eventSelect');

      Route::get('pavillion_data/{id}','EndUserController@pavillion_data')->name('pavillion_data');

      Route::get('reception/{id}/event/{event_id}','EndUserController@reception')->name('reception');

      Route::get('user_profile','EndUserController@user_profile')->name('user_profile');
      Route::get('user_data/{id}','EndUserController@user_data')->name('user_data');
      Route::post('save_user_data','EndUserController@save_user_data')->name('save_user_data');
      Route::post('change_password','EndUserController@change_password')->name('change_password');
      Route::post('profile_image','EndUserController@profile_image')->name('profile_image');
      Route::post('update_profile','EndUserController@update_profile')->name('update_profile');

      Route::get('company_staffs/{id}','EndUserController@company_staffs')->name('company_staffs');

      Route::get('get_sitesettings','EndUserController@get_sitesettings')->name('get_sitesettings');

      Route::get('user_notification','EndUserController@user_notification')->name('user_notification');


    });//Enduser(Public) routes ends here
});// Authenticated routes
