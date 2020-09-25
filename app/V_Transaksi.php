<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

// is table view
// to be used for read only
class V_Transaksi extends Model
{
    use Sortable;
    protected $table='v_transaksi';
    //
    public $sortable = ['id',
    'tanggal',
    'kode',
    'deskripsi',
    'nilai',
    'kategori_nama',
    'dompet_nama'];
}
