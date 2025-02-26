<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arqueo extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the Arqueo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany(MovimientoCaja::class);
    }
}
