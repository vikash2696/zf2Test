<?php

namespace Category\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Category\Model\Category;
use Category\Form\CategoryForm;
use Zend\Json\Json; 

class CategoryController extends AbstractActionController
{
    protected $categoryTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'categories' => $this->getCategoryTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
    	$catform = new CategoryForm();
        $request = $this->getRequest();  // getting current request object
        if ($request->isPost()) {
            $category = new Category();
            
            $catform->setInputFilter($category->getInputFilter());
            $catform->setData($request->getPost());  // setting requested data to form object


            if ($form->isValid()) {
                
                $category->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($category);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }

        }

        $viewmodel = new ViewModel(array(
    							'form' => $catform
    								));
    	$viewmodel -> setTerminal(true); 
        return $viewmodel;
    }

    public function editAction()
    {
        $catid = $this->params()->fromQuery('catid');

        echo $catid;
        //die;
        $viewmodel = new ViewModel(array(
        							'catid'=>$catid
        						));
    	$viewmodel -> setTerminal(true); 
        return $viewmodel;
    }


    public function listAction()
    {
        return new ViewModel(array(
            'categories' => $this->getCategoryTable()->fetchAll(),
        ));
    }

    public function deleteAction()
    {
        $viewmodel = new ViewModel();
    	$viewmodel -> setTerminal(true); 
        return $viewmodel;
    }


    public function getCategoryTable()
    {
        if (!$this->categoryTable) {
			
			$serviceManager   = $this->getServiceLocator();
            
            $this->categoryTable = $serviceManager->get('Category\Model\CategoryTable');

        }
        return $this->categoryTable;
    }

/* deleting category from database  */
    public function deleteCategoryAction()
    {

        $request = $this->getRequest();
         if ($request->isPost()) {
            $id = (int) $request->getPost('id');

            $this->getCategoryTable()->deleteCategory($id);

            $response = $this->getResponse();
            $response->setContent(
                Json::encode(array(
                    'status'=> 0 )));
            return $response;


         }
    }



}


