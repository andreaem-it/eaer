<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Entity\CustomPages;
use App\Entity\NewsletterItems;
use App\Entity\Post;
use App\Entity\Slider;
use App\Form\ContactsType;
use App\Form\NewsletterType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends AbstractController
{
    /**
     * @Route("/", name="front_end")
     */
    public function index(Request $request)
    {
        $contacts = new Contacts();
        $contact = $this->createForm(ContactsType::class, $contacts);

        $contact->handleRequest($request);

        if ($contact->isSubmitted() && $contact->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact->getData());
            $em->flush();

            $this->addFlash('success','Thank you, your message was sended and you will receive a reply shortly.');

            return $this->redirect($this->generateUrl('front_end') . '#contact');
        }

        return $this->render('FrontEnd/index.html.twig', [
            'post_list' => $this->getDoctrine()->getRepository(Post::class)->findBy([],['datetime' => 'DESC'],12),
            'contact' => $contact->createView(),
            'slider' => $this->getDoctrine()->getRepository(Slider::class)->findBy(['active' => true])
        ]);
    }

    /**
     * @Route("/privacy-policy", name="privacy-policy")
     */
    public function privacyPolicy() {
        return $this->render('FrontEnd/Policy/policy.html.twig');
    }

    /**
     * @Route("/newsletter-submission-handler", name="newsletter-submission-handler")
     */
    public function newsletterSubmissionHandler(Request $request) {

        $emails = new NewsletterItems();
        $email = $this->createForm(NewsletterType::class, $emails);

        $email->handleRequest($request);

        if ($email->isSubmitted() && $email->isValid()) {

            $emails->setLocale($request->getLocale());
            $emails->setDatetime(new DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($email->getData());
            $em->flush();
        }

        return new JsonResponse($request);

    }

    /**
     * @Route("/coming-soon", name="coming-soon")
     */
    public function comingSoon()
    {
        return $this->render('FrontEnd/comingsoon.html.twig');
    }

    /**
     * @Route("/project", name="project")
     */
    public function project() {
        $content = $this->getDoctrine()->getRepository(CustomPages::class)->findOneBy(['page_name' => 'project']);

        return $this->render('FrontEnd/Pages/page.html.twig', [
            'content' => $content
        ]);
    }
}
