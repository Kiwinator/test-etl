<?php
    namespace app\models\managers\services;

    use app\models\managers\dto\ManagerDTO;
    use app\models\managers\interfaces\ManagerRepositoryInterface;
    
    class ManagerServices {
        public function __construct(
            private ManagerRepositoryInterface $repository
        ) {}

        public function create(ManagerDTO $dto): ManagerDTO {
            return $this->repository->save($dto);
        }

        public function update(ManagerDTO $dto): ManagerDTO {
            return $this->repository->save($dto);
        }

        public function find(array $params): array {
            return $this->repository->findBy($params);
        }
    }