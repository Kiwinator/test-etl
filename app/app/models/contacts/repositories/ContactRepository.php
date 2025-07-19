<?php
    namespace app\models\contacts\repositories;

    use app\models\contacts\dto\ContactDTO;
    use app\models\contacts\interfaces\ContactRepositoryInterface;
    use app\components\repositories\Repository;

    class ContactRepository extends Repository implements ContactRepositoryInterface
    {
        protected function getDtoClass(): string
        {
            return ContactDTO::class;
        }

        protected function getTableName(): string
        {
            return 'contacts';
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
                'name' => '`contacts`.`name`',
                'phones' => '`contacts`.`phones`',
                'id' => '`contacts`.`id`',
            ];
        }
    }