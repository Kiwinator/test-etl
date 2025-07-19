<?php
    namespace app\models\agencies\validators;

    use app\components\validators\Validator;

    class AgencyFormValidator extends Validator
    {
        public function __construct()
        {
            $this->rules = [
                'name' => [
                    $this->notEmpty(),
                ],
            ];
        }

        public function validate($dto): bool
        {
            try {
                $data = [
                    'name' => $dto->getName(),
                ];

                if (!$this->_validate($data)) {
                    throw new \Exception('Переданы некорректные данные при инициализации агентства ' . json_encode($this->errors()));
                }

                return true;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), $e->getCode(), $e);
            }
        }
    }