<?php

namespace App\Http\Requests;

use App\Enums\PaginateEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed per_page
 * @property mixed page
 * @property mixed sort
 * @property mixed direction
 * @property mixed paginate
 * @property User user
 */
class BaseIndexRequest extends FormRequest
{
    protected string $model = '';

    public function rules(): array
    {
        return [
            'per_page'  => 'sometimes|required|int',
            'page'      => 'sometimes|required|int',
            'sort'      => 'sometimes|required|string|' . Rule::in(getFillable($this->model)),
            'direction' => 'sometimes|required|string|' . Rule::in(PaginateEnum::DIRECTION),
            'paginate'  => 'sometimes|required|boolean',
        ];
    }

    public function prepareForValidation(): void
    {
        if (!empty($this->model)) {
            $data = explode(':', $this->sort);

            $this->merge([
                'page'      => (int)$this->page ?? PaginateEnum::DEFAULT_PAGE,
                'per_page'  => (int)$this->per_page ?? PaginateEnum::DEFAULT_PER_PAGE,
                'sort'      => (empty($this->sort) or empty($data[0])) ? PaginateEnum::DEFAULT_SORT : $data[0],
                'direction' => (empty($this->sort) or empty($data[1])) ? PaginateEnum::DEFAULT_DIRECTION : $data[1],
                'paginate'  => $this->exists('paginate') ? (bool)$this->paginate : PaginateEnum::DEFAULT_PAGINATE,
            ]);
        }
    }
}
