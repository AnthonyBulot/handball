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
    
    public function listPostAction($id, $page) {
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts');

        
        $totalEntry = $repository->totalPosts($id);

        $numberPages=ceil($totalEntry/5);

        if(isset($page)) {
            $currentPage=intval($page);
 
            if($currentPage>$numberPages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
            {
                $currentPage=$numberPages;
            }
        }
        else // Sinon
        {
            $currentPage = 1; // La page actuelle est la n°1    
        }

        $firstEntry=($currentPage - 1) * 5; // On calcul la première entrée à lire


        for($i=1; $i<=$numberPages; $i++){
            $number[] = $i;
        }

        $posts = $repository->getPostWithCategory($id, $firstEntry);

        
        return $this->render('HBHandballBundle:view:listPost.html.twig', array(
            'posts' => $posts,
            'currentPage' => $currentPage,
            'numberPages' =>$number,
            'catId' =>$id,
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


            $search = '%' . $_POST['recherche'] . '%';
            

            $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts');

            $totalEntry = $repository->totalPostSearch($search);

            $numberPages=ceil($totalEntry/5);

            $page = 1;

            if(isset($page)) {
                $currentPage=intval($page);
 
                if($currentPage>$numberPages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
                {
                    $currentPage=$numberPages;
                }
            }
            else // Sinon
            {
                $currentPage = 1; // La page actuelle est la n°1    
            }

            $firstEntry=($currentPage - 1) * 5; // On calcul la première entrée à lire


            for($i=1; $i<=$numberPages; $i++){
                $number[] = $i;
            }

            ;

            $posts = $repository->testSearch($search);

            if($posts === array()){
                $posts = null;

                return $this->render('HBHandballBundle:view:search.html.twig', array(
                'posts' => $posts,
                ));

            }
            else{
                $posts = $repository->searchPost($search, $firstEntry);

                return $this->render('HBHandballBundle:view:search.html.twig', array(
                'posts' => $posts,
                'currentPage' => $currentPage,
                'numberPages' =>$number,
                'recherche' => $_POST['recherche'],
                ));
            }
    }
    
    public function search2Action(Request $request, $page, $recherche) {

            $search = '%' . $recherche . '%';
            

            $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('HBHandballBundle:Posts');

            $totalEntry = $repository->totalPostSearch($search);

            $numberPages=ceil($totalEntry/5);

            if(isset($page)) {
                $currentPage=intval($page);
 
                if($currentPage>$numberPages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
                {
                    $currentPage=$numberPages;
                }
            }
            else // Sinon
            {
                $currentPage = 1; // La page actuelle est la n°1    
            }

            $firstEntry=($currentPage - 1) * 5; // On calcul la première entrée à lire


            for($i=1; $i<=$numberPages; $i++){
                $number[] = $i;
            }

            ;

            $posts = $repository->testSearch($search);

            if($posts === array()){
                $posts = null;

                return $this->render('HBHandballBundle:view:search.html.twig', array(
                'posts' => $posts,
                ));

            }
            else{
                $posts = $repository->searchPost($search, $firstEntry);

                return $this->render('HBHandballBundle:view:search.html.twig', array(
                'posts' => $posts,
                'currentPage' => $currentPage,
                'numberPages' =>$number,
                'recherche' => $recherche,
                ));
            }
    }
}

