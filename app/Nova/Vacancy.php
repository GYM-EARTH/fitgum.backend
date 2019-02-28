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
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class Vacancy extends Resource
{
    public static $group = 'Service';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Models\\Vacancy';

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
        'id', 'title'
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

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Club')
                ->nullable(),

            Froala::make('Definition')
                ->hideFromIndex(),

            Froala::make('Responsibility')
                ->hideFromIndex(),

            Froala::make('Demand')
                ->hideFromIndex(),

            Froala::make('Conditions')
                ->hideFromIndex(),

            Number::make('Salary')
                ->rules('nullable', 'numeric'),

            BelongsTo::make('City')
                ->nullable(),

            BelongsTo::make('Metro')
                ->nullable(),

            PhoneNumber::make('Latitude')
                ->withCustomFormats('##.########')
                ->rules('nullable', 'regex:^([0-9]{2}\.[0-9]{8})$^')
                ->onlyCustomFormats()
                ->hideFromIndex(),

            PhoneNumber::make('Longitude')
                ->withCustomFormats('##.########')
                ->rules('nullable', 'regex:^([0-9]{2}\.[0-9]{8})$^')
                ->onlyCustomFormats()
                ->hideFromIndex(),

            Text::make('Department')
                ->rules('max:255')
                ->hideFromIndex(),

            PhoneNumber::make('Phone')
                ->withCustomFormats('##########')
                ->onlyCustomFormats()
                ->rules('nullable', 'numeric'),

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
