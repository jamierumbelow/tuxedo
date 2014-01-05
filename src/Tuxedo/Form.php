<?php
/**
 * Tuxedo
 * 
 * @package Tuxedo
 * @version 0.1.0
 * @author Jamie Rumbelow <http://jamierumbelow.net>
 * @copyright (c) 2013, Jamie Rumbelow
 * @link https://github.com/jamierumbelow/tuxedo
 */

namespace Tuxedo;

class Form {

    static protected $_model;

    /**
     * Generates an opening <form> tag, and accepts a closure to  It accepts an Eloquent model as a parameter instead of a string.
     * If you do so, the form will automatically guess the URL based on a RESTful
     * pattern - pluralising the name and setting it to lowercase.
     *
     * @param $target string or object Form Action
     * @param $extra array Any extra parameters - passed to Form::open()
     * @return string
     */
    public static function open($target, $extra = array(), Closure $closure)
    {
        $options = array();
        
        if (is_object($target))
        {
            $url = strtolower(Str::plural(get_class($target)));

            if (is_subclass_of($target, 'Eloquent'))
            {
                self::$_model = $target;

                if ($target->exists)
                    $url .= '/' . $target->id;
            }
        }
        else
        {
            $url = $target;
        }

        $options = array( 'url' => $url );
        $options = array_merge($options, $extra);

        return Form::open($options);
    }

    public static function close()
    {
        self::$_model = null;
        return Form::close();
    }

    public static function getModel()
    {
        return self::$_model;
    }

    public static function common($type, $attribute, $value = null, $label = '', $extra = array(), $tooltip = '')
    {
        $errors = self::errors();
        $label = self::getLabel($attribute, $label);
        $name = self::getName($attribute);
        $value = self::getValue($attribute, $value, $name);
        $extra = array_merge(array( 'class' => 'form-control' ), $extra);
        $error = '';
        $tooltip = ($tooltip) ? '<span class="help-block">' . $tooltip . '</span>' : '';
        
        if ($errors && $errors->get($attribute))
        {
            $error   = ' has-error';
            $tooltip = '<span class="help-block">' . implode(' ', $errors->get($attribute)) . '</span>' . PHP_EOL;
        }

        $output = '<div class="form-group' . $error . '">' . PHP_EOL;
            $output .= Form::label($name, $label, array( 'class' => 'control-label' )) . PHP_EOL;
            $output .= Form::input($type, $name, $value, $extra) . PHP_EOL;
            $output .= $tooltip;
        $output .= '</div>' . PHP_EOL;

        return $output;
    }

    public static function text($name, $options = array()) { return self::common('text', $name, '', '', $options); }
    public static function password($name, $options = array()) { return self::common('password', $name); }
    public static function submit($value = 'Save') { return Form::submit($value, array( 'class' => 'btn btn-primary' )); }

    protected static function errors()
    {
        return Session::get('errors');
    }

    protected static function getName($name)
    {
        if (self::getModel())
        {
            if (method_exists(self::getModel(), 'tuxedoFormName'))
            {
                return strtolower(self::getModel()->tuxedoFormName()) . '[' . $name . ']';
            }
            else
            {
                return strtolower(get_class(self::getModel())) . '[' . $name . ']';
            }
        }
        else
        {
            return $name;
        }
    }

    protected static function getLabel($attribute, $label)
    {
        return $label ?: ucwords(str_replace(array('_', '[', ']'), ' ', $attribute));
    }

    protected static function getValue($attribute, $value, $name)
    {
        $classname = str_replace("[$attribute]", '', $name);

        if ($value === FALSE)
        {
            return '';
        }
        else
        {
            return $value ?: (
                Input::old("$classname.$attribute") ?: (
                    isset(self::getModel()->$attribute) ? self::getModel()->$attribute : ''
                )
            );
        }
    }
}