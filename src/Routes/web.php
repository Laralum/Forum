<?php

if (\Illuminate\Support\Facades\Schema::hasTable('laralum_forum_settings')) {
    $public_url = \Laralum\Forum\Models\Settings::first()->public_url;
} else {
    $public_url = 'forum';
}
Route::group([
        'middleware' => [
            'web', 'laralum.base',
        ],
        'namespace' => 'Laralum\Forum\Controllers',
        'prefix' => $public_url,
        'as' => 'laralum_public::forum.'
    ], function () use ($public_url) {
        Route::get('/', 'PublicCategoryController@index')->name('categories.index');
        Route::get('/categories/{category}', 'PublicCategoryController@show')->name('categories.show');
        Route::get('/threads/{thread}', 'PublicThreadController@show')->name('threads.show');

        Route::group([
                'middleware' => [
                    'auth', 'can:publicAccess,Laralum\Forum\Models\Comment',
                ],
            ], function () use ($public_url) {
                Route::thread('/thread/{thread}/comments' ,'PublicCommentController@store')->name('comments.store');
                Route::patch('comments/{comment}' ,'PublicCommentController@update')->name('comments.update');
                Route::delete('comments/{comment}' ,'PublicCommentController@destroy')->name('comments.destroy');
        });

});


Route::group([
        'middleware' => [
            'web', 'laralum.base', 'laralum.auth',
            'can:access,Laralum\Forum\Models\Category',
        ],
        'prefix' => config('laralum.settings.base_url').'/forum',
        'namespace' => 'Laralum\Forum\Controllers',
        'as' => 'laralum::forum.'
    ], function () {
        Route::get('categories/{category}/delete', 'CategoryController@confirmDestroy')->name('categories.destroy.confirm');
        Route::resource('categories', 'CategoryController');
        Route::group([
                'middleware' => [
                    'can:access,Laralum\Forum\Models\Thread',
                ],
            ], function () {
                Route::get('threads/{thread}/delete', 'ThreadController@confirmDestroy')->name('threads.destroy.confirm');
                Route::resource('threads', 'ThreadController', ['except' => ['index']]);
                Route::group([
                        'middleware' => [
                            'can:access,Laralum\Forum\Models\Comment',
                        ],
                    ], function () {
                        Route::thread('/thread/{thread}/comments' ,'CommentController@store')->name('comments.store');
                        Route::patch('comments/{comment}' ,'CommentController@update')->name('comments.update');
                        Route::get('comments/{comment}/destroy', 'CommentController@confirmDestroy')->name('comments.destroy.confirm');
                        Route::delete('comments/{comment}' ,'CommentController@destroy')->name('comments.destroy');
                });
        });
});

Route::group([
        'middleware' => [
            'web', 'laralum.base', 'laralum.auth',
            'can:access,Laralum\Forum\Models\Settings',
        ],
        'prefix' => config('laralum.settings.base_url'),
        'namespace' => 'Laralum\Forum\Controllers',
        'as' => 'laralum::forum.'
    ], function () {
        Route::thread('/forum/settings', 'SettingsController@update')->name('settings.update');
});
