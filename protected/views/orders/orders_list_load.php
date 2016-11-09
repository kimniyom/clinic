
<table width="100%" class="table table-bordered" id="font-20">
    <thead>
        <tr>
            <td>#</td>
            <td>รูป</td>
            <td>สินค้า</td>
            <td style="text-align: center;">ราคา</td>
            <td style="text-align: center;">จำนวน</td>
            <td style="text-align: center;">ราคารวม</td>
            <td style="text-align: center;">ลบ</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalall = 0;
        $i = 1;
        $product_model = new Product();
        $web = new Configweb_model();
        foreach ($product as $products):
            $img_title = $product_model->get_images_product_title($products['product_id']);
            if (!empty($img_title)) {
                $img = "uploads/product_thumb/" . $img_title['images'];
            } else {
                $img = "images/No_image_available.jpg";
            }
            $link = Yii::app()->createUrl('frontend/product/detail/id/'.$web->url_encode($products['product_id']));
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td style=" width: 10%;">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img; ?>" class="img-resize img-thumbnail" width="100%"/>
                </td>
                <td>
                    <a href="<?php echo $link ?>" target="_blank"><?= $products['product_name']; ?></a>
                </td>
                <td style=" text-align: right;"><?= number_format($products['product_price']); ?></td>
                <td style="text-align: center;"><?= $products['product_num']; ?></td>
                <td style="text-align: right;"><?= number_format(($products['product_price'] * $products['product_num']), 2); ?></td>
                <td style=" text-align: center;">
                    <div class="btn btn-danger btn-xs" onclick="del_list_order('<?= $products['id'] ?>');" id="del" title="ลบสินค้าออกจากตะกร้า">
                        <i class="fa fa-remove"></i>
                    </div>
                </td>
                <?php
                $total = (($products['product_price'] * $products['product_num']));
                $totalall = $totalall + $total;
                ?>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5" align="center"><font style="text-decoration:underline;">รวม </font></td>
            <td style=" text-align: right;"><font style="text-decoration:underline;"><?= number_format($totalall, 2) ?></font> </td>
            <td></td>
        </tr>

        <tr>
          <td colspan="7">
            เลือกวิธีขนส่ง
            <?php
            $ts = $model->get_transport_in_order($order_id);
            $price_transport = $ts['price'];
            ?>
          </td>
        </tr>
        <?php foreach($transport as $rs):
          if($ts['transport'] == $rs['id']){
            $checked = "checked='checked'";
          } else {
            $checked = "";
          }
          ?>
          <tr>
            <td colspan="6"><?php echo $rs['detail']?> <?php echo $rs['price']?> บาท</td>
            <td style=" text-align: center;">
              <input type="radio" name="transport" id="transport" <?php echo $checked;?> onclick="set_active_transport('<?php echo $rs['id']?>','<?php echo $order_id?>')"/>
            </td>
          </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr style="color:#ff3300;">
          <td colspan="7" align="center">
            <p class="well" id="font-rsu-22">
              ราคาสุทธิ ค่าสินค้า + ค่าจัดส่ง <?= number_format($totalall + $price_transport, 2) ?> บาท
            </p>
          </td>
      </tr>
    </tfoot>
</table>
