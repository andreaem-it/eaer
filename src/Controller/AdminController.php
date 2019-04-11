<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Contacts;
use App\Entity\CustomPages;
use App\Entity\Events;
use App\Entity\Media;
use App\Entity\MenuItems;
use App\Entity\NewsletterItems;
use App\Entity\Partners;
use App\Entity\Post;
use App\Entity\Slider;
use App\Entity\User;
use App\Form\CategoriesType;
use App\Form\CustomPagesType;
use App\Form\EventsType;
use App\Form\MediaType;
use App\Form\MenuItemsType;
use App\Form\PartnersType;
use App\Form\PostType;
use App\Form\SliderType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\FileUploader;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'art_count' => count($this->getDoctrine()->getRepository(Post::class)->findAll())
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

            $em->flush();

            $this->addFlash('success', "Post successfully updated.");

            return $this->redirectToRoute('admin_articles_edit', [
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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

        if($form->isSubmitted()) {
            //$media->setName($now->format('Y-m-dTH:i:s'));
            //$file = $form->getData();

            $media->setUpdatedAt(new DateTime("now"));
            //$media->setName($file->getName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_media_show', [
                'filename' => $media->getName()
            ]));

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

            $this->redirectToRoute('admin_aspect_menu');
        }

        return $this->render("admin/aspect/menu.html.twig", [
            'items' => $this->getDoctrine()->getRepository(MenuItems::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aspect/menu/edit/{id}", name="admin_aspect_menu_edit")
     */
    public function aspectMenuEdit(Request $request,$id) {
        $menuItems = $this->getDoctrine()->getRepository(MenuItems::class)->find($id);
        $form = $this->createForm(MenuItemsType::class, $menuItems);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $menuItem = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($menuItem);
            $em->flush();

            $this->redirectToRoute('admin_aspect_menu');
        }

        return $this->render("admin/aspect/menu.html.twig", [
            'items' => $this->getDoctrine()->getRepository(MenuItems::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aspect/menu/delete/{id}", name="admin_aspect_menu_delete")
     */
    public function aspectMenuDelete(Request $request,$id) {
        $menuItems = $this->getDoctrine()->getRepository(MenuItems::class)->find($id);
        $form = $this->createForm(MenuItemsType::class, $menuItems);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $menuItem = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->remove($menuItem);
            $em->flush();

            $this->redirectToRoute('admin_aspect_menu');
        }

        return $this->render("admin/aspect/menu.html.twig", [
            'items' => $this->getDoctrine()->getRepository(MenuItems::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aspect/menu/action/hide/{id}", name="admin_aspect_menu_action_hide")
     */
    public function aspectMenuActionHide ($id) {
        $item = $this->getDoctrine()->getRepository(MenuItems::class)->find($id);

        $item->setActive('0');
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_aspect_menu');
    }

    /**
     * @Route("/admin/aspect/menu/action/unhide/{id}", name="admin_aspect_menu_action_unhide")
     */
    public function aspectMenuActionUnhide ($id) {
        $item = $this->getDoctrine()->getRepository(MenuItems::class)->find($id);

        $item->setActive('1');
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_aspect_menu');
    }

    /**
     * @Route("/admin/aspect/slider", name="admin_aspect_slider")
     */
    public function aspectSlider(Request $request) {

        $sliders = new Slider();
        $form = $this->createForm(SliderType::class, $sliders);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $slider = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($slider);
            $em->flush();

            $this->addFlash('success', 'New element added');
            $this->redirectToRoute('admin_aspect_slider');

        }

        return $this->render('admin/aspect/slider.html.twig', [
            'items' => $this->getDoctrine()->getRepository(Slider::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aspect/slider/delete/{id}", name="admin_aspect_slider_delete")
     */
    public function aspectSliderDelete($id) {
        $sliders = $this->getDoctrine()->getRepository(Slider::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($sliders);
        $entityManager->flush();

        $this->addFlash('danger', 'Element Deleted');
        return $this->redirectToRoute('admin_aspect_slider');
    }

    /**
     * @Route("/admin/aspect/slider/edit/{id}", name="admin_aspect_slider_edit")
     */
    public function aspectSliderEdit(Request $request,$id) {
        $sliders = $this->getDoctrine()->getRepository(Slider::class)->find($id);
        $form = $this->createForm(SliderType::class, $sliders);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $slider = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($slider);
            $em->flush();

            $this->addFlash('success', 'Element modified');
            $this->redirectToRoute('admin_aspect_slider');

        }

        return $this->render('admin/aspect/slider.html.twig', [
            'items' => $this->getDoctrine()->getRepository(Slider::class)->findAll(),
            'form' => $form->createView(),
            'thisItem' => $this->getDoctrine()->getRepository(Slider::class)->find($id)
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
     * @Route("/admin/pages/custom/", name="admin_pages_custom")
     */
    public function pagesCustom(Request $request) {
        $pages = new CustomPages();

        $form = $this->createForm(CustomPagesType::class, $pages);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $pages = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($pages);
            $em->flush();
        }

        return $this->render('admin/pages/custom.html.twig', [
            'items' => $this->getDoctrine()->getRepository(CustomPages::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/pages/custom/action/{action}/{id}", name="admin_pages_custom_action")
     */
    public function pagesCustomAction($action,$id) {
        $pages = $this->getDoctrine()->getRepository(CustomPages::class)->find($id);

        if($action == 1) {
            $pages->setPublished(1);
        } elseif ($action == 0) {
            $pages->setPublished(0);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('admin_pages_custom');
    }

    /**
     * @Route("/admin/pages/custom/delete/{id}", name="admin_pages_custom_delete")
     */
    public function pagesCustomDelete($id) {
        $pages = $this->getDoctrine()->getRepository(CustomPages::class)->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($pages);
        $em->flush();
    }

    /**
     * @Route("/admin/pages/custom/edit/{id}", name="admin_pages_custom_edit")
     */
    public function pagesCustomEdit(Request $request, $id) {
        $pages = $this->getDoctrine()->getRepository(CustomPages::class)->find($id);

        $form = $this->createForm(CustomPagesType::class, $pages);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $pages = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($pages);
            $em->flush();
        }

        return $this->render('admin/pages/custom.html.twig', [
            'items' => $this->getDoctrine()->getRepository(CustomPages::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/pages/partners/edit/{id}", name="admin_pages_partners_edit")
     */
    public function pagesPartnersEdit(Request $request, $id ) {
        $partners = $this->getDoctrine()->getRepository(Partners::class)->find($id);

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
     * @Route("/admin/contacts/list", name="admin_contacts_list")
     */
    public function contactsList() {
        return $this->render('admin/contacts/list.html.twig', [
            'items' => $this->getDoctrine()->getRepository(Contacts::class)->findAll()
        ]);
    }

    /**
     * @Route("/admin/events/list", name="admin_events_list")
     */
    public function eventsList(Request $request) {
        $events = new Events();

        $form = $this->createForm(EventsType::class, $events);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $event = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($event);
            $em->flush();
        }

        return $this->render('admin/events/list.html.twig',[
            'items' => $this->getDoctrine()->getRepository(Events::class)->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/newsletter/list", name="admin_newsletter_list")
     */
    public function newsletterList() {
        return $this->render('admin/newsletter/list.html.twig', [
            'items' => $this->getDoctrine()->getRepository(NewsletterItems::class)->findAll()
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

    /**
     * @Route("/admin/settings/system", name="admin_settings_system")
     */
    public function settingsSystem() {


        return $this->render('admin/settings/system.html.twig', [
            'cacheDir' => 'WARN: Failed to retrieve cache directory path'
        ]);
    }

    /**
     * @Route("/admin/settings/system/clearCache", name="admin_settings_system_clear_cache")
     */
    public function settingsSystemClearCache(KernelInterface $kernel) {

        return $this->do_command($kernel, 'cache:clear');

        return $this->redirectToRoute('admin_settings_system');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        return $this->redirectToRoute('login');
    }

    public function cleanDir($file) {
        return str_replace('public/', '',$file);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/fileuploadhandler", name="fileuploadhandler")
     */
    public function fileUploadHandler(Request $request) {
        $output = array('uploaded' => false);
        // get the file from the request object
        $file = $request->files->get('file');
        // generate a new filename (safer, better approach)
        // To use original filename, $fileName = $this->file->getClientOriginalName();
        $fileName = date("dmY-") . md5(uniqid()).'.'.$file->guessExtension();

        // set your uploads directory
        $uploadDir = $this->get('kernel')->getProjectDir() . '/public/media/';
        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }
        if ($file->move($uploadDir, $fileName)) {
            // get entity manager
            $em = $this->getDoctrine()->getManager();

            // create and set this mediaEntity
            $mediaEntity = new Media();
            $mediaEntity->setName($fileName);
            $mediaEntity->setPath($uploadDir);
            $mediaEntity->setFile($file);

            // save the uploaded filename to database
            $em->persist($mediaEntity);
            $em->flush();
            $output['uploaded'] = true;
            $output['fileName'] = $fileName;
        }
        return new JsonResponse($output);
    }

    private function do_command($kernel, $command)
    {
        $env = $kernel->getEnvironment();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => $command,
            '--env' => $env
        ));

        $output = new BufferedOutput();
        try {
            $application->run($input, $output);
        } catch (\Exception $e) {
        }

        $content = $output->fetch();

        return new Response($content);
    }
}
