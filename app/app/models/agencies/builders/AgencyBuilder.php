<?php
    namespace app\models\agencies\builders;
    
    use app\components\builders\Builder;
    use app\models\agencies\dto\AgencyDTO;

    class AgencyBuilder extends Builder
    {
        private ?int $id = null;
        private string $name;

        public function setId(?int $id): self {
            $this->id = $id;
            return $this;
        }

        public function setName(string $name): self {
            $this->name = $name;
            return $this;
        }

        protected function getEntityClass(): string {
            return AgencyDTO::class;
        }
    }