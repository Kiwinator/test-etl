<?php
    namespace app\models\agencies\handlers;

    use app\models\agencies\services\AgencyServices;
    use app\models\agencies\builders\AgencyBuilder;
    use app\models\agencies\validators\AgencyFormValidator;
    use app\models\agencies\dto\AgencyDTO;

    class AgencyUpdateHandler {
        public function __construct(
            private AgencyServices $services,
            private AgencyBuilder $builder,
            private AgencyFormValidator $validator
        ) {}

        /**
         * Хэндлер обновления агентства
         * @param array $data
         * @return AgencyDTO
         * @throws \Exception
         */
        public function handle(array $data): AgencyDTO {
            $this->builder
                ->setName($data['name'])
                ->setId($data['id']);

            $dto = $this->builder->build();
            $this->validator->validate($dto);

            try {
                $agency = $this->services->update($dto);

                if (!$agency) {
                    throw new \Exception('Не удалось обновить агентство');
                }
                return $agency;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }