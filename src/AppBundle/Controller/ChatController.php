<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Chat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ChatController extends Controller implements TokenAuthenticatedController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $isAuthorizedUser = $this->isAuthorizedUser($request);

        $manager = $this->getDoctrine()->getManager();
        $chatMessages = $manager->getRepository('AppBundle:Chat')->getAllApproved();

        return $this->render('chat/index.html.twig', [
            'chatMessages' => $chatMessages,
            'chatUnApprovedMessages' => $isAuthorizedUser ? $manager->getRepository('AppBundle:Chat')->getAllUnApproved() : [],
            'isAuthorizedUser' => $isAuthorizedUser
        ]);
    }

    public function approveMessageAction()
    {

    }

    public function refuseMessageAction()
    {

    }

    private function isAuthorizedUser($request)
    {
        return (bool) $request->attributes->get('auth_token');
    }

}
