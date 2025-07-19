<?php
    namespace app\models\estates\validators;

    use app\components\validators\Validator;

    class EstateFormValidator extends Validator
    {
        public function __construct()
        {
            $this->rules = [
                'address' => [
                    $this->notEmpty(),
                ],
                'price' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'rooms' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'floor' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'houseFloors' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'description' => [
                    $this->notEmpty(),
                ],
                'idManager' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
                'idContact' => [
                    $this->notEmpty(),
                    $this->isNumber(),
                ],
            ];
        }

        public function validate($dto): bool
        {
            try {
                $data = [
                    'address' => $dto->getAddress(),
                    'price' => $dto->getPrice(),
                    'rooms' => $dto->getRooms(),
                    'floor' => $dto->getFloor(),
                    'houseFloors' => $dto->getHouseFloors(),
                    'description' => $dto->getDescription(),
                    'idManager' => $dto->getIdManager(),
                    'idContact' => $dto->getIdContact(),
                ];

                if (!$this->_validate($data)) {
                    throw new \Exception('Переданы некорректные данные при инициализации лота недвижимости ' . json_encode($this->errors()));
                }

                return true;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), $e->getCode(), $e);
            }
        }
    }