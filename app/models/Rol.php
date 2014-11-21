<?php


class Rol extends BaseModel {


    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $fillable = [
        'rol',
    ];

    protected $visible = [
        'id',
        'rol',
    ];

    protected static $rules = [
        'rol' => 'required',
    ];


}
