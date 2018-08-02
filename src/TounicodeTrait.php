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
        static::observe(new TounicodeModelObserver());
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
     * Set the convertable attributes.
     *
     * @param array $attributes to convert
     */
    public function setConvertable(array $attributes)
    {
        $this->convertable = $attributes;
    }
    
    /**
     * Returns whether or not the model will convert
     * attributes before saving.
     *
     * @return bool
     */
    public function getConvertion()
    {
        return $this->convertion;
    }
     /**
     * Set whether or not the model will convert attributes
     * before saving.
     *
     * @param  bool
     */
    public function setConvertion($value)
    {
        $this->convertion = (bool) $value;
    }
    /**
     * Convert attributes that should be converted.
     */
    public function convertAttributes()
    {
        \Log::info($this->getConvertable());
        foreach ($this->getConvertable() as $attribute) {
            $this->setConvertionAttribute($attribute, $this->getAttribute($attribute));
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
    
}
