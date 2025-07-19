<?php
    namespace app\models\contacts\handlers;

    use app\models\contacts\services\ContactServices;
    use app\models\contacts\dto\ContactDTO;
    
    use app\modules\export\ExportServices;

    class ContactExportHandler {
        public function __construct(
            private ContactServices $services
        ) {}

        /**
         * Экспортирует контакты в XML формат
         * @param array $params
         * @return string
         * @throws \Throwable
         */
        public function handle(array $params=[]): string {
            try {
                $result = $this->services->find($params);

                $xmlString = ExportServices::ExportXML($result, 'contacts', 'contact');

                return $xmlString;
            } catch (\Throwable $e) {
                throw $e;
            }
        }

    }