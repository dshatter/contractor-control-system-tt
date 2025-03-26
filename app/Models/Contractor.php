<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Contractor extends Model
{

    /** @use HasFactory<\Database\Factories\ContractorFactory> */
    use HasFactory, Searchable;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'contractor_users');
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'contractors_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {

        $array = [
            'inn' => $this->inn,
            'name' => $this->name,
        ];


        return $array;
    }

}
