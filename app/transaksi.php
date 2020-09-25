<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Transaksi extends Model
{
    use Sortable;
    protected $table='transaksi';
    public $primaryKey='id';
    //
    public $sortable = ['id',
    'tanggal',
    'kode',
    'deskripsi',
    'nilai'];
}
