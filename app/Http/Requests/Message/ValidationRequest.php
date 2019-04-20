<?php
 
namespace App\Http\Requests\Message;
 
use Illuminate\Foundation\Http\FormRequest;
 
class ValidationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'number'  => 'required|max:30',
            'name'    => 'required|string|max:50',
            'message' => 'required',
        ];
    }
}