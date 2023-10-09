<?php

namespace App\Http\Requests;

use App\Rules\Filter;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $id = $this->route('category')  ; 
        return [
            
                'name' => ['required','string','min:3','max:20',"unique:categories,name,$id",new Filter(['god','master'])],
                'parent_id' => 'nullable|integer|exists:categories,id',
                'status' => 'in:active,archived',
                'image' => 'image|mimes:png,jpg|max:1024000' ,
                
                
             
        ];
    }
}
