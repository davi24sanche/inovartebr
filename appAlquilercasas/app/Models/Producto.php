<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function detalles()
    {
        return $this->belongsToMany('App\Models\Detalle') ->withTimestamps()->withTimestamps();
    }

    /**
     * The roles that belong to the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reservas()
    {
        return $this->belongsToMany('App\Models\Reserva','detalle_reserva','producto_id','reserva_id')->withPivot('precio') ->withTimestamps();
    }
}
