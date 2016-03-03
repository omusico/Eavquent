<?php

namespace Devio\Eavquent;

use Devio\Eavquent\Entity\EntityBootingScope;

trait Eavquent
{
    protected $attributeRelationsBooted = false;

    protected $attributeRelations = [];

    /**
     * Booting the trait.
     */
    public static function bootEntityAttributeValues()
    {
        static::addGlobalScope(new EntityBootingScope);
    }

    /**
     *
     */
    public function bootAttributeRelations()
    {
    }

    /**
     * Dynamically pipe calls to attribute relations.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
//        $this->bootAttributeRelations();

        if (isset($this->attributeRelations[$method])) {
            return call_user_func_array($this->attributeRelations[$method], $parameters);
        }

        return parent::__call($method, $parameters);
    }
}