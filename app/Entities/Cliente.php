<?php

namespace Serbinario\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'phone01',
        'phone02',
        'colegio_eleitoral_id',
        'bairro_id'


    ];

    public function getTableColumns() {
        return $this->fillable;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function dataCadastro(){
        $date = date_create($this->attributes['created_at']);
        return date_format($date, 'd/m');
        // $this->attributes['created_at'];
    }
    /**
     * Get the projeto for this model.
     */
    public function bairro()
    {
        return $this->hasOne('Serbinario\Entities\Bairro','id','bairro_id');
    }

    public function colegioEleitoral()
    {
        return $this->hasOne('Serbinario\Entities\ColegioEleitoral','id','colegio_eleitoral_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
    public function setColegioEleitoralAttribute($value)
    {
        $this->attributes['colegio_eleitoral'] = strtoupper($value);
    }
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = strtoupper($value);
    }

}
