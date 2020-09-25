<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Kategori extends Model
{
    use Sortable;
    protected $table='kategori';
    public $primaryKey='id';
    //
    public $sortable = ['id',
    'nama',
    'deskripsi',
    'isactive'];
}
