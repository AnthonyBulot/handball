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
    public function indexAction(){
        
     return $this->render('HBHandballBundle:view:home.html.twig');
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
        
        
        return $this->render('HBHandballBundle:view:listPost.html.twig', array(
            'posts' => $posts,
        ));
    }
    
        public function postAction($id) {
        $post = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts')
                ->find($id);
        
        
        return $this->render('HBHandballBundle:view:onePost.html.twig', array(
            'post' => $post,
        ));
    }
    
    public function searchAction(Request $request) {
        if ($request->isMethod('POST')) {
           $search = '%' . $_POST['recherche'] . '%';
            $posts = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts')
                ->searchPost($search);
            
            var_dump($posts);
            
            return $this->render('HBHandballBundle:view:listPost.html.twig', array(
            'posts' => $posts,
            ));
        } 
        
        return $this->redirectToRoute('hb_handball_homepage');
    }
    
}

