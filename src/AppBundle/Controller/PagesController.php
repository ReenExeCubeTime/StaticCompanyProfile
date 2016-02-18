<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    public function companyAction(Request $request)
    {
        $json = $request->query->get('json');
        $content = json_decode($this->get('scp.keyvalue.storage')->get($json), true);

        if (empty($content)) {
            throw $this->createNotFoundException();
        }

        $company = $request->query->get('company');

        return $this->render('AppBundle:pages:company.html.twig', [
            'company' => $company,
            'content' => $content,
        ]);
    }
}
