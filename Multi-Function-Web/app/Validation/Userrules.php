<?php
namespace App\Validation;
use App\Models\UserModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UserModel();

    $user = $model->UserDetail($data['email']);  
    
    if(!$user)
    return false;

    if($data['password'] == $user->password) { 
      return true; 
    } else { 
      
      return false; 
    
    } 
}

}