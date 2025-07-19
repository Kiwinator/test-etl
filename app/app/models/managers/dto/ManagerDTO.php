<?php
    namespace app\models\managers\dto;

    use JsonSerializable;

    final readonly class ManagerDTO implements JsonSerializable
    {
        public function __construct(
            public string $name,
            public string $idAgency,
            public ?int $id = null,
            public ?string $nameAgency = null
        ) {}

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getIdAgency(): int
        {
            return $this->idAgency;
        }

        public function jsonSerialize(): array
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'idAgency' => $this->idAgency,
            ];
        }
    }