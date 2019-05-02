<?php

namespace App\Controller;


use App\Entity\Categories;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
            ->select('MONTHNAME(p.datetime) AS monthName, MONTH(p.datetime) as month, YEAR(p.datetime) AS year LIMIT 25')
            ->groupBy('monthName')
            ->getQuery()
            ->getResult();

        return $this->render('FrontEnd/Blog/blog.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findAll(),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findAll(),
            'months' => $months,
            'pagination' => $pagination,
            'f' => $this
        ]);
    }

    /**
     * @Route("blog/category/{category}", name="blog_category")
     */
    public function blogByCategory(Request $request, PaginatorInterface $paginator, $category) {
        $em    = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM App:Post a WHERE a.category = '" . $category . "' ORDER BY a.datetime ASC";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 5);

//        $months = $em->getRepository("App:Post")
//            ->createQueryBuilder('p')
//            ->select('MONTHNAME(p.datetime) AS monthName, MONTH(p.datetime) as month, YEAR(p.datetime) AS year LIMIT 25 ORDER BY p.datetime DESC')
//            ->groupBy('monthName')
//            ->getQuery()
//            ->getResult();

        $query = "SELECT MONTHNAME(datetime) AS monthName, MONTH(datetime) as month, YEAR(datetime) AS year FROM post GROUP BY monthName ORDER BY datetime DESC LIMIT 25 ";
        $months = $em->getConnection()->prepare($query);
        $months->execute();

        $months = $months->fetchAll();

        return $this->render('FrontEnd/Blog/blog.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findAll(),
            'category_list' => $this->getDoctrine()->getRepository(Categories::class)->findAll(),
            'months' => $months,
            'pagination' => $pagination,
            'f' => $this,
            'category' => $category
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
            'previous' => [],
            'next' => []
        ]);
    }
}
