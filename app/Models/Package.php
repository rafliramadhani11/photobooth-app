<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }


    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
