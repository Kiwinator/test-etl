<?php
    namespace app\modules\import\validators;

    use app\components\validators\Validator;

    class ImportFormValidator extends Validator
    {
        public function __construct()
        {
            $this->rules = [
                'id' => [
                    $this->notEmpty(),
                ],
                'agency' => [
                    $this->notEmpty(),
                ],
                'manager' => [
                    $this->notEmpty(),
                ],
                'contact' => [
                    $this->notEmpty(),
                ],
                'phones' => [
                    $this->notEmpty(),
                ],
                'price' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'description' => [
                    $this->notEmpty(),
                ],
                'address' => [
                    $this->notEmpty(),
                ],
                'floor' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'houseFloors' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'rooms' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
            ];
        }

        public function validate($dto): bool
        {
            try {
                $data = [
                    'id' => $dto->getId(),
                    'agency' => $dto->getAgency(),
                    'manager' => $dto->getManager(),
                    'contact' => $dto->getContact(),
                    'phones' => $dto->getPhones(),
                    'price' => $dto->getPrice(),
                    'description' => $dto->getDescription(),
                    'address' => $dto->getAddress(),
                    'floor' => $dto->getFloor(),
                    'houseFloors' => $dto->getHouseFloors(),
                    'rooms' => $dto->getRooms(),
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