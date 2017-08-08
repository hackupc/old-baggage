<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model{
    protected $table = 'hupc_positions';

    protected $fillable = [
        'row',
        'col',
        'id',
        'name',
        'surname',
        'created',
        'deleted',
        'description'
    ];
}
