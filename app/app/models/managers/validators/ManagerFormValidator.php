<?php
    namespace app\models\managers\validators;

    use app\components\validators\Validator;

    class ManagerFormValidator extends Validator
    {
        public function __construct()
        {
            $this->rules = [
                'name' => [
                    $this->notEmpty(),
                ],
                'idAgency' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
            ];
        }

        public function validate($dto): bool
        {
            try {
                $data = [
                    'name' => $dto->getName(),
                    'idAgency' => $dto->getIdAgency(),
                ];

                if (!$this->_validate($data)) {
                    throw new \Exception('Переданы некорректные данные при инициализации менеджера: ' . json_encode($this->errors()));
                }

                return true;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), $e->getCode(), $e);
            }
        }
    }