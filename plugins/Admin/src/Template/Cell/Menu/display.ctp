<?php use Cake\Core\Configure;?>
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

<!-- User info -->
<div class="login-info">
    <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

        <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
            <?php
                echo $this->Html->image('../admin/img/avatars/male.png', array('class'=>'online'))
            ?>
            <span>
                <?= $this->CurUser->first_name.' '.$this->CurUser->last_name ?>
            </span>
            <i class="fa fa-angle-down"></i>
        </a>

    </span>
</div>
<!-- end user info -->

<!-- NAVIGATION : This navigation is also responsive-->
<nav>
    <ul>
        <?php
        $request = array(
            'plugin' => strtolower($this->request->plugin),
            'controller' => $this->request->controller,
            'action' => $this->request->action,
            'admin' => strtolower($this->request->plugin) == 'admin' ? true : false
        );
        foreach ($menus as $name => $params) {
            $class = null;
            $url = '#';
            $hasSub = $active = false;
            if (isset($params['child'])) {
                $hasSub = true;
            }
            if ($params['url']) {
                $url = $params['url'];
                if (strtolower($request['controller']) == $params['url']['controller'] && strtolower($request['action']) == $params['url']['action']) {
                    $class .= ' open active ';
                    $active = true;
                }
            }

            echo '<li class="' . $class . '">';
            echo '<a  href="' . $this->Url->build($url) . '">';
            echo '<i class="fa ' . $params['icon'] . '"></i>';
            echo '<span class="menu-item-parent">';
            echo __($name);
            echo '</span>';
            echo '</a>';
            if ($hasSub) {
                echo '<ul>';
                foreach ($params['child'] as $nameSub => $subParams) {
                    $class = null;
                    if ($subParams['url'] && strtolower($this->request->controller) == $subParams['url']['controller'] /*&& $this->request->action == $subParams['url']['action']*/) {
                        $class = 'active';
                    }
                    $url = $subParams['url'] ? $subParams['url'] : '#';
                    echo '<li class="' . $class . '">';
                    echo $this->Html->link(/*'<i class="fa '.$subParams['icon'].'"></i>&nbsp;'.*/__($nameSub), $url, ['escape' => false]);
                    echo '</li>';
                }
                echo '</ul>';
            }
            echo '</li>';
            echo '</li>';
        }
        ?>

    </ul>
</nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>
<!-- END NAVIGATION -->