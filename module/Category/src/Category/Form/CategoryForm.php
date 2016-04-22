<?php
/**
 *@author : Manish Gadhock
 *@date : 30-06-2014
 *@desc : Category Form class
 */

namespace Category\Form;

use Zend\Form\Form;



class CategoryForm extends Form 
{
	public function __construct($name = null)
	{
		parent::__construct('album');
		$this->url = $name;

		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden'	
		));

        $this->add(array(
			'name' => 'name',
			'type' => 'Text',
			'options' => array(
			    'label' => 'Category Name',
		    ),
		    'attributes' => array(
            	 'id'    => 'name'
            )		
		));

		$this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Add',
                'id'    => 'submitbutton'
            )
        ));
	}



}