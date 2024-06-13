<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'master_roles';
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'name_role',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role', 'id_role');
    }
    public function getRoleName($idrole)
    {
        $role = self::where('id_role', $idrole)->first();

        return $role ? $role->name_role : "Role not found";
    }
}
