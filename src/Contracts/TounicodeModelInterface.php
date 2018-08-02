<?php
namespace Kyawnaingtun\Tounicode\Contracts;

interface TounicodeModelInterface{
    /**
     * Get the convertable attributes.
     *
     * @return array
     */
    public function getConvertable();
    /**
     * Set the convertable attributes.
     *
     * @param array $attributes to convert
     */
    public function setConvertable(array $attributes);
    /**
     * Returns whether or not the model will convert
     * attributes before saving.
     *
     * @return bool
     */
    public function getConvertion();
    /**
     * Set whether or not the model will convert attributes
     * before saving.
     *
     * @param  bool
     */
    public function setConvertion($value);
    
    /**
     * Convert attributes that should be converted.
     */
    public function convertAttributes();
    
}
