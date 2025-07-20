<?php
    namespace app\models\contacts\services;

    use app\models\contacts\dto\ContactDTO;
    use app\models\contacts\interfaces\ContactRepositoryInterface;
    use app\components\services\Service;
    
    class ContactServices extends Service {
        public function __construct(ContactRepositoryInterface $repository)
        {
            parent::__construct($repository);
        }
    }