<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Manga;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class MangaController extends Controller {

    /**
     * @Route("/manga/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository(Manga::class);

        $entities = $repo->findAll();

        return $this->render('Manga/index.html.twig', [
            'entities' => $entities
        ]);
    }

    /**
     * @Route("/manga/new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entity = new Manga();

        $form = $this->createFormBuilder($entity)
            ->add('name')
            ->add('author')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($entity);
            $manager->flush();

            return $this->redirectToRoute('app_manga_index');
        }

        return $this->render('Manga/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/manga/fill")
     */
    public function fillAction()
    {
        $names = [
            'drabon gall',
            'assassination mushroom',
            'full metal anarchie',
            'drabon gall A',
            'captain tsubasa',
            'norauto',
            'one piste'
        ];
        $authors = [
            'Hervé',
            'Casandra',
            'MongoDB'
        ];

        $manager = $this->getDoctrine()->getManager();

        for ($i = 0; $i < count($names); ++ $i) {
            $name = $names[$i];
            $author = $authors[$i % count($authors)];

            $manga = new Manga($name, $author);

            $manager->persist($manga);
        }

        $manager->flush();

        return $this->redirectToRoute('app_manga_index');
    }
}
