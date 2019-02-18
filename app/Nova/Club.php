<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Bissolli\NovaPhoneField\PhoneNumber;
use Froala\NovaFroalaField\Froala;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;

class Club extends Resource
{
    public static $group = 'Clubs';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Models\\Club';

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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Slug::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:clubs,slug')
                ->updateRules('unique:clubs,slug,{{resourceId}}'),

            TextWithSlug::make('Title')
                ->slug('Slug')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description')
                ->rules('required', 'max:255'),

            BelongsTo::make('ClubType', 'type', 'App\\Nova\\ClubType')
                ->searchable(),

            Froala::make('Content')
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Image::make('Logo')
                ->disk('public')
                ->path('clubs/logos')
                ->rules('mimes:svg')
                ->storeAs(function (Request $request) {
                    return substr(sha1($request->logo->getClientOriginalName() . uniqid()), 1, 5) . '.' . $request->logo->getClientOriginalExtension();
                }),

            PhoneNumber::make('Phone')
                ->withCustomFormats('##########')
                ->onlyCustomFormats()
                ->rules('nullable', 'numeric'),

            PhoneNumber::make('Aphone')
                ->withCustomFormats('##########')
                ->onlyCustomFormats()
                ->rules('nullable', 'numeric')
                ->hideFromIndex(),

            Text::make('City')
                ->rules('max:255'),

            Text::make('Street')
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('House')
                ->rules('nullable', 'numeric', 'max:10000', 'min:1')
                ->hideFromIndex(),

            Text::make('Housing')
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Structure')
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Proficiency')
                ->rules('max:255')
                ->hideFromIndex(),

            PhoneNumber::make('Latitude')
                ->withCustomFormats('##.########')
                ->onlyCustomFormats()
                ->hideFromIndex(),

            PhoneNumber::make('Longitude')
                ->withCustomFormats('##.########')
                ->onlyCustomFormats()
                ->hideFromIndex(),

            Text::make('Site')
                ->rules('max:255', 'nullable', 'url')
                ->hideFromIndex(),

            Text::make('Color')
                ->rules('max:6'),

            HasMany::make('ClubPhotos'),

            BelongsToMany::make('Services', 'services', Service::class)
                ->searchable(),

            BelongsToMany::make('Metros', 'metros', Metro::class)
                ->searchable(),

            Boolean::make('Status'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
