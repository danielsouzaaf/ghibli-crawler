<?php

namespace GhibliCrawler\Http\Requests\Character;

use GhibliCrawler\Presenters\CharacterPresenter;
use GhibliCrawler\Repositories\CharacterRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResultsRequest extends FormRequest
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
            'fmt' => ['required', Rule::in(CharacterPresenter::FORMATS_ARRAY)],
            'sort' => ['nullable', Rule::in(['desc', 'asc'])],
            'order' => ['nullable', Rule::in(array_keys(CharacterRepository::MAPA_ORDER_CAMPOS))]
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all();
        $data['fmt'] = $this->query('fmt');
        $data['order'] = $this->query('order');
        $data['filter'] = $this->query('filter');
        $data['sort'] = $this->query('sort');

        return $data;
    }
}
