<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Provider\RecruitisApiProvider\Common\Collection;
use App\Provider\RecruitisApiProvider\Model\Job;

final class CollectionTest extends TestCase
{
    public function testPopulate(){

        $data = file_get_contents(__DIR__.'/jsonResponse.json');
        $collection = Collection::populate(Job::class, json_decode($data, true));

        $this->assertCount(10, $collection);
        $this->assertContainsOnlyInstancesOf(Job::class, $collection);
    }
}