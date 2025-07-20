<?php
    namespace app\modules\import\repositories;

    use app\components\repositories\Repository;
    
    class ImportRepository extends Repository
    {
        protected function getDtoClass(): string
        {
            return \stdClass::class;
        }

        protected function getTableName(): string
        {
            return '';
        }

        protected function getTableJoin(): array
        {
            return [];
        }

        protected function getTableFields(): array
        {
            return [];
        }
    }