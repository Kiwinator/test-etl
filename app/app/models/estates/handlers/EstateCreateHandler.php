<?php
    namespace app\models\estates\handlers;

    use app\models\estates\services\EstateServices;
    use app\models\estates\builders\EstateBuilder;
    use app\models\estates\validators\EstateFormValidator;
    use app\models\estates\dto\EstateDTO;

    class EstateCreateHandler {
        public function __construct(
            private EstateServices $services,
            private EstateBuilder $builder,
            private EstateFormValidator $validator
        ) {}

        /**
         * Хэндлер создания нового лота недвижимости
         * @param array $data
         * @return EstateDTO
         * @throws \Exception
         */
        public function handle(array $data): EstateDTO {
            $this->builder
                ->setAddress($data['address'])
                ->setPrice($data['price'])
                ->setRooms($data['rooms'])
                ->setFloor($data['floor'])
                ->setHouseFloors($data['houseFloors'])
                ->setDescription($data['description'])
                ->setIdManager($data['idManager'])
                ->setIdContact($data['idContact'])
                ->setOriginalId($data['originalId'])
                ->setId(null);

            $dto = $this->builder->build();
            $this->validator->validate($dto);

            try {
                $estate = $this->services->create($dto);

                if (!$estate) {
                    throw new \Exception('Не удалось создать лот недвижимости');
                }

                return $estate;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }