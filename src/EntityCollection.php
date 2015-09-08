<?php

namespace Analogue\Support;

use InvalidArgumentException;
use Illuminate\Support\Collection;

abstract class EntityCollection extends Collection {
	
	/**
	 * Get the max value of a given key.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function max($key)
	{
		return $this->reduce(function($result, $item) use ($key)
		{
			return (is_null($result) || $item->getEntityAttribute($key) > $result) ? 
				$item->getEntityAttribute($key) : $result;
		});
	}

	/**
	 * Get the min value of a given key.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function min($key)
	{
		return $this->reduce(function($result, $item) use ($key)
		{
			return (is_null($result) || $item->getEntityAttribute($key) < $result) 
				? $item->getEntityAttribute($key) : $result;
		});
	}

	/**
	 * Return only unique items from the collection.
	 *
	 * @return static
	 */
	public function unique()
	{
		$dictionary = $this->getDictionary();

		return new static(array_values($dictionary));
	}

}
