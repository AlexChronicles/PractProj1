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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'username' => 'required|regex:/^[a-zA-Z ]+$/u|max:255'
            ];


        /*switch ($this->getMethod()){
           case 'PUT':
               return [
                'email' => 'required|email|unique:users,email',
                'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,name',
                'username' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,username',
                'isActive' => 'required|boolean',
                ];
            case 'DELETE':
                return [
                    'email' => 'required|email|exist:email'
                    'name' => 'required|email|exist:email'*/
                    //if ('email' => 'exists:email')
                        //DB::table('users')->delete('email');
                //];
        //}
    }

}
