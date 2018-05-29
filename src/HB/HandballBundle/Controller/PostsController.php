<?php

namespace HB\HandballBundle\Controller;

use HB\HandballBundle\Entity\Posts;
use HB\HandballBundle\Form\PostsType;
use HB\HandballBundle\Entity\Category;
use HB\HandballBundle\Form\CategoryAddType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PostsController extends Controller
{
    public function indexAction(Request $request)
    {
        $post = new Posts;
        $form = $this->get('form.factory')->create(PostsType::class, $post);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('hb_handball_homepage');
        }

        return $this->render('HBHandballBundle:view:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function addCategoryAction(Request $request) {
        $category = new Category;
        $form = $this->get('form.factory')->create(CategoryAddType::class, $category);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('hb_handball_homepage');
        }

        return $this->render('HBHandballBundle:view:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function categoryAction() {
        $category = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Category')
                ->findAll();
        
        return $this->render('HBHandballBundle:view:category.html.twig', array(
            'category' => $category,
        ));
    }
    
    public function listPostAction($id) {
        $posts = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts')
                ->getPostWithCategory($id);
        
        
        var_dump($posts);
        return $this->render('HBHandballBundle:view:listPost.html.twig', array(
            'posts' => $posts,
        ));
    }
}

