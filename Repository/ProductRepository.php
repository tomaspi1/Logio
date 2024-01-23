<?php
declare(strict_types=1);

namespace App\Repository;

use App\Storage\Cache\ICache;

class ProductRepository
{

	public function __construct(
		private readonly bool                 $useElastic,
		private readonly IElasticSearchDriver $elasticDriver,
		private readonly IMySQLDriver         $mysqlDriver,
		private readonly ICache               $cache
	)
	{
	}


	public function findById(string $id): array
	{
		$cacheKey = "product_$id";
		$product = $this->cache->read($cacheKey);

		if ($product !== null) {
			return $product;
		}

		if ($this->useElastic) {
			$product = $this->elasticDriver->findById($id);
		} else {
			$product = $this->mysqlDriver->findProduct($id);
		}

		$this->cache->write($cacheKey, $product);

		return $product;
	}
}