<?php
    namespace app\models\estates\dto;

    use JsonSerializable;

    final readonly class EstateDTO implements JsonSerializable
    {
        public function __construct(
            public string $address,
            public int $price,
            public int $rooms,
            public int $floor,
            public int $houseFloors,
            public string $description,
            public int $idManager,
            public int $idContact,
            public string $originalId,
            public ?int $id = null,
            public ?string $nameManager = null,
            public ?string $nameContact = null
        ) {}

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getAddress(): string
        {
            return $this->address;
        }

        public function getPrice(): int
        {
            return $this->price;
        }

        public function getRooms(): int
        {
            return $this->rooms;
        }

        public function getFloor(): int
        {
            return $this->floor;
        }

        public function getHouseFloors(): int
        {
            return $this->houseFloors;
        }

        public function getDescription(): string
        {
            return $this->description;
        }

        public function getIdManager(): int
        {
            return $this->idManager;
        }

        public function getIdContact(): int
        {
            return $this->idContact;
        }

        public function getOriginalId(): string
        {
            return $this->originalId;
        }

        public function jsonSerialize(): array
        {
            return [
                'id' => $this->id,
                'address' => $this->address,
                'price' => $this->price,
                'rooms' => $this->rooms,
                'floor' => $this->floor,
                'houseFloors' => $this->houseFloors,
                'description' => $this->description,
                'idManager' => $this->idManager,
                'idContact' => $this->idContact,
                'originalId' => $this->originalId,
            ];
        }
    }