<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InputLppLayanan extends Model
{
    
    use HasFactory;
    protected $table = 'db_dashboard_bapp';
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
        return $this->belongsTo(LayananAplikasi::class, 'layanan_id', 'id');
    }

    public function aplikasi_by_role()
    {
        if (Auth::user()->role == 1) {
            return $this->belongsTo(LayananAplikasi::class, 'layanan_id', 'id');
        } else {
            return $this->belongsTo(LayananAplikasi::class, 'layanan_id', 'id')->where(['tw_layanan' => Auth::user()->id]);
        }
    }

    public function bidang()
    {
        return $this->belongsTo(LayananBidang::class, 'bidang_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'kode_status');
    }

    public function tracking()
    {
        return $this->hasMany(TimelineLpp::class, 'slug', 'slug')->where('is_active', '=', 1);
    }
}