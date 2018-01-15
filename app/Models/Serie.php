<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model implements TableInterface
{

    protected $fillable = ['title', 'description'];

    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Descrição'];
    }

    /**
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Título':
                return $this->title;
            case 'Descrição':
                return $this->description;
        }
    }

}
