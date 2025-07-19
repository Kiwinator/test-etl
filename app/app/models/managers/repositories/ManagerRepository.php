<?php
    namespace app\models\managers\repositories;

    use app\models\managers\dto\ManagerDTO;
    use app\models\managers\interfaces\ManagerRepositoryInterface;
    use app\components\repositories\Repository;

    class ManagerRepository extends Repository implements ManagerRepositoryInterface
    {
        protected function getDtoClass(): string
        {
            return ManagerDTO::class;
        }

        protected function getTableName(): string
        {
            return 'managers';
        }

        /**
         * Возвращает таблицы для соединения
         * @return array
         */
        protected function getTableJoin(): array
        {
            return [
                [
                    'table' => 'agencies',
                    'alias' => 'a',
                    'on' => '`managers`.`idAgency` = `a`.`id`',
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
                'name' => '`managers`.`name`',
                'idAgency' => '`managers`.`idAgency`',
                'id' => '`managers`.`id`',
                'nameAgency' => '`a`.`name`',
            ];
        }
    }