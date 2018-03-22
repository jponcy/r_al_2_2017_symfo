<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Manga;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\MangaRepository;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/manga")
 */
class MangaController extends Controller {

    /**
     * @Route("/", methods={"GET"})
     * @Template()
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return [
            'entities' => $this->_repository()->findAll()
        ];
    }

    /**
     * @Route("/new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->_newOrEdit(new Manga(), $request);
    }

    /**
     * @Route("/{id}", requirements={"id":"^\d+$"})
     */
    public function editAction(Manga $entity, Request $request)
    {
        return $this->_newOrEdit($entity, $request);
    }

    /**
     * @Route("/fill")
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
