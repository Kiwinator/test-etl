<?php
    namespace app\models\managers\handlers;

    use app\models\managers\services\ManagerServices;
    use app\models\managers\builders\ManagerBuilder;
    use app\models\managers\validators\ManagerFormValidator;
    use app\models\managers\dto\ManagerDTO;

    class ManagerUpdateHandler {
        public function __construct(
            private ManagerServices $services,
            private ManagerBuilder $builder,
            private ManagerFormValidator $validator
        ) {}

        /**
         * Хэндлер обновления менеджера
         * @param array $data
         * @return ManagerDTO
         * @throws \Exception
         */
        public function handle(array $data): ManagerDTO {
            $this->builder
                ->setId($data['id'])
                ->setName($data['name'])
                ->setIdAgency($data['idAgency']);

            $dto = $this->builder->build();
            $this->validator->validate($dto);

            try {
                $manager = $this->services->update($dto);

                if (!$manager) {
                    throw new \Exception('Не удалось обновить менеджера');
                }

                return $manager;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }