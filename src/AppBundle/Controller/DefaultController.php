<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig'); 
    }
    
    public function addressBookAction(Request $request)
    {
        $addressBookList = $this->get('addressBookServices')->addressBookList();
        return $this->render('default/addressBookList.html.twig',['addBooks'=>$addressBookList]);
    }
    
    public function addAddressBookAction(Request $request)
    {
        return $this->render('default/addressBookForm.html.twig',['action'=>'new']);
    }
    
    public function editAddressBookAction($id)
    {
        $addressBook = $this->get('addressBookServices')->getAddressBookById($id);
        return $this->render('default/addressBookForm.html.twig',['addBook'=>$addressBook,'action'=>'edit']);
    }
    
    public function submitAddressBookAction(Request $request,$id)
    {
        $addressBook = $this->get('addressBookServices')->updateAddressBookById($request,$id);
        return $this->redirect($this->generateUrl('_address_book'));
    }
    
    public function deleteAddressBookAction($id)
    {
        $addressBook = $this->get('addressBookServices')->deleteAddressBookById($id);

        return $this->redirect($this->generateUrl('_address_book'));
    }
}
