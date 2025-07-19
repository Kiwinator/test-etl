<?php
    namespace app\models\estates\builders;
    
    use app\components\builders\Builder;
    use app\models\estates\dto\EstateDTO;

    class EstateBuilder extends Builder
    {
        private ?int $id = null;
        private ?string $nameManager = null;
        private ?string $nameContact = null;
        private string $address;
        private int $price;
        private int $rooms;
        private int $floor;
        private int $houseFloors;
        private string $description;
        private int $idManager;
        private int $idContact;
        private string $originalId;

        public function setId(?int $id): self {
            $this->id = $id;
            return $this;
        }

        public function setAddress(string $address): self {
            $this->address = $address;
            return $this;
        }

        public function setPrice(int $price): self {
            $this->price = $price;
            return $this;
        }

        public function setRooms(int $rooms): self {
            $this->rooms = $rooms;
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

        public function setDescription(string $description): self {
            $this->description = $description;
            return $this;
        }

        public function setIdManager(int $idManager): self {
            $this->idManager = $idManager;
            return $this;
        }

        public function setIdContact(int $idContact): self {
            $this->idContact = $idContact;
            return $this;
        }

        public function setOriginalId(string $originalId): self {
            $this->originalId = $originalId;
            return $this;
        }

        public function setNameManager(string $nameManager): self {
            $this->nameManager = $nameManager;
            return $this;
        }
        public function setNameContact(string $nameContact): self {
            $this->nameContact = $nameContact;
            return $this;
        }

        protected function getEntityClass(): string {
            return EstateDTO::class;
        }
    }