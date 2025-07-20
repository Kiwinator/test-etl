<?php
    namespace app\components\services;

    use app\components\repositories\Repository;

    abstract class Service
    {
        protected Repository $repository;

        public function __construct(Repository $repository)
        {
            $this->repository = $repository;
        }

        /**
         * Создает новую сущность
         * @param object $dto
         * @return object
         * @throws \Exception
         */
        public function create(object $dto): object
        {
            return $this->repository->save($dto);
        }

        /**
         * Обновляет существующую сущность
         * @param object $dto
         * @return object
         * @throws \Exception
         */
        public function update(object $dto): object
        {
            return $this->repository->save($dto);
        }

        /**
         * Находит сущности по заданным параметрам
         * @param array $params
         * @return array
         * @throws \Exception
         */
        public function find(array $params): array
        {
            return $this->repository->findBy($params);
        }
    }