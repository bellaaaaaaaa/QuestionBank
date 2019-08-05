<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

Relation::morphMap([
  'Student' => 'App\Student',
  'Guardian' => 'App\Guardian',
  'Teacher' => 'App\Teacher'
]);

class User extends Authenticatable{
  use Notifiable;

  protected $fillable = [
      'name', 'email', 'password', 'owner_id', 'owner_type', 'avatar'
  ];

  protected $hidden = [
      'password', 'remember_token',
  ];

	public static function boot(){
		parent::boot();
		static::creating(function($user){
			$password = bcrypt($user->password);
			$user->password = $password;
		});
  }
  
  public function owner() {
    return $this->morphTo();
  }

  public function isAdmin(){
    return $this->owner_type === null;
  }

  public function isStudent(){
    return $this->owner_type === 'Student';
  }

  public function isGuardian(){
    return $this->owner_type === 'Guardian';
  }
  
  public function isTeacher(){
    return $this->owner_type === 'Teacher';
  }
}