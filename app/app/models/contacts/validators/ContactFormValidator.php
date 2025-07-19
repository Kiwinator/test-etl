<?php
    namespace app\models\contacts\validators;

    use app\components\validators\Validator;

    class ContactFormValidator extends Validator
    {
        public function __construct()
        {
            $this->rules = [
                'name' => [
                    $this->notEmpty(),
                ],
                'phones' => [
                    $this->notEmpty(),
                ],
            ];
        }

        public function validate($dto): bool
        {
            try {
                $data = [
                    'name' => $dto->getName(),
                    'phones' => $dto->getPhones(),
                ];

                if (!$this->_validate($data)) {
                    throw new \Exception('Переданы некорректные данные при инициализации контакта: ' . json_encode($this->errors()));
                }

                return true;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), $e->getCode(), $e);
            }
        }
    }