<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Media;
use App\Entity\MenuItems;
use App\Entity\Partners;
use App\Entity\Post;
use App\Entity\User;
use App\Form\CategoriesType;
use App\Form\MediaType;
use App\Form\MenuItemsType;
use App\Form\PartnersType;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/dashboard/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/articles/list", name="admin_articles_list")
     */
    public function articleList() {

        return $this->render("admin/articles/list.html.twig", [
            'posts' => $this->getDoctrine()->getRepository(Post::class)->findAll()
        ]);
    }

    /**
     * @Route("/admin/articles/new/", name="admin_articles_new")
     */
    public function articleNew(Request $request) {

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slug = new Slugify();
            $em = $this->getDoctrine()->getManager();

            $post->setSlug($slug->slugify($post->getTitle()));

            $em->persist($post);
            $em->flush();

            $this->addFlash('success', "Post successfully added.");

            return $this->redirectToRoute('admin_articles_edit', [
                'updated' => 'true',
                'page_title' => 'Edit',
                'id' => $post->getId()
            ]);
        }

        return $this->render("admin/articles/new.html.twig", [
            'form' => $form->createView(),
            'page_title' => 'New'

        ]);
    }

    /**
     * @Route("/admin/articles/edit/{id}", name="admin_articles_edit")
     */
    public function articleEdit(Request $request,$id) {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $slug = new Slugify();

            $em = $this->getDoctrine()->getManager();

            $post->setSlug($slug->slugify($post->getTitle()));

            $em->persist($post);

            $this->addFlash('success', "Post successfully updated.");

            return $this->redirectToRoute('admin_articles_new', [
                'updated' => 'true',
                'page_title' => 'Edit',
                'id' => $post->getId()
            ]);
        }

        return $this->render("admin/articles/new.html.twig", [
            'form' => $form->createView(),
            'page_title' => 'Edit',
            'id' => $id
        ]);
    }

    /**
     * @Route("/admin/articles/delete/{id}", name="admin_articles_delete")
     */
    public function articleDelete($id) {
        $article = $this->getDoctrine()->getRepository(Post::class)->find($id);

        return $this->render("admin/articles/delete.html.twig", [
            'article' => $article
        ]);
    }

    /**
     * @Route("/admin/articles/delete/confirm/{id}", name="admin_articles_delete_confirm")
     */
    public function articleDeleteConfirm($id) {
        $article = $this->getDoctrine()->getRepository(Post::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('admin_articles_list', [

        ]);
    }

    /**
     * @Route("/admin/articles/categories", name="admin_articles_categories")
     */
    public function articleCategories(Request $request) {

        $list = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        $form = $this->createForm(CategoriesType::class, new Categories());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Category successfully added.');

            return $this->redirectToRoute('admin_articles_categories');
        }

        return $this->render("admin/articles/categories.html.twig", [
            'list' => $list,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/media/list", name="admin_media_list")
     */
    public function mediaList() {

        $media = new Finder();
        $media = $media->ignoreUnreadableDirs()->in('../public/media')->exclude('cache')->files()->notContains('*.php')->sortByModifiedTime();

        return $this->render("admin/media/list.html.twig", [
            'media' => $media,
            'count' => count($media),
            'f' => $this
        ]);
    }

    /**
     * @Route("/admin/media/show/{filename}", name="admin_media_show")
     */
    public function mediaShow($filename) {

        $fileSize = filesize('media/' . $filename);

        return $this->render("admin/media/show.html.twig", [
           'filename' => $filename,
            'filesize' => $fileSize,
        ]);
    }

    /**
     * @Route("/admin/media/add", name="admin_media_add")
     */
    public function mediaAdd(Request $request) {

        $media = new Media();

        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $file = $media->getName();

            $fileName = $file->generateUniqueFileName() . $file->guessExtension();

            try {
                $file->move(
                    '../public/media', $media
                );
            } catch (FileException $e) {

            }
        }

        return $this->render("admin/media/new.html.twig", [
            'page_title' => 'Add',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aspect/menu", name="admin_aspect_menu")
     */
    public function aspectMenu(Request $request) {

        $menuItems = new MenuItems();
        $form = $this->createForm(MenuItemsType::class, $menuItems);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $menuItem = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($menuItem);
            $em->flush();
        }

        return $this->render("admin/aspect/menu.html.twig", [
            'items' => $this->getDoctrine()->getRepository(MenuItems::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/pages/partners", name="admin_pages_partners")
     */
    public function pagesPartners(Request $request) {
        $partners = new Partners();

        $form = $this->createForm(PartnersType::class, $partners);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $partner = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($partner);
            $em->flush();
        }

        return $this->render("admin/pages/partners.html.twig", [
           'items' => $this->getDoctrine()->getRepository(Partners::class)->findAll(),
           'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/settings/users", name="admin_settings_users")
     */
    public function settingsUsers() {
        return $this->render("admin/settings/users.html.twig", [
           'items' => $this->getDoctrine()->getRepository(User::class)->findAll()
        ]);
    }

    public function cleanDir($file) {
        return str_replace('public/', '',$file);
    }
}
