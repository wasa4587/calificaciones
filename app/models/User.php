<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait;
    use RemindableTrait;
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'rol_id',
        'username',
        'is_admin',
        'password',
    ];

    protected $visible = [
        'id',
        'email',
        'rol_id',
        'username',
        'name',
        'is_admin',
    ];

    protected static $rules = [
        'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
        'name' => 'required',
        'password' => 'required|min:6',
    ];

    public function recursos()
    {
        return $this->hasMany('RolRecurso', 'rol_id', 'rol_id');
    }

    public function rol()
    {
        return $this->belongsTo('Rol', 'rol_id');
    }    

    protected function setCustomRules()
    {
        if ($this->id) {
            $this->customRules['email'] = 'required|email|unique:users,email,'.$this->id.',id,deleted_at,NULL';
            $this->customRules['username'] = 'required|unique:users,username,'.$this->id.',id,deleted_at,NULL';
        }
    }
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = Hash::make($user->password);
            }
        });
    }
}
