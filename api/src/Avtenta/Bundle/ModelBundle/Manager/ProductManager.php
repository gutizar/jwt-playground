<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Avtenta\Bundle\ModelBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Description of ProductManager
 *
 * @author danielg
 */
class ProductManager 
{
    private $class;
    private $documentManager;
    private $documentRepository;
    
    
    public function __construct(DocumentManager $documentManager, $class)
    {
    	$this->class = $class;
    	$this->documentManager = $documentManager;
    	$this->documentRepository = $documentManager->getRepository($class);
    }
    
    public function all($offset, $limit)
    {
	   return $this->documentRepository->findBy(array(), null, $limit, $offset);
    }
    
    public function get($id)
    {
	   return $this->documentRepository->find($id);
    }
}
