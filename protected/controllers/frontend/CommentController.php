<?php
	class CommentController extends Controller{
		public $layout = "template_backend";

		public function actionIndex(){
			$comment = new Comment();
			$product_id = $_POST['product_id'];
			$data['comment'] = $comment->get_comment($product_id);
			$this->renderPartial('//comment/index',$data);
 		}

		public function actionSend_comment(){
			$columns = array(
				"comment" => $_POST['box_comment'],
				"pid" => $_POST['pid'],
				"product_id" => $_POST['product_id'],
				"d_update" => date("Y-m-d H:i:s"),
				"ip_user" => Yii::app()->request->userHostAddress
				);

			Yii::app()->db->createCommand()
				->insert("comment",$columns);
		}

		public function actionUpdate(){
			$comment = new Comment();
			$id = $_POST['id'];
			$data['comment'] = $comment->get_comment_by_id($id);
			$this->renderPartial('//comment/update',$data);
		}

		public function actionUpdate_comment(){
			$id = $_POST['id'];
			$columns = array(
				"comment" => $_POST['comment'],
				"d_update" => date("Y-m-d H:i:s")
				);

			Yii::app()->db->createCommand()
				->update("comment",$columns,"id = '$id'");
		}

		public function actionDelete(){
			$id = $_POST['id'];

			Yii::app()->db->createCommand()
				->delete("comment","id = '$id'");
		}
	}
?>