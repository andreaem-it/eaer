<?php

namespace App\Controller;


use App\Entity\Categories;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Knp\Component\Pager\PaginatorInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em    = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM App:Post a ORDER BY a.datetime ASC";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 5);

        $months = $em->getRepository("App:Post")
            ->createQueryBuilder('p')
            ->select('MONTHNAME(p.datetime) AS monthName, MONTH(p.datetime) as month, YEAR(p.datetime) AS year')
            ->groupBy('monthName')
            ->getQuery()
            ->getResult();

        var_dump($months);

        //$months =  array_unique($months['month']);

        return $this->render('FrontEnd/Blog/blog.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findAll(),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findAll(),
            'months' => $months,
            'pagination' => $pagination,
            'f' => $this
        ]);
    }

    /**
         * @Route("blog/month/{year}/{month}", name="blog_by_month")
     */
    public function blogByMonth(Request $request, PaginatorInterface $paginator,$month,$year) {
        $date = new \DateTime("{$year}-{$month}-01");

        $em    = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM App:Post a WHERE YEAR(a.datetime) = " . $year . " AND MONTH(a.datetime) BETWEEN " . $month ." AND " . $month ." ORDER BY a.datetime ASC";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 5);

        $months = $em->getRepository("App:Post")
            ->createQueryBuilder('p')
            ->select('MONTHNAME(p.datetime) AS monthName, MONTH(p.datetime) as month, YEAR(p.datetime) AS year')
            ->groupBy('monthName')
            ->orderBy('p.datetime', 'DESC')
            ->getQuery()
            ->getResult();

        //$months =  array_unique($months['month']);

        return $this->render('FrontEnd/Blog/blog.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findAll(),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findAll(),
            'months' => $months,
            'pagination' => $pagination,
            'f' => $this
        ]);
    }

    /**
     * @Route("/blog/article/{year}/{month}/{slug}", name="blog_article")
     */
    public function show($slug){
        return $this->render('FrontEnd/Blog/article.html.twig', [
            'post' => $this->getDoctrine()->getRepository(Post::class)->findBy(['slug' => $slug]),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findBy([],['name'=> 'ASC']),
//            'previous' => $this->getDoctrine()->getRepository(Post::class)->findOneBy(['id' => $id - 1]),
//            'next' => $this->getDoctrine()->getRepository(Post::class)->findOneBy(['id' => $id + 1]),
        'previous' => [],
            'next' => []
        ]);
    }

    /**
     * @Route("/blog/category/{id}", name="blog_category")
     */
    public function categories($id) {

    }

    public function getMonthsPosts($m) {
        //return count($this->getDoctrine()->getRepository(Post::class)->findBy(['datetime' => date("M")]));
        return $m;
    }

    public function getPostsByMonth($year, $month)
    {
        $date = new \DateTime("{$year}-{$month}-01");

        $em = $this->getDoctrine()->getRepository(Post::class);

        $qb = $em->createQueryBuilder('b');
        $query = $qb
            ->where('b.datetime BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;
        return $query->getQuery()->getResult();
    }

    function _group_by($array, $key) {

    }
}
