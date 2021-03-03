<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Reserva
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The roles that belong to the Reserva
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto')->withTimestamps() ;
    }

    /**
     * The roles that belong to the Reserva
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function detalles()
    {
        return $this->belongsToMany('App\Models\Detalle')->withTimestamps();
    }

    /**
     * Get the user that owns the Reserva
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function historico()
    {
        return $this->belongsTo('App\Models\Historico');
    }


}
