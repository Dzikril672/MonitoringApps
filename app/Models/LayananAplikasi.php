<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananAplikasi extends Model
{
    use HasFactory;
    protected $table = 'master_layanan_aplikasi';
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
    public function tw()
    {
        return $this->belongsTo(User::class, 'tw_layanan', 'id');
    }
    public function lpp()
    {
        return $this->belongsTo(InputLppLayanan::class, 'id', 'layanan_id')->where(['tahun' => date('Y', strtotime(date('Y-m-d') . '- 1 month')), 'bulan' => date('m', strtotime(date('Y-m-d') . '- 1 month'))]);
    }
    public function lpp2()
    {
        return $this->belongsTo(InputLppLayanan::class, 'id', 'layanan_id');
    }
}
