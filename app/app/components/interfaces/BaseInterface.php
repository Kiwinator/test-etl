<?php
    namespace app\components\interfaces;

    interface BaseInterface
    {
        public function save(object $dto): object;
        public function findBy(array $params): array;
    }