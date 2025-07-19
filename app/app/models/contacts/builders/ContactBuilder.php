<?php
    namespace app\models\contacts\builders;
    
    use app\components\builders\Builder;
    use app\models\contacts\dto\ContactDTO;

    class ContactBuilder extends Builder
    {
        private ?int $id = null;
        private string $name;
        private string $phones;

        public function setId(?int $id): self {
            $this->id = $id;
            return $this;
        }

        public function setName(string $name): self {
            $this->name = $name;
            return $this;
        }

        public function setPhones(string $phones): self {
            $this->phones = $phones;
            return $this;
        }

        protected function getEntityClass(): string {
            return ContactDTO::class;
        }
    }