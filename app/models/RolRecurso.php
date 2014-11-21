<?php


class RolRecurso extends BaseModel {


    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recursos_roles';

    protected $fillable = [
        'rol_id',
        'recurso_id',
    ];

    protected $visible = [
        'id',
        'rol_id',
        'recurso_id',
    ];

    protected static $rules = [
        'rol_id' => 'required',
        'recurso_id' => 'required',
    ];

    public function rol()
    {
        return $this->belongsTo('Rol', 'rol_id');
    }

    public function recurso()
    {
        return $this->belongsTo('Recurso', 'recurso_id');
    }
    public function toArray() 
    {
        $array['recurso'] = $this->recurso->recurso;
        $array['method'] = $this->recurso->method;
        return $array;
    }

}
