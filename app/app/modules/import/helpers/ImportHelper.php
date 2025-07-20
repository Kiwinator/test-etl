<?php
    namespace app\modules\import\helpers;

    
    use app\modules\import\dto\ImportDTO;
    use app\modules\import\repositories\ImportRepository;

    use app\models\agencies\handlers\AgencyCreateHandler;
    use app\models\agencies\handlers\AgencyUpdateHandler;
    use app\models\agencies\services\AgencyServices;

    use app\models\contacts\handlers\ContactCreateHandler;
    use app\models\contacts\handlers\ContactUpdateHandler;
    use app\models\contacts\services\ContactServices;

    use app\models\managers\handlers\ManagerCreateHandler;
    use app\models\managers\handlers\ManagerUpdateHandler;
    use app\models\managers\services\ManagerServices;

    use app\models\estates\handlers\EstateCreateHandler;
    use app\models\estates\handlers\EstateUpdateHandler;
    use app\models\estates\services\EstateServices;

    class ImportHelper
    {
        public function __construct(
            private ImportRepository $repository,

            private AgencyServices $agencyServices,
            private AgencyCreateHandler $agencyCreateHandler,
            private AgencyUpdateHandler $agencyUpdateHandler,

            private ContactServices $contactServices,
            private ContactCreateHandler $contactCreateHandler,
            private ContactUpdateHandler $contactUpdateHandler,

            private ManagerServices $managerServices,
            private ManagerCreateHandler $managerCreateHandler,
            private ManagerUpdateHandler $managerUpdateHandler,

            private EstateServices $estateServices,
            private EstateCreateHandler $estateCreateHandler,
            private EstateUpdateHandler $estateUpdateHandler
        ) {}

        /**
         * Базовый метод импорта данных
         * @param ImportDTO $dto
         * @return bool
         * @throws \Exception
         */
        public function baseImport(ImportDTO $dto): bool
        {
            
            $this->repository->beginTransaction();
            try {
                
                $agency = $this->agencyServices->find(['name' => $dto->getAgency(), 'limit' => 1]);

                if (empty($agency)) {
                    $agency = $this->agencyCreateHandler->handle(['name' => $dto->getAgency()]);
                } else {
                    $agency = $this->agencyUpdateHandler->handle(['name' => $dto->getAgency(), 'id' => $agency[0]->getId()]);
                }

                if (!$agency) {
                    throw new \Exception('Не удалось импортировать данные агенства для ID: ' . $dto->getId());
                }

                $contact = $this->contactServices->find(['name' => $dto->getContact(), 'phones' => $dto->getPhones(), 'limit' => 1]);

                if (empty($contact)) {
                    $contact = $this->contactCreateHandler->handle(['name' => $dto->getContact(), 'phones' => $dto->getPhones()]);
                } else {
                    $contact = $this->contactUpdateHandler->handle(['name' => $dto->getContact(), 'phones' => $dto->getPhones(), 'id' => $contact[0]->getId()]);
                }

                if (!$contact) {
                    throw new \Exception('Не удалось импортировать данные контакта для ID: ' . $dto->getId());
                }

                $manager = $this->managerServices->find(['name' => $dto->getManager(), 'idAgency' => $agency->getId(), 'limit' => 1]);
                if (empty($manager)) {
                    $manager = $this->managerCreateHandler->handle(['name' => $dto->getManager(), 'idAgency' => $agency->getId()]);
                } else {
                    $manager = $this->managerUpdateHandler->handle(['name' => $dto->getManager(), 'idAgency' => $agency->getId(), 'id' => $manager[0]->getId()]);
                }

                if (!$manager) {
                    throw new \Exception('Не удалось импортировать данные менеджера для ID: ' . $dto->getId());
                }
                
                $estate = $this->estateServices->find(['originalId' => $dto->getId(), 'limit' => 1]);

                if (empty($estate)) {
                    $estate = $this->estateCreateHandler->handle([
                            'address' => $dto->getAddress(),
                            'price' => $dto->getPrice(),
                            'rooms' => $dto->getRooms(),
                            'floor' => $dto->getFloor(),
                            'houseFloors' => $dto->getHouseFloors(),
                            'description' => $dto->getDescription(),
                            'idManager' => $manager->getId(),
                            'idContact' => $contact->getId(),
                            'originalId' => $dto->getId()
                        ]);
                } else {
                    $estate = $this->estateUpdateHandler->handle([
                        'address' => $dto->getAddress(),
                        'price' => $dto->getPrice(),
                        'rooms' => $dto->getRooms(),
                        'floor' => $dto->getFloor(),
                        'houseFloors' => $dto->getHouseFloors(),
                        'description' => $dto->getDescription(),
                        'idManager' => $manager->getId(),
                        'idContact' => $contact->getId(),
                        'originalId' => $dto->getId(),
                        'id' => $estate[0]->getId()
                    ], $estate[0]->getId());
                }

                if (!$estate) {
                    throw new \Exception('Не удалось импортировать данные лота недвижимости для ID: ' . $dto->getId());
                }

                $this->repository->commit();
                return true; 
            } catch (\Exception $e) {
                $this->repository->rollBack();
                throw $e;
            }
        }
    }