<?php
    namespace app\modules\import\builders;
    
    use app\components\builders\Builder;
    use app\modules\import\dto\ImportDTO;

    class ImportBuilder extends Builder
    {
        private string $id;
        private string $agency;
        private string $manager;
        private string $contact;
        private string $phones;
        private int $price;
        private string $description;
        private string $address;
        private int $floor;
        private int $houseFloors;
        private int $rooms;

        public function setId(string $id): self {
            $this->id = $id;
            return $this;
        }

        public function setAgency(string $agency): self {
            $this->agency = $agency;
            return $this;
        }

        public function setManager(string $manager): self {
            $this->manager = $manager;
            return $this;
        }

        public function setContact(string $contact): self {
            $this->contact = $contact;
            return $this;
        }

        public function setPhones(string $phones): self {
            $this->phones = $phones;
            return $this;
        }

        public function setPrice(int $price): self {
            $this->price = $price;
            return $this;
        }

        public function setDescription(string $description): self {
            $this->description = $description;
            return $this;
        }

        public function setAddress(string $address): self {
            $this->address = $address;
            return $this;
        }

        public function setFloor(int $floor): self {
            $this->floor = $floor;
            return $this;
        }

        public function setHouseFloors(int $houseFloors): self {
            $this->houseFloors = $houseFloors;
            return $this;
        }

        public function setRooms(int $rooms): self {
            $this->rooms = $rooms;
            return $this;
        }

        protected function getEntityClass(): string {
            return ImportDTO::class;
        }
    }