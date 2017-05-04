<?php

namespace Roksta\Punctuator;


/**
 * Class SimpleTextFormater
 * @package Package
 * @author sam_roksta
 *
 */
trait Spacer
{
    protected static function bootSpacer()
    {
        static::creating(function ($model) {
            isset($model->name) ? $model->name = $model->parseString($model->name) : '';
            isset($model->description) ? $model->description = $model->parseText($model->description) : '';
        });

        static::updating(function ($model) {
            isset($model->name) ? $model->name = $model->parseText($model->name) : '';
            isset($model->description) ? $model->description = $model->parseText($model->description) : '';
        });
    }

    public function parseText(String $text)
    {
        // Space after . and next word begin with uppercase
        $pieces = explode('.', $text);
        $new_pieces = [];
        foreach ($pieces as $piece) {
            array_push($new_pieces, ucfirst($piece));
        }
        $text = implode('. ', $new_pieces);

        // Space after ? and next word begin with uppercase
        $pieces = explode('?', $text);
        $new_pieces = [];
        foreach ($pieces as $piece) {
            array_push($new_pieces, ucfirst($piece));
        }
        $text = implode('? ', $new_pieces);

        // Space after ,
        $pieces = explode(',', $text);
        $text = implode(', ', $pieces);

        return $text;
    }

    public function parseString(String $text)
    {
        return ucwords($text);
    }

}