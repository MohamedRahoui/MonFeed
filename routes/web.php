<?php
// Redirect to my_space if Connected
Route::group(['middleware' => 'check_guest'], function () {
    // home_page view render
    Route::get('/', function () {
        return view('home');
    });
    // register view render
    Route::get('register', 'AuthController@register_view');

    // register post handle
    Route::post('register', 'AuthController@register');

    // email confirmation
    Route::get('validate_email/{key}', 'AuthController@email_confirmation');

    // login view render
    Route::get('login', 'AuthController@login_view');

    // login post handle
    Route::post('login', 'AuthController@login');
});

// Redirect to home_page if not Connected
Route::group(['middleware' => 'check_auth'], function () {
    // logout
    Route::get('logout', 'AuthController@logout');

    // my_space route group
    Route::group(['prefix' => 'my_space'], function () {
        // my_space view render
        Route::get('/', 'MySpaceController@my_space_view');
        // youtube route group
        Route::group(['prefix' => 'youtube'], function () {
            // my videos view render
            Route::get('/', 'YoutubeController@youtube_view');
            // search view render
            Route::get('search', 'YoutubeController@search_view');
            // add video post handle
            Route::post('add_video', 'YoutubeController@add_video');
            // get videos ids
            Route::get('get_videos_ids', 'YoutubeController@get_videos_ids');
            // delete video by key
            Route::post('delete_video_by_key', 'YoutubeController@delete_video_by_key');
        });
        // facebook route group
        Route::group(['prefix' => 'facebook'], function () {
            // Facebook index view render
            Route::get('/', 'FacebookController@facebook_view');
            // Facebook pubs view render
            Route::get('pubs', 'FacebookController@publications_view');
            // Facebook search view render
            Route::get('search', 'FacebookController@search_view');
            // add page post handle
            Route::post('add_page', 'FacebookController@add_page');
            // get pages ids
            Route::get('get_pages_ids', 'FacebookController@get_pages_ids');
            // delete page by key
            Route::post('delete_page_by_key', 'FacebookController@delete_page_by_key');
        });
    });

});