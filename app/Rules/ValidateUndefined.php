<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateUndefined implements Rule {
    protected $attribute;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
      $this->attribute = $attribute;
      
      if($value == 'undefined' || $value == '') {
        return false;
      }

      return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'The ' . $this->attribute . ' field is required.';
    }
}
