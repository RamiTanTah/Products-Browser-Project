<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $rules = Project::VALIDATION_RULES;
      if ($this -> getMethod() == 'POST'){  //Store 
      return $rules;
      }
      else{     //update
        // $rules ['name'] [4]= 'unique:users,name,'. request()->route('id');
        // $rules ['email'] [4]= 'unique:users,email,'. request()->route('id');
        return $rules;
      }
      return $rules;
    }
}
