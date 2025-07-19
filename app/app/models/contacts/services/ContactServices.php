<?php
    namespace app\models\contacts\services;

    use app\models\contacts\dto\ContactDTO;
    use app\models\contacts\interfaces\ContactRepositoryInterface;
    
    class ContactServices {
        public function __construct(
            private ContactRepositoryInterface $repository
        ) {}

        /**
         * Создает новый контакт
         * @param ContactDTO $dto
         * @return ContactDTO
         * @throws \Exception
         */
        public function create(ContactDTO $dto): ContactDTO {
            return $this->repository->save($dto);
        }


        /**
         * Обновляет существующий контакт
         * @param ContactDTO $dto
         * @return ContactDTO
         * @throws \Exception
         */
        public function update(ContactDTO $dto): ContactDTO {
            return $this->repository->save($dto);
        }

        /**
         * Находит контакты по заданным параметрам
         * @param array $params
         * @return array
         * @throws \Exception
         */
        public function find(array $params): array {
            return $this->repository->findBy($params);
        }
    }