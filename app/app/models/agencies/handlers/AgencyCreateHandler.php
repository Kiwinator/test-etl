<?php
    namespace app\models\agencies\handlers;

    use app\models\agencies\services\AgencyServices;
    use app\models\agencies\builders\AgencyBuilder;
    use app\models\agencies\validators\AgencyFormValidator;
    use app\models\agencies\dto\AgencyDTO;

    class AgencyCreateHandler {
        public function __construct(
            private AgencyServices $services,
            private AgencyBuilder $builder,
            private AgencyFormValidator $validator
        ) {}

        /**
         * Хэндлер создания агентства
         * @param array $data
         * @return AgencyDTO
         * @throws \Exception
         */
        public function handle(array $data): AgencyDTO {
            $this->builder
                ->setName($data['name'])
                ->setId(null);

            $dto = $this->builder->build();
            $this->validator->validate($dto);

            try {
                $agency = $this->services->create($dto);

                if (!$agency) {
                    throw new \Exception('Не удалось создать агентство');
                }

                return $agency;
            } catch (\Throwable $e) {
                throw $e;
            }
        }
    }