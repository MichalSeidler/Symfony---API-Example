<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

use App\Provider\RecruitisApiProvider\RecruitisApiProvider;



class JobController extends AbstractController
{  
    /**
     * @param  Request $request
     * @param  RecruitisApiProvider $recruitisApiProvider
     * @param  PaginatorInterface $paginator
     * @return Response
     */
    #[Route('/', name: 'job_index', methods: ['GET'])]  
    public function index(Request $request, RecruitisApiProvider $recruitisApiProvider, PaginatorInterface $paginator): Response
    {
        $pageLimit = 10;
        $page = $request->query->get('page', 1);
        
        $jobs = $recruitisApiProvider->getJobs($page, $pageLimit);

        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
            'jobs' => $jobs,
            'page' => $page,
            'totalPages' => ceil($jobs->total / $pageLimit)
        ]);
    }
}
