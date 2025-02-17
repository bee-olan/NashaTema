<?php

declare(strict_types=1);

namespace App\Controller\Proekt\PageGlavas\UchastGls\Obsudims;

use App\Model\Adminka\Entity\Uchasties\Personas\PersonaRepository;
use App\Model\Adminka\Entity\Uchasties\Personas\Id as PersonaId;
use App\Model\Adminka\Entity\Uchasties\Uchastie\Id;
use App\Model\Adminka\Entity\Uchasties\Uchastie\UchastieRepository;
use App\Model\Mesto\Entity\InfaMesto\MestoNomerRepository;
use App\Model\Mesto\Entity\InfaMesto\Id as MestoNomerId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostMestoController extends AbstractController
{
    /**
     * @Route("app/proekts/page_glavas/uchastieGl/obsudims/postmesto", name="app.proekts.page_glavas.uchastieGl.obsudims.postmesto")
     * @param Request $request
     * @param MestoNomerRepository $mestoNomers
     * @param UchastieRepository $uchasties
     * @param PersonaRepository $personas
     * @return Response
     */
    public function postmesto(Request $request,
                          UchastieRepository $uchasties,
                          PersonaRepository $personas,
                          MestoNomerRepository $mestoNomers
                            ): Response
    {
//        $idUser = $this->getUser()->getId();
//
//        $uchastie = $uchasties->has(new Id($idUser));
//        $persona = $personas->has(new PersonaId($idUser));
//        $mestoNomer = $mestoNomers->has(new MestoNomerId($idUser));
//
        $postMesto = "postmesto!!!!!!!!!!!!!!!!";

        return $this->render('/app/proekts/page_glavas/uchastieGl/obsudims/postmesto.html.twig',
         compact( 'postMesto')
        );
    }
}