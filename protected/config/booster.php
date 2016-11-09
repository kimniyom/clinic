<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . '/main.php'), array(
            'preload' => array('booster'),
            'aliases' => array(
                'booster' => 'application.extensions.yiibooster',
            ),
            'components' => array(
                'booster' => array(
                    'class' => 'booster.components.Booster',
                ),
            ),
                )
);
