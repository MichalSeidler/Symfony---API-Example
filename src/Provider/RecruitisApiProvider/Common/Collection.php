<?php
namespace App\Provider\RecruitisApiProvider\Common;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Throwable;
use InvalidArgumentException;

final class Collection implements ArrayAccess, IteratorAggregate {
	private array $container = [];

	/**
	 * Total records in API
	 */
	public int $total = 0;
    
	/**
	 * @param array $data
	 * @return Collection
	 * @throws InvalidArgumentException
	 */
	static function populate(string $class, array $data): Collection {
		try {
			$collection = new Collection;
			foreach($data['payload'] as $item){
				$collection[] = $class::populate($item);
			}
			$collection->total = $data['meta']['entries_total'];

			return $collection;
		} catch (Throwable $e){
			throw new InvalidArgumentException('Collection cannot be populated from the data!');
		}
	}	

		
	/**
	 * @param  mixed $offset
	 * @param  mixed $value
	 * @return void
	 */
	public function offsetSet($offset, $value): void {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    
    /**
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool {
        return isset($this->container[$offset]);
    }
	    
    /**
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void {
        unset($this->container[$offset]);
    }
    
    /**
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset): mixed {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
   
    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->container);
    }
}