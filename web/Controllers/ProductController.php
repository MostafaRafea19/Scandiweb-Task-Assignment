<?php

class ProductController
{
    public static function index()
    {
        $products = Product::all();
        $component = '/../components/product-list.php';
        require_once(__DIR__ . '/../Views/layouts/app.php');
    }

    public static function create()
    {
        $component = '/../components/add-product.php';
        require_once(__DIR__ . '/../Views/layouts/app.php');
    }

    public static function add()
    {
        $data = AddProductRequest::validate([
            'sku' => [
                'required' => [],
                'unique' => ['products']
            ],
            'name' => [
                'required' => [],
                'regular_expression' => ['/^[a-zA-z ]+$/']
            ],
            'price' => [
                'required' => [],
                'digits' => [],
            ],
            'type' => [
                'required' => [],
                'required_without_all' => ['size', 'weight', 'height', 'width', 'length']
            ],
            'size' => [
                'prohibited_if' => ['DVD'],
                'digits' => []
            ],
            'weight' => [
                'prohibited_if' => ['Book'],
                'digits' => []
            ],
            'height' => [
                'prohibited_if' => ['Furniture'],
                'digits' => [],
                'required_with' => ['width', 'length'],
            ],
            'width' => [
                'prohibited_if' => ['Furniture'],
                'digits' => [],
                'required_with' => ['height', 'length'],
            ],
            'length' => [
                'prohibited_if' => ['Furniture'],
                'digits' => [],
                'required_with' => ['height', 'width'],
            ],
        ]);

        if (count(AddProductRequest::getErrors()) == 0) {
            $product = new Product($data);
            $product->add();
            header('location: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']);
        } else {
            $errors = AddProductRequest::getErrors();
            $e = json_encode($errors);
            header("HTTP/1.0 422 $e", true, 422);
        }
    }

    public static function delete()
    {
        foreach ($_POST['products'] as $product) {
            $id = substr($product, 7, strlen($product) - 7);
            Product::delete(intval($id));
            header('location: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']);
        }
    }
}
