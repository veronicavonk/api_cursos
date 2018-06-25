<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    protected $table = 'usuario';
    protected $primaryKey = 'usu_id';
    public $timestamps = false;
    
  protected $fillable = [
        'usu_nombre',
        'usu_email',
        'usu_telefono',
        'usu_nick',
        'usu_password',
        'usu_pais',
        'usu_genero',
        'usu_fecha_nacimiento',
        'usu_foto',
        'usu_verificado'
    ];

    protected $hidden=['usu_fecha_nacimiento','usu_verificado'];




    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->usu_password;
    }
    
}