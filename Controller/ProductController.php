<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\StatsRepository;

class ProductController
{
	public function __construct(
		private readonly ProductRepository $productRepository,
		private readonly StatsRepository $statsRepository,
	)
	{
	}

	public function detail(string $id): string
	{
		$product = $this->productRepository->findById($id);
		$this->statsRepository->logVisit('product', $id);
		$this->sendJson($product);
	}
}