<?php
    namespace app\models\agencies\services;

    use app\models\agencies\dto\AgencyDTO;
    use app\models\agencies\interfaces\AgencyRepositoryInterface;
    
    class AgencyServices {
        public function __construct(
            private AgencyRepositoryInterface $repository
        ) {}

        /**
         * Создает новый агентство
         * @param AgencyDTO $dto
         * @return AgencyDTO
         * @throws \Exception
         */
        public function create(AgencyDTO $dto): AgencyDTO {
            return $this->repository->save($dto);
        }

        /**
         * Обновляет существующее агентство
         * @param AgencyDTO $dto
         * @return AgencyDTO
         * @throws \Exception
         */
        public function update(AgencyDTO $dto): AgencyDTO {
            return $this->repository->save($dto);
        }

        /**
         * Находит агентства по заданным параметрам
         * @param array $params
         * @return array
         * @throws \Exception
         */
        public function find(array $params): array {
            return $this->repository->findBy($params);
        }
    }