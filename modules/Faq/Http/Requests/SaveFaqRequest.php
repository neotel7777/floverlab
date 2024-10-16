<?php

namespace Modules\Faq\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Faq\Entities\Faq;
use Illuminate\Validation\Rule;

class SaveFaqRequest extends FormRequest
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'faq::attributes.faq.items';
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
                'slug' => $this->getSlugRule(),
                'name' => 'required',
                'description' => 'required',
                'publish_status' => 'required',
        ];
    }

    private function getSlugRule(): array
    {
        $rules = $this->route()->getName() === 'admin.faq.update' ? ['required'] : ['sometimes'];

        $slug = Faq::withoutGlobalScope('published')
            ->where('id', $this->id)
            ->value('slug');

        $rules[] = Rule::unique('faqs', 'slug')->ignore($slug, 'slug');

        return $rules;
    }


}
