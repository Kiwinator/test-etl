<?php
    namespace app\models\estates\handlers;

    use app\models\estates\services\EstateServices;
    use app\models\estates\builders\EstateBuilder;
    use app\models\estates\validators\EstateFormValidator;
    use app\models\estates\dto\EstateDTO;

    class EstateUpdateHandler {
        public function __construct(
            private EstateServices $services,
            private EstateBuilder $builder,
            private EstateFormValidator $validator
        ) {}

        /**
         * Хэндлер обновления существующего лота недвижимости
         * @param array $data
         * @return EstateDTO
         * @throws \Exception
         */
        public function handle(array $data): EstateDTO {
            $this->builder
                ->setId($data['id'])
                ->setAddress($data['address'])
                ->setPrice($data['price'])
                ->setRooms($data['rooms'])
                ->setFloor($data['floor'])
                ->setHouseFloors($data['houseFloors'])
                ->setDescription($data['description'])
                ->setIdManager($data['idManager'])
                ->setIdContact($data['idContact'])
                ->setOriginalId($data['originalId']);

            $dto = $this->builder->build();
            $this->validator->validate($dto);

            try {
                $estate = $this->services->update($dto);

                if (!$estate) {
                    throw new \Exception('Не удалось обновить лот недвижимости');
                }

                return $estate;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }