<?php
namespace Kyawnaingtun\Tounicode\Observers;

use Kyawnaingtun\Tounicode\Contracts\TounicodeModelInterface;

class TounicodeModelObserver
{
    
    public function creating(TounicodeModelInterface $model)
    {
        $this->performConvertion($model, 'creating');
    }
    /**
     * Undocumented function
     *
     * @param TounicodeModelInterface $model
     * @return void
     */
    public function updating(TounicodeModelInterface $model)
    {
        $this->performConvertion($model, 'updating');
    }
    /**
     * Undocumented function
     *
     * @param TounicodeModelInterface $model
     * @param [type] $event
     * @return void
     */
    protected function performConvertion(TounicodeModelInterface $model, $event)
    {
        if ($model->getConvertion()) {
            $model->convertAttributes();
        }
    }
}
