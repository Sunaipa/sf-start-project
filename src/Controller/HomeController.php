<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/home/{userName}", name="home")
     *
     * @param Request $request
     * @param string $userName
     * @return Response
     */
    public function homeAction(Request $request, string $userName = "tetetsts"): Response {
        $age = $request->query->get('age', 8);
        $session = $request->getSession();
        $session->set("user", "toto");

        return $this->render("home/index.html.twig", [
            "age" => $age,
            "userName" => $userName
        ]);
    }

    /**
     * @Route("/user/{id<\d+>}", name="user")
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function userAction(Request $request, int $id = 5): Response {
        $session = $request->getSession();
        return $this->render("home/user/index.html.twig", [
            "id" => $id
        ]);

    }
}
