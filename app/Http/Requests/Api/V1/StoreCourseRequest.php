<?php

namespace App\Http\Requests\Api\V1;

use App\Repositories\Mysql\Setting\SettingRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    protected SettingRepository $settingRepository;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null, ?SettingRepository $settingRepository = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->settingRepository = $settingRepository;
    }

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
        return [
            "name"=>["required","string",Rule::unique("courses","name")],
            "price"=>["required","numeric","min:".$this->settingRepository->first()->min_course_price],
            "lesson_ids"=>["nullable","array"],
            "lesson_ids.*"=>["numeric","min:1",Rule::exists("lessons","id")]
        ];
    }
}
