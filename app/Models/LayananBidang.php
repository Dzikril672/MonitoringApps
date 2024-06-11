<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananBidang extends Model
{
    use HasFactory;
    protected $table = 'master_layanan_bidang';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function user_created()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function user_updated()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
