<?php

class ProductController extends Controller {

    public $layout = "webapp";
    //public $layout = "template_product";
    //################# ดึงข้อมูลรานละเอียดสินค้ามาแสดง อ้างจาก product_id ##################//
    public function actionDetail() {
        $config = new Configweb_model();
        $product_id = $config->url_decode($_GET['id']);

        $product = new Product();

        $data['images'] = $product->get_images_product($product_id);
        $data['product'] = $product->_get_detail_product($product_id);

        $data['near'] = $product->get_product_near($product_id);

        $this->render("//product/detail_product", $data);
    }

    public function actionNotify($order_id = '') {
        if ($order_id != "") {
            $data['order_id'] = $order_id;
        } else {
            $data['order_id'] = $this->session->userdata('order_id');
        }
        $head = "แจ้งชำระเงิน";
        $page = "web_system/notify"; // โหลดไปแสดงค่าโชว์แบบ popup
        $this->output_system($data, $page, $head);
    }

    public function actionSave_notify() {
        $order_id_now = $this->session->userdata('order_id');
        $order_id = $_POST['order_id'];
        $data = array(
            'order_id' => $order_id,
            'money' => $_POST['money'],
            'date_tranfer' => $_POST['date_tranfer'],
            'time_tranfer' => $_POST['time_tranfer']
        );
        $this->db->insert('notify', $data);

        // เปลี่ยนสถานะให้เป็น รอการจัดส่ง
        $data_check = array(
            'status' => '1'
        );
        $this->db->where('order_id', $order_id);
        $this->db->update('orders', $data_check);

        if ($order_id = $order_id_now) {
            $max_order_id = $this->p_db->autoId('orders', 'order_id', '7');
            $this->session->set_userdata('order_id', $max_order_id);
        }
    }

    public function actionPayments_g() {
        $head = "ช่องทางชำระเงิน";
        $page = "web_system/payments_g"; // โหลดไปแสดงค่าโชว์แบบ popup
        $this->output_system('', $page, $head);
    }

    public function actionFrom_add_bill($order_id = '') {
        $data['order_id'] = $order_id;
        $head = "ส่งหลักฐานการโอนเงิน";
        $page = "web_system/from_add_bill"; // โหลดไปแสดงค่าโชว์แบบ popup
        $this->output_system($data, $page, $head);
    }

    public function actionFrom_search_product() {
        $data['product_type'] = $this->product->_get_product_type();
        $head = "ข้อมูลสินค้า";
        $page = "web_system/from_search_product"; // โหลดไปแสดงค่าโชว์แบบ popup
        $this->output_webapp($data, $page, $head);
    }

    public function actionSearch_product() {
        $type_id = $_POST['type_id'];
        $product_name = $_POST['search_txt'];

        if ($type_id != "") {
            $w1 = " t.type_id = '$type_id' ";
        } else {
            $w1 = " 1=1 ";
        }

        if ($product_name != "") {
            $w3 = " AND p.product_name LIKE '%$product_name%' ";
        } else {
            $w3 = " AND 1=1 ";
        }

        $data['product'] = $this->product->_get_search_product($w1, $w3);
        $this->load->view('web_system/show_search_product', $data);
    }

    public function actionFrom_print_bill($order_id = '') {
        $data['order_id'] = $order_id;
        $page = "web_system/from_print_bill";
        $head = "พิมพ์ใบแจ้งโอนเงิน";

        $this->output_system($data, $page, $head);
    }

    public function actionPrint_bill($order_id = '') {
        $data['bill'] = $this->product->print_bill($order_id);
        $data['order_id'] = $order_id;
        $member = $this->session->userdata('member');
        $data['name'] = $member->pername . $member->name . "-" . $member->lname;

        $this->load->view('web_system/print_bill', $data);
    }

    public function actionView() {
        $config = new Configweb_model();
        $prodult = new Product();

        $type_id = $config->url_decode($_GET['type']);
        $data['type_id'] = $type_id;
        $data['type_name'] = $prodult->get_type_name($type_id);
        $data['product'] = $prodult->get_product_all($type_id);
        $data['count_product_type'] = $prodult->get_count_product_type($type_id);

        $this->render("//product/show_product_all", $data);
    }

    public function actionPages() {
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        $type_id = $_POST["type_id"];
        $item_per_page = 6; //ให้แสดงที่ละ
        //throw HTTP error if page number is not valid
        if (!is_numeric($page_number)) {
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }

        //get current starting point of records
        $position = ($page_number * $item_per_page);

        //Limit our results within a specified range.
        //$results = mysqli_query($connecDB, "SELECT id,name,message FROM paginate ORDER BY id DESC LIMIT $position, $item_per_page");
        $query = "SELECT *
                  FROM product
                  WHERE type_id = '$type_id' AND status != '1' AND delete_flag != '1'
                  ORDER BY id DESC LIMIT $position, $item_per_page";
        $rs = Yii::app()->db->createCommand($query)->queryAll();
        //output results from database
        /*
          echo '<ul class="page_result">';
          foreach ($rs as $row) {
          echo '<li id="item_' . $row["id"] . '"><span class="page_name">' . $row["id"] . ') ' . $row["product_name"] . '</span><span class="page_message">' . $row["product_name"] . '</span></li>';
          }
          echo '</ul>';
         *
         */

        $data['product'] = $rs;
        
        $this->renderPartial("//product/product_more", $data);
    }

}
