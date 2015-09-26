<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Routing\Router;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php
    echo $this->Html->meta('favicon.ico','images/logofavicon/logo.png',array('type' => 'icon'));
    ?>
    <title>WSS</title>
    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('global') ?>

    <?= $this->Html->css('flexnav') ?>
    <?= $this->Html->script('jquery.flexnav') ?>

    <?= $this->Html->script('skdslider.min') ?>
    <?= $this->Html->css('skdslider') ?>

    <?= $this->Html->css('bootstrap.min') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('jquery.easing.1.3') ?>
    <link rel="stylesheet/less" type="text/css" href= "<?= $this->Url->build('/less')?>/styles.less" />
    <?= $this->Html->script('less.js') ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
            jQuery('#demo2').skdslider({delay:5000, animationSpeed: 1000,showNextPrev:true,showPlayButton:false,autoSlide:true,animationType:'sliding'});
            jQuery('#demo3').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
            $(".flexnav").flexNav();
            jQuery('#responsive').change(function(){
                $('#responsive_wrapper').width(jQuery(this).val());
                $(window).trigger('resize');
            });
        });
    </script>
</head>
<body>
    <div id="container">
        <div id="content">
            <?= $this->fetch('content') ?>
        </div>
        <footer>
            <?= $this->element('footer');?>
        </footer>
    </div>

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
            $.src="//v2.zopim.com/?3A8TKr29plCpKbtO1ZH4ptwUlpBxtYsj";z.t=+new Date;$.
                type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->
</body>
</html>
