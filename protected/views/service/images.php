<style type="text/css">

    .box-img-service div {
        font-size: 0;
    }

    .box-img-service a {
        font-size: 16px;
        overflow: hidden;
        display: inline-block;
        margin-bottom: 8px;
        width: calc(50% - 4px);
        margin-right: 8px;
    }

    .box-img-service a:nth-of-type(2n) {
        margin-right: 0;
    }

    @media screen and (min-width: 50em) {
        .box-img-service a {
            width: calc(25% - 6px);
        }

        .box-img-service a:nth-of-type(2n) {
            margin-right: 8px;
        }

        .box-img-service a:nth-of-type(4n) {
            margin-right: 0;
        }
    }

    .box-img-service a:hover img {
        transform: scale(1.15);
    }

    .box-img-service figure {
        margin: 0;
    }

    .box-img-service img {
        border: none;
        max-width: 100%;
        height: auto;
        display: block;
        background: #ccc;
        transition: transform .2s ease-in-out;
    }

    .p a {
        display: inline;
        font-size: 13px;
        margin: 0;
    }

    .p {
        text-align: center;
        font-size: 13px;
        padding-top: 100px;
    }


    .thumbnail a:hover img {
        transform: scale(1.15);
    }

    .thumbnail a:nth-of-type(2n) {
        margin-right: 0;
    }

    #img-service{
        height:100px;
    }
    
    @media screen and (max-width: 800px) {
        #img-service{
            height: 200px;
        }
    }

    @media screen and (max-width: 1024px) {
        #img-service{
            height: 100px;
        }
    }
</style>

<div class="box-img-service">
    <div>
        <?php
        foreach ($datas as $rs):
            ?>

            <a class="fancybox" rel="gallery1" href="<?php echo Yii::app()->baseUrl; ?>/uploads/img_service/<?php echo $rs['images'] ?>">
                <figure>
                    <div class="img-wrapper">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/img_service/<?php echo $rs['images'] ?>" alt="" class="img-responsive" id="img-service">
                    </div>
                </figure>
            </a>
        <?php endforeach; ?>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox({
            openEffect: 'none',
            closeEffect: 'none'
        });

    });
</script>



