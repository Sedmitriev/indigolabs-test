<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class AuthController extends AbstractController
{
    const COOKIE_LIFETIME = 600;

    public function __construct(private UserService $userService)
    {
    }

    /**
     * @Route("/sign-up/{uuid}", name="signUp")
     * @param Request $request
     * @return Response
     */
    public function signUp(Request $request): Response
    {
        $uuid = $request->get('uuid');
        $this->userService->signUpByUuid($uuid);

        return $this->render('index.html.twig', ['isAuth' => true]);
    }

    /**
     * @Route("/sign-in/{uuid}", name="signIn")
     * @param Request $request
     * @return Response
     */
    public function signIn(Request $request): Response
    {
        $uuid = $request->get('uuid');
        $isAuth = isset($_COOKIE['is_auth']) && $_COOKIE['is_auth'];
        $res = $this->render('index.html.twig', ['isAuth' => $isAuth]);
        if (!$isAuth && $this->userService->signInByUuid($uuid)) {
            setcookie('is_auth', '1', time() + self::COOKIE_LIFETIME, '/');
            $res = $this->render('index.html.twig', ['isAuth' => true]);
        }

        return $res;
    }
}
