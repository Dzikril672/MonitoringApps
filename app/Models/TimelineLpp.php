<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineLpp extends Model
{
    use HasFactory;
    protected $table = 'db_timeline_bapp';
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

    public function aplikasi()
    {
        return $this->belongsTo(LayananAplikasi::class, 'aplikasi_id', 'id');
    }
    public function bidang()
    {
        return $this->belongsTo(LayananBidang::class, 'bidang_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'kode_status');
    }
}
