<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Manga;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\MangaRepository;

class MangaController extends Controller {

    /**
     * @Route("/manga/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $entities = $this->_repository()->findAll();

        return $this->render('Manga/index.html.twig', [
            'entities' => $entities
        ]);
    }

    /**
     * @Route("/manga/new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->_newOrEdit(new Manga(), $request);
    }

    /**
     * @Route("/manga/{id}", requirements={"id":"^\d+$"})
     */
    public function editAction(int $id, Request $request)
    {
        $entity = $this->_repository()->find($id);
        return $this->_newOrEdit($entity, $request);
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

    /**
     * Returns the repository to manage manga records.
     * @return MangaRepository
     */
    private function _repository(): MangaRepository
    {
        return $this->getDoctrine()->getRepository(Manga::class);
    }

    /**
     * @param entity
     */
    private function _newOrEdit($entity, Request $request)
    {
        $form = $this->createFormBuilder($entity)
            ->add('name')
            ->add('author')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $this->getDoctrine()->getManager();

            $entity->persist($entity);
            $entity->flush();

            return $this->redirectToRoute('app_manga_index');
        }

        return $this->render('Manga/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
