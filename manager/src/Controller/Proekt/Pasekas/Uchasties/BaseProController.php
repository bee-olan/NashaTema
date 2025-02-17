<?php

declare(strict_types=1);

namespace App\Controller\Proekt\Pasekas\Uchasties;

use App\Annotation\RequiresUserCredits;
use App\ReadModel\Adminka\Uchasties\PersonaFetcher;
use App\ReadModel\Adminka\Uchasties\Uchastie\UchastieFetcher;
use App\ReadModel\Mesto\InfaMesto\MestoNomerFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/proekt/pasekas/uchasties", name="app.proekts.pasekas.uchasties")
 */
class BaseProController extends AbstractController
{

    /**
     * @Route("/basepro", name=".basepro")
     * @param Request $request
     * @param UchastieFetcher $uchasties
     * @param PersonaFetcher $personas
     * @param MestoNomerFetcher $mestoNomers
     * @return Response
     */
    public function basepro(Request $request,
                            UchastieFetcher $uchasties,
                            PersonaFetcher $personas,
                            MestoNomerFetcher $mestoNomers
                        ): Response
    {
        $idUser = $this->getUser()->getId();

        $persona = $personas->find($idUser);

        $mestoNomer = $mestoNomers->find($idUser);

        $uchastie = $uchasties->find($idUser);

        return $this->render('app/proekts/pasekas/uchasties/basepro.html.twig',
            compact('persona', 'mestoNomer', 'uchastie')
        );
    }
}