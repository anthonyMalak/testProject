<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\AddressBook;

class addressBookServices
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function addressBookList()
    {
        $addressBookList = $this->em->getRepository(AddressBook::class)->addressBookList();
        return $addressBookList;
    }
    
    public function getAddressBookById($id)
    {
        $addressBook = $this->em->getRepository(AddressBook::class)->getAddressBookById($id);
        return $addressBook;
    }
    
    public function updateAddressBookById($request,$id)
    {
        $addressBookList = $this->em->getRepository(AddressBook::class)->updateAddressBookById($request,$id);
        return $addressBookList;
    }
    
    public function deleteAddressBookById($id)
    {
        $addressBook = $this->em->getRepository(AddressBook::class)->deleteAddressBookById($id);
        return $addressBook;
    }
}