<?php

Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('id', '[0-9]+');

Route::get('/', function () {
    return view('welcome');
});

 


Auth::routes();
Route::get('/admin', 'HomeController@index')->name('home');

// ============================= Admin Routes =============================

Route::group(['middleware' => 'auth', 'prefix'=>'admin'], function () {
    

 	# ==================== Start Admin Routes ==================== 
     Route::get('dashboard',['as'=>'admin.dashboard', 'uses'=>'HomeController@dashboard_index']);
    # ==================== Start Slider Routes ==================== 

    Route::get('slider',['as'=>'slider.index', 'uses'=>'Admin\SliderController@index']);

    Route::get('slider/create',['as'=>'slider.create', 'uses'=>'Admin\SliderController@create']);
    Route::post('slider/create',['as'=>'slider.store', 'uses'=>'Admin\SliderController@store']);

    Route::get('slider/show/{id}',['as'=>'slider.show', 'uses'=>'Admin\SliderController@show']);

    Route::get('slider/edit/{id}',['as'=>'slider.edit', 'uses'=>'Admin\SliderController@edit']);
    Route::post('slider/edit/{id}',['as'=>'slider.update', 'uses'=>'Admin\SliderController@update']);

    Route::get('slider/destroy/{id}',['as'=>'slider.destroy', 'uses'=>'Admin\SliderController@destroy']);
    Route::get('slider/active/{id}',['as'=>'slider.active', 'uses'=>'Admin\SliderController@active']);
    Route::get('slider/unactive/{id}',['as'=>'slider.unactive', 'uses'=>'Admin\SliderController@unactive']);

    # ==================== End Slider Routes ==================== 

    # ==================== Start Slider Routes ==================== 
    Route::get('about',['as'=>'about.index', 'uses'=>'Admin\AboutController@index']);

    Route::get('about/create',['as'=>'about.create', 'uses'=>'Admin\AboutController@create']);
    Route::post('about/create',['as'=>'about.store', 'uses'=>'Admin\AboutController@store']);
    Route::post('about/store/title',['as'=>'about.storetitle', 'uses'=>'Admin\AboutController@storetitle']);
    Route::post('about/edit/title/{id}',['as'=>'about.edittitle', 'uses'=>'Admin\AboutController@updatetitle']);

    Route::get('about/show/{id}',['as'=>'about.show', 'uses'=>'Admin\AboutController@show']);

    Route::get('about/edit/{id}',['as'=>'about.edit', 'uses'=>'Admin\AboutController@edit']);
    Route::post('about/edit/{id}',['as'=>'about.update', 'uses'=>'Admin\AboutController@update']);
    Route::post('about/trans/update/{id}',['as'=>'about.trans_update', 'uses'=>'Admin\AboutController@update']);

    Route::get('about/destroy/{id}',['as'=>'about.destroy', 'uses'=>'Admin\AboutController@destroy']);
    Route::get('about/active/{id}',['as'=>'about.active', 'uses'=>'Admin\AboutController@active']);
    Route::get('about/unactive/{id}',['as'=>'about.unactive', 'uses'=>'Admin\AboutController@unactive']);

    # ==================== End Slider Routes ==================== 


    # ==================== Start Slider Routes ====================  

    Route::get('services',['as'=>'services.index', 'uses'=>'Admin\ServicesController@index']);

    Route::get('services/create',['as'=>'services.create', 'uses'=>'Admin\ServicesController@create']);
    Route::post('services/create',['as'=>'services.store', 'uses'=>'Admin\ServicesController@store']);

    Route::post('services/store/title',['as'=>'services.storeservices', 'uses'=>'Admin\ServicesController@storeServices']);
    Route::post('services/edit/title/{id}',['as'=>'services.editservices', 'uses'=>'Admin\ServicesController@updateServices']);

    Route::get('services/show/{id}',['as'=>'services.show', 'uses'=>'Admin\ServicesController@show']);

    Route::get('services/edit/{id}',['as'=>'services.edit', 'uses'=>'Admin\ServicesController@edit']);
    Route::post('services/edit/{id}',['as'=>'services.update', 'uses'=>'Admin\ServicesController@update']);
    Route::post('services/trans/update/{id}',['as'=>'services.trans_update', 'uses'=>'Admin\ServicesController@update']);

    Route::get('services/destroy/{id}',['as'=>'services.destroy', 'uses'=>'Admin\ServicesController@destroy']);
    Route::get('services/active/{id}',['as'=>'services.active', 'uses'=>'Admin\ServicesController@active']);
    Route::get('services/unactive/{id}',['as'=>'services.unactive', 'uses'=>'Admin\ServicesController@unactive']);

    # ==================== End Slider Routes ==================== 


    # ==================== Start Projects Routes ====================  

    Route::get('projects',['as'=>'projects.index', 'uses'=>'Admin\ProjectsController@index']);

    Route::get('projects/create',['as'=>'projects.create', 'uses'=>'Admin\ProjectsController@create']);
    Route::post('projects/create',['as'=>'projects.store', 'uses'=>'Admin\ProjectsController@store']);

    Route::post('projects/store/title',['as'=>'projects.storeservices', 'uses'=>'Admin\ProjectsController@storeMainData']);
    Route::post('projects/edit/title/{id}',['as'=>'projects.editprojects', 'uses'=>'Admin\ProjectsController@updateMainData']);

    Route::get('projects/show/{id}',['as'=>'projects.show', 'uses'=>'Admin\ProjectsController@show']);

    Route::get('projects/edit/{id}',['as'=>'projects.edit', 'uses'=>'Admin\ProjectsController@edit']);
    Route::post('projects/edit/{id}',['as'=>'projects.update', 'uses'=>'Admin\ProjectsController@update']);
    Route::post('projects/trans/update/{id}',['as'=>'projects.trans_update', 'uses'=>'Admin\ProjectsController@update']);

    Route::get('projects/destroy/{id}',['as'=>'projects.destroy', 'uses'=>'Admin\ProjectsController@destroy']);
    Route::get('projects/active/{id}',['as'=>'projects.active', 'uses'=>'Admin\ProjectsController@active']);
    Route::get('projects/unactive/{id}',['as'=>'projects.unactive', 'uses'=>'Admin\ProjectsController@unactive']);

    # ==================== End Projects Routes ==================== 

});
