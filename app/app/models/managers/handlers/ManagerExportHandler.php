<?php
    namespace app\models\managers\handlers;

    use app\models\managers\services\ManagerServices;
    use app\models\managers\dto\ManagerDTO;
    
    use app\modules\export\ExportServices;

    class ManagerExportHandler {
        public function __construct(
            private ManagerServices $services
        ) {}

        /**
         * Экспортирует менеджеров в XML формат
         * @param array $params
         * @return string
         * @throws \Throwable
         */
        public function handle(array $params=[]): string {
            try {
                $result = $this->services->find($params);

                $xmlString = ExportServices::ExportXML($result, 'managers', 'manager');

                return $xmlString;
            } catch (\Throwable $e) {
                throw $e;
            }
        }

    }