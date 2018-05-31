<?php

namespace HB\HandballBundle\Controller;

use HB\HandballBundle\Entity\Posts;
use HB\HandballBundle\Form\PostsType;
use HB\HandballBundle\Entity\Category;
use HB\HandballBundle\Form\CategoryAddType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class AdminController extends Controller
{  
    /**
    * @Security("has_role('ROLE_USER')")
    */
    public function adminAction(){
        
     return $this->render('HBHandballBundle:view:admin.html.twig');
    }
    
    /**
    * @Security("has_role('ROLE_USER')")
    */
    public function addPostAction(Request $request)
    {
        $post = new Posts;
        $form = $this->get('form.factory')->create(PostsType::class, $post);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('hb_handball_homepage');
        }

        return $this->render('HBHandballBundle:view:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
    * @Security("has_role('ROLE_USER')")
    */
    public function addCategoryAction(Request $request) {
        $category = new Category;
        $form = $this->get('form.factory')->create(CategoryAddType::class, $category);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('hb_handball_homepage');
        }

        return $this->render('HBHandballBundle:view:formCat.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
    * @Security("has_role('ROLE_USER')")
    */
    public function updateAction(Request $request, $id) {
        $post = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts')
                ->find($id);
        
        $form = $this->get('form.factory')->create(PostsType::class, $post);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('hb_handball_homepage');
        }

        return $this->render('HBHandballBundle:view:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}

