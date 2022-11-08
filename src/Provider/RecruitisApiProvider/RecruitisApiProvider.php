<?php
namespace App\Provider\RecruitisApiProvider;
use App\Provider\RecruitisApiProvider\Common\Collection;
use App\Provider\RecruitisApiProvider\Model\Job;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Throwable;

class RecruitisApiProvider {

    private ParameterBagInterface $params;
    private HttpClientInterface $httpClient;
    
    /**
     * @param  HttpClientInterface $httpClient
     * @param  ParameterBagInterface $params
     * @return void
     */
    public function __construct(HttpClientInterface $httpClient, ParameterBagInterface $params)
    {
        $this->params = $params;

        $store = new Store('/var/cache');
        $this->httpClient = new CachingHttpClient($httpClient, $store);
    }
    
    /**
     * 
     * @param  int $page
     * @param  int $pageLimit
     * @return Collection
     */
    public function getJobs(int $page = 1, int $pageLimit = 10): Collection
    {
        try {
            $response = $this->httpClient->request('GET', $this->params->get('recruitis.url').'/jobs', [
                'query'   => [
                    'activity_state' => 1,
                    'limit' => $pageLimit,
                    'page' => $page
                ],
                'auth_bearer' => $this->params->get('recruitis.token')
            ]);

            if ($response->getStatusCode() == 200) {
                $responseData = json_decode($response->getContent(), true);

                return Collection::populate(Job::class, $responseData);
            } else {
                throw new \RuntimeException('API Error');
            }
        } catch (Throwable $e){
            throw new \RuntimeException('API Error');
        }

    }
}