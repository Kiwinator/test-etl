<?php
    namespace app\models\managers\services;

    use app\models\managers\dto\ManagerDTO;
    use app\models\managers\interfaces\ManagerRepositoryInterface;
    use app\components\services\Service;
    
    class ManagerServices extends Service {
        public function __construct(ManagerRepositoryInterface $repository) {
            parent::__construct($repository);
        }
    }