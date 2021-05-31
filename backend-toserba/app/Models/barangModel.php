<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangModel extends Model
{
    protected $table = "barang";
    protected $primarykey = "id_barang";
    public $timestamps = false;

    protected $fillable=[
    	'id_barang','nama_barang','stock','harga'
    ];
}
