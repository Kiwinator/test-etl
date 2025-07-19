<?php
    namespace app\modules\import\dto;

    use JsonSerializable;

    final readonly class ImportDTO implements JsonSerializable
    {
        public function __construct(
            public string $id,
            public string $agency,
            public string $manager,
            public string $contact,
            public string $phones,
            public int $price,
            public string $description,
            public string $address,
            public int $floor,
            public int $houseFloors,
            public int $rooms,
        ) {}

        public function getId(): string
        {
            return $this->id;
        }

        public function getAgency(): string
        {
            return $this->agency;
        }

        public function getManager(): string
        {
            return $this->manager;
        }

        public function getContact(): string
        {
            return $this->contact;
        }

        public function getPhones(): string
        {
            return $this->phones;
        }

        public function getPrice(): int
        {
            return $this->price;
        }

        public function getDescription(): string
        {
            return $this->description;
        }

        public function getAddress(): string
        {
            return $this->address;
        }

        public function getHouseFloors(): int
        {
            return $this->houseFloors;
        }

        public function getFloor(): int
        {
            return $this->floor;
        }

        public function getRooms(): int
        {
            return $this->rooms;
        }

        public function jsonSerialize(): array
        {
            return [
                'id' => $this->id,
                'agency' => $this->agency,
                'manager' => $this->manager,
                'contact' => $this->contact,
                'phones' => $this->phones,
                'price' => $this->price,
                'description' => $this->description,
                'address' => $this->address,
                'houseFloors' => $this->houseFloors,
                'floor' => $this->floor,
                'rooms' => $this->rooms,
            ];
        }
    }