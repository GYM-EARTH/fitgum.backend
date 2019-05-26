<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;

class ClubService extends Resource
{
    public static $group = 'Clubs';

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Models\\ClubService';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'slug'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Slug::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:club_services,slug')
                ->updateRules('unique:club_services,slug,{{resourceId}}'),

            TextWithSlug::make('Title')
                ->slug('Slug')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description')
                ->rules('required', 'max:255'),

            Image::make('Cover')
                ->disk('public')
                ->path('club/services/covers')
                ->rules('mimes:jpeg,png,svg|size:102400')
                ->storeAs(function (Request $request) {
                    return substr(sha1($request->cover->getClientOriginalName() . uniqid()), 1, 5) . '.' . $request->cover->getClientOriginalExtension();
                }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
