<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contractors';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'inn',
        'name',
        'ogrn',
        'address',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'contractor_users');
    }

}
