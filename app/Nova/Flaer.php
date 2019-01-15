<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Froala\NovaFroalaField\Froala;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Flaer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Models\\Flaer';

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
                ->creationRules('unique:flaers,slug')
                ->updateRules('unique:flaers,slug,{{resourceId}}'),

            TextWithSlug::make('Title')
                ->slug('Slug')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description')
                ->rules('required', 'max:255'),

            Froala::make('Content')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Price')
                ->rules('nullable', 'regex:/^-?(?:\d+|\d*\.\d+)$/'),

            Number::make('Discount')
                ->rules('nullable', 'numeric'),

            TimeField::make('Start'),

            TimeField::make('Finish'),

            BelongsTo::make('Club', 'club', 'App\\Nova\\Club')
                ->searchable(),

            Image::make('Image')
                ->disk('public')
                ->path('flaers/images')
                ->rules('mimes:jpeg')
                ->storeAs(function (Request $request) {
                    return substr(sha1($request->image->getClientOriginalName() . uniqid()), 1, 5) . '.' . $request->image->getClientOriginalExtension();
                }),

            Boolean::make('Status'),
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
