<?php

class TypeproductController extends Controller {

    public $layout = "template_backend";

    //############################################## produce_type #######################################/
    public function actionFrom_add_type($upper = null) {
        $type = new Type_product();
        $config = new Configweb_model();
        $data['type_id'] = $config->autoId("product_type", "type_id", "3");
        $data['type'] = $type->Get_all($upper);
        $data['upper'] = $upper;
        $data['uppername'] = ProductType::model()->find("id = '$upper' ")['type_name'];
        $this->render("//type/create", $data);
    }

    public function actionSave_type() {
        $columns = array(
            'type_id' => $_POST['type_id'],
            'type_name' => $_POST['type_name'],
            'upper' => $_POST['upper'],
            'sublevel' => $_POST['level'],
            'active' => '1'
        );

        Yii::app()->db->createCommand()
                ->insert("product_type", $columns);
    }

    public function actionEdit($id = null,$upper = null) {
        $type = new Type_product();

        $result = $type->find("id = '$id' ");
        //$data['typeall'] = $type->findAll();
        $data['upper'] = $upper;
        $data['uppername'] = ProductType::model()->find("id = '$upper' ")['type_name'];
        $data['type'] = $result;
        $this->render('//type/edit', $data);
    }

    public function actionSave_edit_type() {
        $data = array(
            'type_name' => $_POST['type_name'],
            //'upper' => $_POST['upper'],
            'sublevel' => $_POST['level'],
            //'active' => $_POST['active'],
        );
        
        Yii::app()->db->createCommand()
                ->update("product_type", $data, "id = '" . $_POST['id'] . "' ");
    }

    public function del_produce_type() {
        $type_id = $_POST['type_id'];
        /*
          $sql = "
          SELECT p.images
          FROM produce p INNER JOIN produce_brand b ON p.brand_id = b.brand_id
          INNER JOIN produce_type t ON b.type_id = t.type_id
          WHERE t.type_id = '$type_id' AND p.images != ''
          ";
         * 
         */
        $query = "SELECT produce_id FROM produce WHERE type_id = '$type_id' ";
        $product = $this->db->query($query);
        foreach ($product->result() as $pro) {
            $sql = "SELECT images FROM produce_images WHERE produce_id = '$pro->produce_id' ";
            $result = $this->db->query($sql);

            /* ลบรูภาพที่อยู่ใน type นี้ออกทั้งหมด */
            if (!empty($result)) {
                foreach ($result->result() as $datas):
                    unlink('uploads/' . $datas->images);
                endforeach;
            }
            $this->db->where('produce_id', $pro->produce_id);
            $this->db->delete('produce_images');
        }

        /* สั่งลบตารางสินค้าที่อยู่ในประเภทนี้ */
        $this->db->where('type_id', $type_id);
        $this->db->delete('produce');

        /* สั่งลบประเภทสินค้า */
        $this->db->where('type_id', $type_id);
        $this->db->delete('produce_type');
        //echo $this->p_db->refresh('web_system/menager_produce/show_produce_type', 'Delete produce_type SuccessFull...');
    }

    public function show_produce($brand_id = '', $type_name = '', $brand_name = '') {
        $deta['type_name'] = $type_name;
        $deta['brand_name'] = $brand_name;
        $deta['type'] = $this->produce->_get_produce_type();
        $deta['produce'] = $this->produce->_get_produce($brand_id);
        $page = "web_system/admin/show_produce";
        if ($this->session->userdata('status') == 'A') {
            $head = "สินค้าในระบบ";
        } else {
            $head = "ข้อมูลสินค้า";
        }

        $this->output_system($deta, $page, $head);
    }
    
    public function actionCheckproduct(){
        $type = Yii::app()->request->getPost('type_id');
        $sql = "SELECT COUNT(*) AS total FROM product WHERE type_id = '$type' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        echo $result['total'];
    }
    
    public function actionDelete(){
        $type = Yii::app()->request->getPost('type_id');
        Yii::app()->db->createCommand()
                ->delete("product_type","type_id = '$type' ");
    }

}
