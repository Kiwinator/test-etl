<?php
    namespace app\models\agencies\dto;

    use JsonSerializable;

    final readonly class AgencyDTO implements JsonSerializable
    {
        public function __construct(
            public string $name,
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

        public function jsonSerialize(): array
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
            ];
        }
    }