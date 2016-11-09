<?php

class ArticleController extends Controller {

    public $layout = "webapp";

    //public $layout = "template_product";
    public function actionIndex() {
        $Art = new Article();
        $data['count'] = $Art->Count();
        $data['article'] = $Art->Get_article_all();
        $this->render("//article/article_all", $data);
    }

    public function actionPages() {
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        $item_per_page = 12; //ให้แสดงที่ละ
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
                  FROM article
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
        $data['article'] = $rs;
        $this->renderPartial("//article/article_more", $data);
    }

    public function actionView() {
        $Art = new Article();
        $config = new Configweb_model();
        $id = $config->url_decode($_GET['id']);
        $data['result'] = $Art->Get_article_by_id($id);
        $this->render("//article/view", $data);
    }

}
