<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Plan extends Entity
{
    private const INTERVAL_MONTHLY = 1;
    private const INTERVAL_QUARTERLY = 3;
    private const INTERVAL_SEMESTER = 6;
    private const INTERVAL_YEARLY = 12;

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'plan_id' => 'integer',
        'adverts' => '?integer',
        'is_highlighted' => 'boolean',
    ];

    public function setValue(string $value)
    {
        $this->attributes['value'] = str_replace(',', '', $value);
        return $this;
    }

    public function setAdverts(string $adverts)
    {
        $this->attributes['adverts'] = $adverts ? (int) $adverts : null;
        return $this;
    }

    public function setIsHighlighted(string $isHighlighted)
    {
        $this->attributes['is_highlighted'] = (bool) $isHighlighted;
        return $this;
    }
}
