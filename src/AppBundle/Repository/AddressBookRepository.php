<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\AddressBook;

class AddressBookRepository extends EntityRepository
{
    
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function addressBookList()
    {
        $query =$this->em->createQuery('SELECT ab FROM AppBundle:addressBook ab WHERE ab.published = 1 ORDER BY ab.fName ASC');
        $addressBook = $query->getResult();
        return $addressBook;
    }
    public function getAddressBookById($id)
    {
        $query = $this->em->createQuery('SELECT ab FROM AppBundle:addressBook ab WHERE ab.published = 1 AND ab.id ='.$id);
        $addressBook = $query->getResult();
        return $addressBook[0];
    }
    
    public function updateAddressBookById($request,$id)
    {
        $time = strtotime($request->query->get('birthdate'));
        $newformat = date('Y-m-d',$time);
        
        if($id != 0){
        $qb = $this->em->createQueryBuilder('ab')
            ->update('AppBundle:AddressBook ab')
            ->set('ab.fName', ':fName')
            ->set('ab.lName', ':lName')
            ->set('ab.address', ':address')
            ->set('ab.zCode', ':zCode')
            ->set('ab.city', ':city')
            ->set('ab.country', ':country')
            ->set('ab.number', ':number')
            ->set('ab.birthdate', ':birthdate')
            ->set('ab.email', ':email')
            ->set('ab.pic', ':pic')
            ->set('ab.published', ':published')
            ->where('ab.id =:id')
            ->setParameter(':fName', $request->query->get('fname'))
            ->setParameter(':lName', $request->query->get('lname'))
            ->setParameter(':address', $request->query->get('address'))
            ->setParameter(':zCode', $request->query->get('zCode'))
            ->setParameter(':city', $request->query->get('city'))
            ->setParameter(':country', $request->query->get('country'))
            ->setParameter(':number', $request->query->get('number'))
            ->setParameter(':birthdate', $newformat)
            ->setParameter(':email', $request->query->get('email'))
            ->setParameter(':pic', $request->query->get('pic'))
            ->setParameter(':published', 1)
            ->setParameter(':id', $id);
        
            $query = $qb->getQuery();
            return $query->getResult();
        }else{
            $em          = $this->getEntityManager();

            $addressBook = new AddressBook();
            $addressBook->setFName($request->query->get('fname'));
            $addressBook->setLName($request->query->get('lname'));
            $addressBook->setAddress($request->query->get('address'));
            $addressBook->setZCode($request->query->get('zCode'));
            $addressBook->setCity($request->query->get('city'));
            $addressBook->setCountry($request->query->get('country'));
            $addressBook->setNumber($request->query->get('number'));
            $addressBook->setBirthdate($request->query->get('birthdate'));
            $addressBook->setEmail($request->query->get('email'));
            $addressBook->setPic($request->query->get('pic'));
            $addressBook->setPublished(1);
            $em->persist($addressBook);
            $em->flush();
            return $addressBook->getId();
        }

    }
    
    public function deleteAddressBookById($id)
    {
        $qb = $this->em->createQueryBuilder('ab')
            ->update('AppBundle:AddressBook ab')
            ->set('ab.published', ':published')
            ->where('ab.id =:id')
            ->setParameter(':published', -1)
            ->setParameter(':id', $id);

        $query = $qb->getQuery();
        return $query->getResult();
        
        // or
        //$qb = $this->createQueryBuilder('ab')
//            ->delete('AppBundle:AddressBook', 'ab')
//            ->where("ab.id = :id")
//            ->setParameter(':id', $id);
//        $query = $qb->getQuery();
//        return $query->getResult();
    }
}