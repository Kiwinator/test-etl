<?php
    namespace app\components\builders;

    abstract class Builder
    {
        /**
         * Возвращает имя класса сущности для сборки.
         */
        abstract protected function getEntityClass(): string;

        /**
         * Собирает объект сущности, используя значения публичных/приватных свойств билдера и рефлексию.
         */
        public function build()
        {
            $class = $this->getEntityClass();
            $reflection = new \ReflectionClass($class);
            $props = [];
            $reflectionObject = new \ReflectionObject($this);
            foreach ($reflectionObject->getProperties() as $property) {
                $property->setAccessible(true);
                $props[$property->getName()] = $property->getValue($this);
            }

            $constructor = $reflection->getConstructor();
            $args = [];
            
            if ($constructor) {
                foreach ($constructor->getParameters() as $param) {
                    $name = $param->getName();
                    if (array_key_exists($name, $props)) {
                        $args[] = $props[$name];
                    } elseif ($param->isDefaultValueAvailable()) {
                        $args[] = $param->getDefaultValue();
                    } elseif ($param->allowsNull()) {
                        $args[] = null;
                    } else {
                        throw new \RuntimeException("Missing value for constructor parameter: \${$name}");
                    }
                }
            }

            return $reflection->newInstanceArgs($args);
        }
    }