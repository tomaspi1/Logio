<?php
declare(strict_types=1);

namespace App\Repository;
use App\Storage\Stats\IStorage;

class StatsRepository
{
	public function __construct(
		private readonly IStorage $storage,
	)
	{
	}

	public function logVisit(string $objectType, string $objectId): void
	{
		$this->storage->save($objectType, $objectId);
	}
}