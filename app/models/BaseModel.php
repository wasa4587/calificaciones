<?php

class BaseModel extends Eloquent
{
    protected static $rules = [];

    protected $customRules = [];

    protected $errors = [];

    protected function setCustomRules()
    {
    }

    public static function resetBooted()
    {
        static::$booted = [];
    }

    public static function getErrorsFromValidator($validator)
    {
        $errors = $validator->messages()->toArray();

        foreach ($validator->failed() as $attribute => $rules) {
            $attributeErrors = [];
            foreach (array_keys($rules) as $index => $rule) {
                $attributeErrors[snake_case($rule)] = $errors[$attribute][$index];
            }
            $errors[$attribute] = $attributeErrors;
        }

        return $errors;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->errors = [];
            if (!$model->validate()) {
                return false;
            }
        });
    }

    public function validate($validator = null)
    {
        if (!$validator) {
            $this->setCustomRules();
            $validator = Validator::make(
                $this->getAttributes(),
                array_merge(static::$rules, $this->customRules)
            );
        }

        if ($validator->fails()) {
            $this->errors = static::getErrorsFromValidator($validator);
        }

        return $this->isValid();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        return empty($this->errors);
    }
}
