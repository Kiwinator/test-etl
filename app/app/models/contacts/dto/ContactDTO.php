<?php
    namespace app\models\contacts\dto;

    use JsonSerializable;

    final readonly class ContactDTO implements JsonSerializable
    {
        public function __construct(
            public string $name,
            public string $phones,
            public ?int $id = null
        ) {}

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getPhones(): string
        {
            return $this->phones;
        }

        public function jsonSerialize(): array
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'phones' => $this->phones,
            ];
        }
    }