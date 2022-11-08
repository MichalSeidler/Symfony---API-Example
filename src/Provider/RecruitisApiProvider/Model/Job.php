<?php
namespace App\Provider\RecruitisApiProvider\Model;
use Throwable;
use InvalidArgumentException;

class Job {
    protected string $id;
    protected string $title;
    protected string $description;
    
	/**
	 * @return string
	 */
	function getId(): string {
		return $this->id;
	}
	
	/**
	 * @param string $id 
	 * @return Job
	 */
	function setId(string $id): self {
		$this->id = $id;
		return $this;
	}
	/**
	 * @return string
	 */
	function getTitle(): string {
		return $this->title;
	}
	
	/**
	 * @param string $title 
	 * @return Job
	 */
	function setTitle(string $title): self {
		$this->title = $title;
		return $this;
	}
	/**
	 * @return string
	 */
	function getDescription(): string {
		return $this->description;
	}
	
	/**
	 * @param string $description 
	 * @return Job
	 */
	function setDescription(string $description): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * @param array $data
	 * @return Job
	 * @throws InvalidArgumentException
	 */
	static function populate(array $data): Job {
		try {
			$job = new Job;
			$job->setId($data['job_id']);
			$job->setTitle($data['title']);
			$job->setDescription($data['description']);

			return $job;
		} catch (Throwable $e){
			throw new InvalidArgumentException('Job instance cannot be populated from the data!');
		}
	}
	
}