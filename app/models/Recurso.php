<?php


class Recurso extends BaseModel {


    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recursos';

    protected $fillable = [
        'method',
        'recurso',
    ];

    protected $visible = [
        'id',
        'method',
        'recurso',
    ];

    protected static $rules = [
        'method' => 'required',
        'recurso' => 'required',
    ];

    public function rol()
    {
        return $this->hasMany('RolRecurso', 'recurso_id');
    }

}
