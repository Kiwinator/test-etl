<?php
    namespace app\models\estates\services;

    use app\models\estates\dto\EstateDTO;
    use app\models\estates\interfaces\EstateRepositoryInterface;
    
    class EstateServices {
        public function __construct(
            private EstateRepositoryInterface $repository
        ) {}

        /**
         * Создает новый лот недвижимости
         * @param EstateDTO $dto
         * @return EstateDTO
         * @throws \Exception
         */
        public function create(EstateDTO $dto): EstateDTO {
            return $this->repository->save($dto);
        }

        /**
         * Обновляет существующий лот недвижимости
         * @param EstateDTO $dto
         * @return EstateDTO
         * @throws \Exception
         */
        public function update(EstateDTO $dto): EstateDTO {
            return $this->repository->save($dto);
        }

        /**
         * Находит лоты недвижимости по заданным параметрам
         * @param array $params
         * @return array
         * @throws \Exception
         */
        public function find(array $params): array {
            return $this->repository->findBy($params);
        }
    }