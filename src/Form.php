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

    /**
     * The default instance of Buildable to use when instantiating new Form objects
     *
     * @var Buildable
     */
    protected $builder;

    /**
     * The default instance of Inputable
     *
     * @var Buildable
     */
    protected $input;

    /**
     * Instantiate a new Form
     *
     * @var array|object $config
     */
    public function __construct($config = array())
    {
        if (is_a($config, 'Illuminate\Database\Eloquent\Model'))
        {
            $this->setModel($config);
        }
        else
        {
            $this->config = $config;
        }
    }

    /**
     * Set the instance of Buildable
     *
     * @param  Buildable  $builder
     * @return void
     */
    public function setBuilder(Builders\Buildable $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the instance of Buildable
     *
     * @return Buildable
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Set the instance of Inputable
     *
     * @param  Inputable  $input
     * @return void
     */
    public function setInput(Input\Inputable $input)
    {
        $this->input = $input;
    }

    /**
     * Get the instance of Inputable
     *
     * @return Inputable
     */
    public function getInput()
    {
        return $this->input;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    protected $model;

    /**
     * Generates an opening <form> tag.
     *
     * @param $extra array Any extra parameters - passed to Form::open()
     * @return string
     */
    public function open($extra = array())
    {
        $options = array();
        $model = $this->getModel();
        $builder = $this->getBuilder();
        
        if (is_object($model))
        {
            $url = $model->toUrl();
        }
        else
        {
            $url = $target;
        }

        return $builder->open($url, $options);
    }

    public function close()
    {
        $this->setModel(null);
        return $this->getBuilder()->close();
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