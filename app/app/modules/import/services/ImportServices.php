<?php
    namespace app\modules\import\services;

    use PhpOffice\PhpSpreadsheet\IOFactory;

    class ImportServices {
        /**
         * Читает данные из файла
         * @param string $fileName
         * @return array
         * @throws \Exception
         */
        public function readFile($fileName): array {
            $filePath = dirname(__DIR__, 3) . '/files/' . $fileName;
            if (!file_exists($filePath)) {
                throw new \Exception("Указанный файл не существует: " . $filePath);
            }
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            if (!$sheet) {
                throw new \Exception("Не удалось загрузить данные из файла: " . $filePath);
            }
            return $sheet->toArray();
        }

        /**
         * Преобразует данные из файла в нужный формат
         * @param array $data
         * @return array
         */
        public function reformFile(array $data): array {
            $result = [];

            foreach ($data as $key => $item){
                $price = str_ireplace(' ', '', trim($item[5]));
                if (empty($price) || !is_numeric($price)) {
                    continue;
                }

                $floor = str_ireplace(' ', '', trim($item[8]));
                if (empty($floor) || !is_numeric($floor)) {
                    continue;
                }

                $houseFloors = str_ireplace(' ', '', trim($item[9]));
                if (empty($houseFloors) || !is_numeric($houseFloors)) {
                    continue;
                }

                $rooms = str_ireplace(' ', '', trim($item[10]));
                if (empty($rooms) || !is_numeric($rooms)) {
                    continue;
                }
                

                $result[$key]['id'] = trim($item[0]);
                $result[$key]['agency'] = trim($item[1]);
                $result[$key]['manager'] = trim($item[2]);
                $result[$key]['contact'] = trim($item[3]);
                $result[$key]['phones'] = trim($item[4]);
                $result[$key]['price'] = (int)$price;
                $result[$key]['description'] = trim($item[6]);
                $result[$key]['address'] = trim($item[7]);
                $result[$key]['floor'] = (int)$floor;
                $result[$key]['houseFloors'] = (int)$houseFloors;
                $result[$key]['rooms'] = (int)$rooms;
            }

            return $result;
        }
    }