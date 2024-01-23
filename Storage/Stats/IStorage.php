<?php

namespace App\Storage\Stats;

interface IStorage
{

	public function save(string $objectType, string $objectId);
}