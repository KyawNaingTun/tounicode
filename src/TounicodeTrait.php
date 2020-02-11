<?php
namespace Kyawnaingtun\Tounicode;
use Illuminate\Database\Eloquent\Model;
use Kyawnaingtun\Tounicode\Services\Converter;
use Kyawnaingtun\Tounicode\Observers\TounicodeModelObserver;
trait TounicodeTrait{

    /**
     * Whether the model is converting or not.
     *
     * @var bool
     */
    protected $convertion = true;
    /**
     * Boot the trait's observers.
     */
    public static function bootTounicodeTrait()
    {
        // static::observe(new TounicodeModelObserver());
        static::retrieved(function ($model) {
            $model->convertAttributes('get');
        });

        static::saving(function ($model) {
			$model->convertAttributes('set');
		});
    }
    /**
     * Get the convertable attributes.
     *
     * @return array
     */
    public function getConvertable()
    {
        return $this->convertable ?: [];
    }
    /**
     * Convert attributes that should be converted.
     */
    public function convertAttributes($mode)
    {
        if($mode == 'set'){
            foreach ($this->getConvertable() as $attribute) {
                $this->setConvertionAttribute($attribute, $this->getAttribute($attribute));
            }
        }else{
            foreach ($this->getConvertable() as $attribute) {
                $this->getConvertionAttribute($attribute, $this->getAttribute($attribute));
            }
        }
        
    }
    /**
     * Set a converted value for a convertable attribute.
     *
     * @param string $attribute name
     * @param string $value     to convert
     */
    public function setConvertionAttribute($attribute, $value)
    {
        // Set the value which is presumably plain text
        $this->attributes[$attribute] = $value;
        // Do the converting if it needs it
        if (!empty($value)) {
            $this->attributes[$attribute] = Converter::convert($value);
        }
    }

    /**
     * Get a converted value for a convertable attribute.
     *
     * @param string $attribute name
     * @param string $value     to convert
     */
    public function getConvertionAttribute($attribute, $value)
    {
        // Get the value which is presumably plain text
        $this[$attribute] = $value;
        // Do the converting if it needs it
        if (!empty($value)) {
            $this[$attribute] = Converter::convert($value);
        }
    }
    
}
