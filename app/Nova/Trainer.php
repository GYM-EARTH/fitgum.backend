<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Bissolli\NovaPhoneField\PhoneNumber;
use Froala\NovaFroalaField\Froala;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Trainer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Models\\Trainer';

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
                ->creationRules('unique:news,slug')
                ->updateRules('unique:news,slug,{{resourceId}}'),

            Text::make('Name')
                ->rules('required', 'max:255'),

            Text::make('Description')
                ->rules('required', 'max:255'),

            Text::make('Surname')
                ->rules('required', 'max:255'),

            TextWithSlug::make('Login')
                ->slug('Slug')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->rules('max:255', 'email'),

            PhoneNumber::make('Phone')
                ->withCustomFormats('##########')
                ->onlyCustomFormats()
                ->rules('required', 'numeric'),

            Image::make('Photo')
                ->disk('public')
                ->path('trainers/photos')
                ->rules('required', 'mimes:png')
                ->storeAs(function (Request $request) {
                    return substr(sha1($request->photo->getClientOriginalName() . uniqid()), 1, 5) . '.' . $request->photo->getClientOriginalExtension();
                }),

            BelongsTo::make('Club', 'type', 'App\\Nova\\Club')
                ->searchable(),

            Number::make('Experience')
                ->rules('nullable', 'numeric'),

            Text::make('Education')
                ->rules('max:255'),

            Froala::make('Content')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

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
