<?php

namespace App\Http\Requests\Api\V1;

//use Illuminate\Contracts\Validation\ValidationRule;
use App\Repositories\Mysql\Setting\SettingRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLessonRequest extends FormRequest
{
    protected SettingRepository $settingRepository;
    /**
     * Determine if the user is authorized to make this request.
     */

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null,?SettingRepository $settingRepository=null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->settingRepository = $settingRepository;
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>["required","string",Rule::unique("lessons","name")],
            "price"=>["required","numeric","min:".$this->settingRepository->first()->min_course_price],
            "course_id"=>["required","numeric",Rule::exists("courses","id")]
        ];
    }
}
