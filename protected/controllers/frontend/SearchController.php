<?php

class SearchController extends Controller{
    public $layout = "webapp";
    //public $layout = "template_product";
    public function actionProduct() {
        $search = $_GET['search'];
        $type_id = $_GET['type'];

        $product = new Product();

        if ($type_id != "") {
            $w1 = " type_id = '$type_id' ";
        } else {
            $w1 = " 1=1 ";
        }

        if ($search != "") {
            $w3 = " AND product_name LIKE '%$search%' ";
        } else {
            $w3 = " AND 1=1 ";
        }

        $data['product'] = $product->_get_search_product($w1, $w3);
        
        $this->render('//search/product',$data);
    }
}
