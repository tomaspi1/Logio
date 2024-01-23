<?php

namespace App\Storage\Stats;

class PlainTextStorage implements IStorage
{
	/*
	private readonly string $fileName;

	public function __construct(
		 string $fileName,
	)
	{
		$this->fileName = $fileName;
	}
*/
	public function __construct(
		private readonly string $fileName,
	)
	{
	}


	public function save(string $objectType, string $objectId): void
	{
		$stats = $this->readAll();

		$counter = $stats[$objectType][$objectId] ?? 0;
		$stats[$objectType][$objectId] = $counter + 1;

		$this->saveAll($stats);

//		file_put_contents(
//			$this->fileName,
//			"$objectType\t$objectId",
//			FILE_APPEND
//		);
	}

	private function readAll(): array
	{
		$serialized = file_get_contents($this->fileName);
		return json_decode($serialized);
	}

	private function saveAll(array $stats): void
	{
		$serialized = json_encode($stats);
		file_put_contents($this->fileName, $serialized);
	}
}