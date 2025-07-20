<?php
    namespace app\models\agencies\services;

    use app\models\agencies\dto\AgencyDTO;
    use app\models\agencies\interfaces\AgencyRepositoryInterface;
    use app\components\services\Service;
    
    class AgencyServices extends Service {
        public function __construct(AgencyRepositoryInterface $repository)
        {
            parent::__construct($repository);
        }
    }