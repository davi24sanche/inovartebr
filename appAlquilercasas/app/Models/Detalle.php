<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Detalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto')->withTimestamps();
    }

    /**
     * The roles that belong to the Detalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reservas()
    {
        return $this->belongsToMany('App\Models\Reserva')->withTimestamps();
    }

    /**
     * Get the user that owns the Detalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo()
    {
        return $this->belongsTo('App\Models\Tipo');
    }


}
