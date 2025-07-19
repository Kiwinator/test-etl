<?php
    namespace app\models\estates\handlers;

    use app\models\estates\services\EstateServices;
    use app\models\estates\dto\EstateDTO;
    
    use app\modules\export\ExportServices;

    class EstateExportHandler {
        public function __construct(
            private EstateServices $services
        ) {}

        /**
         * Экспортирует лоты недвижимости в XML формат
         * @param array $params
         * @return string
         * @throws \Throwable
         */
        public function handle(array $params=[]): string {
            try {
                $result = $this->services->find($params);

                $xmlString = ExportServices::ExportXML($result, 'estates', 'estate');

                return $xmlString;
            } catch (\Throwable $e) {
                throw $e;
            }
        }

    }