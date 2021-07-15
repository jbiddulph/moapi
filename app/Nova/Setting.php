<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Http\Requests\NovaRequest;

class Setting extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Setting::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title() {
        return "{$this->title} ({$this->id})";
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Website Name'), 'website_name')->required(),
            Text::make(__('Slogan'), 'slogan')->required(),
            Text::make(__('Telephone'), 'telephone')->required(),
            Markdown::make(__('Address'), 'address')->required(),
            Code::make(__('Office Hours'), 'officehours')->required(),
            Markdown::make(__('Services'), 'servicelist')->required(),
            Image::make(__('Services BG'), 'servicebackground')->required(),
            Markdown::make(__('Services Intro'), 'servicesintro')->required(),
            Markdown::make(__('Accreditations'), 'accreditations')->required(),
            Image::make(__('Logo'), 'logo')->required(),
            Text::make(__('Email'), 'email')->required(),
            Text::make(__('Facebook'), 'facebook'),
            Text::make(__('Google'), 'google'),
            Text::make(__('Instagram'), 'instagram'),
            Text::make(__('Youtube'), 'youtube'),
            Text::make(__('Twitter'), 'twitter'),
            Text::make(__('WhatsApp'), 'whatsapp'),
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
