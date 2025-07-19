<?php
    namespace app\modules\import\handlers;

    use app\modules\import\services\ImportServices;
    use app\modules\import\builders\ImportBuilder;
    use app\modules\import\helpers\ImportHelper;
    use app\modules\import\validators\ImportFormValidator;

    class ImportHandler {
        public function __construct(
            private ImportServices $services,
            private ImportBuilder $builder,
            private ImportHelper $helper,
            private ImportFormValidator $validator,
        ) {}

        /**
         * Хэндлер импорта данных из файла
         * @param string $fileName
         * @return mixed
         * @throws \Exception
         */
        public function handle(string $fileName): mixed {

            try {
                $data = $this->services->readFile($fileName);

                if (empty($data)) {
                    throw new \Exception('Файл не содержит данных');
                }

                $reformedData = $this->services->reformFile($data);

                if (empty($reformedData)) {
                    throw new \Exception('Файл не содержит корректных данных');
                }

                foreach ($reformedData as $item) {
                    $this->builder
                        ->setId($item['id'])
                        ->setAgency($item['agency'])
                        ->setManager($item['manager'])
                        ->setContact($item['contact'])
                        ->setPhones($item['phones'])
                        ->setPrice($item['price'])
                        ->setDescription($item['description'])
                        ->setAddress($item['address'])
                        ->setFloor($item['floor'])
                        ->setHouseFloors($item['houseFloors'])
                        ->setRooms($item['rooms']);
                        
                    $dto = $this->builder->build();
                    $this->validator->validate($dto);
                    
                    $import = $this->helper->baseImport($dto);

                    if (!$import) {
                        throw new \Exception('Не удалось импортировать данные для ID: ' . $item['id']);
                    }
                }

                return 'Импортированно ' . count($reformedData) . ' записей из файла ' . count($data) . ' ' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8');
            } catch (\Throwable $e) {
                throw $e;
            }
        }

    }