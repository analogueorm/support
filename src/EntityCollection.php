<?php

namespace Analogue\Support;

use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

abstract class EntityCollection extends Collection {
	
	/**
	 * Get the max value of a given key.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function max($key = null)
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
	public function min($key = null)
	{
		return $this->reduce(function($result, $item) use ($key)
		{
			return (is_null($result) || $item->getEntityAttribute($key) < $result) 
				? $item->getEntityAttribute($key) : $result;
		});
	}

	/**
     * Get an array with the values of a given key.
     *
     * @param  string  $value
     * @param  string  $key
     * @return static
     */
    public function pluck($value, $key = null)
    {
        return new Collection(Arr::pluck($this->items, $value, $key));
    }

	/**
	 * Return only unique items from the collection.
	 *
	 * @return static
	 */
	public function unique($key = null)
	{
		$dictionary = $this->getDictionary();

		return new static(array_values($dictionary));
	}

}
