<?php

namespace Tddbc;

class Strawberry
{
    /**
     * @var Size
     */
    private $size;

    /**
     * @var Brand
     */
    private $brand;

    /**
     * @var int
     */
    private $weight;

    private function __construct(Brand $brand, Size $size)
    {
        $this->brand = $brand;
        $this->size = $size;
    }

    public static function constructWithWeight(string $brandName, int $weight)
    {
        $size = "";
        if ($weight < 1) {
            throw new \InvalidArgumentException('重さは1g未満ではいけません');
        } else if ($weight < 10) {
            $size = Size::S();
        } else if ($weight < 20) {
            $size = Size::M();
        } else if ($weight < 25) {
            $size = Size::L();
        } else if ($weight >= 25) {
            $size = Size::LL();
        } else {
            // skip coverage
            assert(false, 'cannot be here');
            // throw new \LogicException('cannot be here');
        }
        $strawberry = new self(new Brand($brandName), $size);
        $strawberry->weight = $weight;

        return $strawberry;
    }

    public function getSize()
    {
        return $this->size->value();
    }

    public function getBrand()
    {
        return $this->brand->value();
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function toString()
    {
        return "{$this->brand}: {$this->size}";
    }
}
