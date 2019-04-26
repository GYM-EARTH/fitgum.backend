<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::domain(env('APP_API_DOMAIN', ''))->group(function () {

    Route::get('/index', 'HomeController@index')->name('home');

    Route::post('/newsletter/create', 'Api\\NewsletterController@store');
    Route::get('/newsletter/confirm/{email}/{token}', 'Api\\NewsletterController@confirm')->name('newsletter.confirm');

    Route::middleware('guest')->group(function () {
        Route::post('/login', 'Api\\Auth\\AuthController@login');
        Route::post('/register', 'Api\\Auth\\AuthController@register');

        Route::post('/password/forgot', 'Api\\Auth\\ResetPasswordController@forgot');
        Route::get('/password/reset/{token}', 'Api\\Auth\\ResetPasswordController@reset')->name('password.reset');
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/cabinet', 'Api\\CabinetController@index');

        Route::post('/cabinet/avatar', 'Api\\CabinetController@updateAvatar');

        Route::post('/messages/send', 'Api\\MessagesController@store');

        Route::get('/messages/get/{chat}', 'Api\\MessagesController@get');

        Route::get('/messages/chats', 'Api\\MessagesController@chats');
    });

    Route::get('/categories', 'Api\\CategoriesController@index');

    Route::get('/categories/{slug}', 'Api\\CategoriesController@show');

    Route::get('/news', 'Api\\NewsController@index');

    Route::get('/news/{slug}', 'Api\\NewsController@show');

    Route::get('/types', 'Api\\TypesController@index');

    Route::get('/types/{slug}', 'Api\\TypesController@show');

    Route::get('/clubs', 'Api\\ClubsController@index');

    Route::get('/clubs/{slug}', 'Api\\ClubsController@show');

    Route::get('/vacancies', 'Api\\VacanciesController@index');

    Route::get('/vacancies/{id}', 'Api\\VacanciesController@show');

    Route::get('/trainers', 'Api\\TrainersController@index');

    Route::get('/trainers/{slug}', 'Api\\TrainersController@show');

    Route::get('/videos', 'Api\\VideosController@index');

    Route::get('/videos/{slug}', 'Api\\VideosController@show');

    Route::get('/flaers', 'Api\\FlaersController@index');

    Route::get('/flaers/{slug}', 'Api\\FlaersController@show');

    Route::get('/navigations', 'Api\\NavigationController@index');

    Route::get('/metros', 'Api\\MetrosController@index');

    Route::get('/metros/{slug}', 'Api\\MetrosController@show');

    Route::get('/services', 'Api\\ServicesController@index');

    Route::get('/services/{slug}', 'Api\\ServicesController@show');

    Route::get('/programs', 'Api\\ProgramsController@index');

    Route::get('/programs/{slug}', 'Api\\ProgramsController@show');

    Route::get('sitemap-articles', function () {
        $sitemap_articles = App::make("sitemap");

//        $sitemap_articles->setCache('laravel.sitemap-articles', 3600);

        $articles = \App\Models\News::orderBy('created_at', 'desc')->get();

        foreach ($articles as $article) {
            $sitemap_articles->add('https://fitgum.ru/news/' . $article->slug, $article->updated_at, '0.8', 'monthly');
        }

        return $sitemap_articles->render('xml');
    });
});

