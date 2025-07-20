<?php
    namespace app\components\repositories;

    use app\configs\Db;
    use PDO;

    abstract class Repository
    {
        protected PDO $pdo;
        protected string $table;

        public function __construct()
        {
            $db = new Db();
            
            $this->pdo = $db->getConnection();
        }        

        public function beginTransaction(): void
        {
            $this->pdo->beginTransaction();
        }

        public function commit(): void
        {
            $this->pdo->commit();
        }

        public function rollBack(): void
        {
            $this->pdo->rollBack();
        }

        abstract protected function getDtoClass(): string;
        abstract protected function getTableName(): string;
        abstract protected function getTableJoin(): array;
        abstract protected function getTableFields(): array;

        // Сохраняет DTO в базу данных
        // Если id не указан, то создаёт новую запись, иначе обновляет существующую
        // Возвращает DTO с обновлённым id
        public function save(object $dto): object
        {
            $class = $this->getDtoClass();
            $reflection = new \ReflectionClass($class);
            $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

            $data = [];

            foreach ($properties as $property) {
                $data[$property->getName()] = $property->getValue($dto);
            }

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });

            $id = $data['id'] ?? null;
            unset($data['id']);

            $columns = array_keys($data);

            if ($id === null) {
                $placeholders = array_map(fn($col) => ":$col", $columns);
                $query = sprintf(
                    'INSERT INTO %s (%s) VALUES (%s)',
                    $this->getTableName(),
                    implode(', ', $columns),
                    implode(', ', $placeholders)
                );
            } else {
                $updates = array_map(fn($col) => "$col = :$col", $columns);
                $query = sprintf(
                    'UPDATE %s SET %s WHERE id = :id',
                    $this->getTableName(),
                    implode(', ', $updates)
                );
                
                $data['id'] = $id;
            }

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);

            if ($id === null) {
                $id = (int)$this->pdo->lastInsertId();
                $data['id'] = $id;
            }
                

            return new $class(...array_values($data));
        }

        // Находит DTO по параметрам
        // Параметры могут быть любыми полями DTO
        public function findBy(array $params): array
        {
            $class = $this->getDtoClass();
            $reflection = new \ReflectionClass($class);
            $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
            $columns = array_map(fn($property) => $property->getName(), $properties);

            $conditions = [];
            $queryParams = [];
            foreach ($params as $field => $value) {
                if (in_array($field, $columns)) {
                    $conditions[] = "`$field` like :$field";
                    $queryParams[$field] = "%$value%";
                }
            }

            $limit = $params['limit'] ?? 100;

            $fields = $this->getTableFields();
            if (!empty($fields)) {
                $select = array_map(
                    fn($key, $value) => "$value as $key",
                    array_keys($fields),
                    $fields
                );
            } else {
                $select = ['*'];
            }

            $join = '';

            if (!empty($this->getTableJoin())) {
                foreach ($this->getTableJoin() as $tableJoin) {
                    $join .= ' LEFT JOIN ' . $tableJoin['table'] . ' as ' . $tableJoin['alias'] . ' ON ' . $tableJoin['on'];
                }
            }

            $condition = empty($conditions) ? '' : 'WHERE ' . implode(' AND ', $conditions);
            
            $query = sprintf(
                'SELECT %s FROM (SELECT %s FROM %s %s ) tbl %s LIMIT %d',
                implode(', ', array_keys($fields)),
                implode(', ', $select),
                $this->getTableName(),
                $join,
                $condition,
                $limit
            );

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($queryParams);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            
            foreach ($rows as $data) {
                $result[] = new $class(...array_values($data));
            }

            return $result;
        }
    }