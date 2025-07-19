<?php
    namespace app\models\estates\repositories;

    use app\models\estates\dto\EstateDTO;
    use app\models\estates\interfaces\EstateRepositoryInterface;
    use app\components\repositories\Repository;

    class EstateRepository extends Repository implements EstateRepositoryInterface
    {
        protected function getDtoClass(): string
        {
            return EstateDTO::class;
        }

        protected function getTableName(): string
        {
            return 'estates';
        }

        /**
         * Возвращает таблицы для соединения
         * @return array
         */
        protected function getTableJoin(): array
        {
            return [
                [
                    'table' => '`managers`',
                    'alias' => 'm',
                    'on' => '`estates`.`idManager` = `m`.`id`',
                ],
                [
                    'table' => '`contacts`',
                    'alias' => 'c',
                    'on' => '`estates`.`idContact` = `c`.`id`',
                ],
            ];
        }

        /*
         * Возвращает поля таблицы для выборки
         * @return array
         */
        protected function getTableFields(): array
        {
            return [
                'address' => '`estates`.`address`',
                'price' => '`estates`.`price`',
                'rooms' => '`estates`.`rooms`',
                'floor' => '`estates`.`floor`',
                'houseFloors' => '`estates`.`houseFloors`',
                'description' => '`estates`.`description`',                
                'idManager' => '`estates`.`idManager`',
                'idContact' => '`estates`.`idContact`',
                'originalId' => '`estates`.`originalId`',
                'id' => '`estates`.`id`',
                'nameManager' => '`m`.`name`',
                'nameContact' => '`c`.`name`',
            ];
        }
    }