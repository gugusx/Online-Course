<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {
    // use EntrustUserTrait;
    // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'position', 'gambar', 'level', 'jenis', 'tgl_join', 'tgl_expired','no_hp', 'provider', 
        'provider_id', 'profesi', 'instansi', 'alamat', 'bio', 'gender', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }
 
    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }
    private function getUserRole()
    {
       return $this->role()->getResults();
    }
    
    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->name)) ? true : false;
    }

    public function likes(){
        return $this->belongsTo('App\like');
      }

}
