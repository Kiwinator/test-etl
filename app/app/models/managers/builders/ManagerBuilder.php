<?php
    namespace app\models\managers\builders;
    
    use app\components\builders\Builder;
    use app\models\managers\dto\ManagerDTO;

    class ManagerBuilder extends Builder
    {
        private ?int $id = null;
        private ?string $nameAgency = null;
        private string $name;
        private int $idAgency;

        public function setId(?int $id): self {
            $this->id = $id;
            return $this;
        }

        public function setName(string $name): self {
            $this->name = $name;
            return $this;
        }

        public function setIdAgency(int $idAgency): self {
            $this->idAgency = $idAgency;
            return $this;
        }

        public function setNameAgency(?string $nameAgency): self {
            $this->nameAgency = $nameAgency;
            return $this;
        }

        protected function getEntityClass(): string {
            return ManagerDTO::class;
        }
    }