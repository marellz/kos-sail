<?php
declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxPrice implements DataAwareRule, ValidationRule
{

    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $price_min = $this->data['price_min'];
        $price_max = $this->data['price_max'];

        if ($price_min && $price_max && $price_min > $price_max) {
            $fail('The :attribute must be cannot be lower than price_min.');
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        foreach (['price_min', 'price_max'] as $attr) {
            if (!isset($this->data[$attr])) {
                $this->data[$attr] = null;
            }
        }

        return $this;
    }
}
