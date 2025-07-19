<?php
    namespace app\models\agencies\handlers;

    use app\models\agencies\services\AgencyServices;
    use app\models\agencies\dto\AgencyDTO;
    
    use app\modules\export\ExportServices;

    class AgencyExportHandler {
        public function __construct(
            private AgencyServices $services
        ) {}

        /**
         * Экспортирует агентства в XML формат
         * @param array $params
         * @return string
         * @throws \Throwable
         */
        public function handle(array $params=[]): string {
            try {
                $result = $this->services->find($params);

                $xmlString = ExportServices::ExportXML($result, 'agencies', 'agency');

                return $xmlString;
            } catch (\Throwable $e) {
                throw $e;
            }
        }

    }