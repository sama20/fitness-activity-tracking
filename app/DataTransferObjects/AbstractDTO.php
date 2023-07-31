<?php

namespace App\DataTransferObjects;

use App\Contracts\IDataTransferObject;
use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractDTO implements IDataTransferObject, Arrayable
{
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        foreach ($properties as $key => $value) {
            if ($value !== null) {
                return $properties;
            }
        }

        return [];
    }
}
