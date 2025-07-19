<?php

namespace app\components\validators;

abstract class Validator
{
    protected $rules = [];
    protected $errors = [];

    // Добавляет правило валидации для поля
    public function _validate(array $data): bool
    {
        $this->errors = [];

        foreach ($this->rules as $field => $validators) {
            $value = isset($data[$field]) ? $data[$field] : null;

            foreach ($validators as $validator) {
                $errorMessage = $validator($value, $data);
                if ($errorMessage !== true) {
                    $this->errors[$field][] = $errorMessage;
                }
            }
        }

        return $this->errors === [];
    }

    // Возвращает ошибки валидации
    public function errors(): array
    {
        return $this->errors;
    }

    // Вспомогательные методы валидации
    public function notEmpty($message = "Поле не может быть пустым"): \Closure
    {
        return fn($v) => empty($v) ? $message : true;
    }

    // Проверяет, что значение является числом
    public function isNumber($message = "Должно быть числом"): \Closure
    {
        return fn($v) => is_numeric($v) ? true : $message;
    }

    // Проверяет, что значение является числом или null
    public function isNumberOrNull($message = "Должно быть числом или null"): \Closure
    {
        return fn($v) => is_numeric($v) || $v === null ? true : $message;
    }

    // Проверяет, что значение является строкой
    public function isString($message = "Должно быть строкой"): \Closure
    {
        return fn($v) => is_string($v) ? true : $message;
    }

    abstract public function validate($data): bool;
}
