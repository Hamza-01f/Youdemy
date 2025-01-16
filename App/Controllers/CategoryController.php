<?php

namespace App\Controllers;

require_once __DIR__.'/../models/Category.php';

use  App\Models\Category;

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    
    public function getCategories()
    {
        return $this->categoryModel->getCategories();
    }

    public function addCategory($name)
    {
        if (empty($name)) {
            return "Category name is required.";
        }

        $result = $this->categoryModel->addCategory($name);
        return $result ? "Category added successfully!" : "Failed to add category.";
    }


    public function updateCategory($id, $name)
    {
        if (empty($name)) {
            return "Category name is required.";
        }

        $result = $this->categoryModel->updateCategory($id, $name);
        return $result ? "Category updated successfully!" : "Failed to update category.";
    }

   
    public function deleteCategory($id)
    {
        $result = $this->categoryModel->deleteCategory($id);
        return $result ? "Category deleted successfully!" : "Failed to delete category.";
    }
}
