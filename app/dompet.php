<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Dompet extends Model
{
    use Sortable;
    protected $table='dompet';
    public $primaryKey='id';
    //
    public $sortable = ['id',
    'nama',
    'referensi',
    'deskripsi',
    'isactive'];

    
}
