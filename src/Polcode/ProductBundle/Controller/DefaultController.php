<?php

namespace Polcode\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction(Request $Request) {

        if ($this->getUser() && $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            #return $this->redirect($this->generateUrl('sonata_user_profile_show'));
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

    }

}
