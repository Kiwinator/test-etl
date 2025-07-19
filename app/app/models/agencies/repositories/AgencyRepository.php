<?php
    namespace app\models\agencies\repositories;

    use app\models\agencies\dto\AgencyDTO;
    use app\models\agencies\interfaces\AgencyRepositoryInterface;
    use app\components\repositories\Repository;

    class AgencyRepository extends Repository implements AgencyRepositoryInterface
    {
        protected function getDtoClass(): string
        {
            return AgencyDTO::class;
        }

        protected function getTableName(): string
        {
            return 'agencies';
        }

        protected function getTableJoin(): array
        {
            return [];
        }

        /*
         * Возвращает поля таблицы для выборки
         * @return array
         */
        protected function getTableFields(): array
        {
            return [
                'name' => '`agencies`.`name`',
                'id' => '`agencies`.`id`',
            ];
        }
    }