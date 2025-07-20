<?php
    namespace app\models\estates\services;

    use app\models\estates\dto\EstateDTO;
    use app\models\estates\interfaces\EstateRepositoryInterface;
    use app\components\services\Service;
    
    class EstateServices extends Service {
        public function __construct(EstateRepositoryInterface $repository) {
            parent::__construct($repository);
        }
    }