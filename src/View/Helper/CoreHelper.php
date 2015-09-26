<?php

namespace App\View\Helper;

use Cake\Core\App;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\View\Helper;
use Cake\View\View;

/**
 * @property Helper|void Form
 * @property  Settings
 * @property  Settings
 */
class CoreHelper extends Helper {

    var $helpers = array('Form', 'Html');

    public function active($entity, $field)
    {
        $formStart = $this->Form->create(null, ['url' => ['action' => 'set_active', $field], 'class' => 'hw-active']);
        $idHidden = $this->Form->hidden('id', ['value' => $entity->id]);
        $formEnd = $this->Form->end();
        $checkbox = $this->Form->checkbox($field, ['class' => 'onoffswitch-checkbox', 'id' => 'inline_'.$entity->id.'_'.$field, 'checked' => $entity->$field]);
        $spanContainer = '
            <span class="onoffswitch">
                '.$idHidden.$checkbox.'
                <label class="onoffswitch-label" for="inline_'.$entity->id.'_'.$field.'">
                    <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        ';

        return $formStart.$spanContainer.$formEnd;
    }

    /**
     * @param $path | path of image 'images/abc.jpg' for 'webroot/upload/images/abc.jpg'
     * @param $dst_w | width of image cache
     * @param $dst_h | height of image cache
     * @param array $htmlAttributes | attributes of image
     * @param bool $fancybox | set true to use fancybox
     * @param bool $pathImage | set true to return path image
     * @return string
     */
    function image($path, $dst_w, $dst_h, $htmlAttributes = array(), $fancybox = false, $pathImage = false) {

        $imageTypes = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp", 'jpg'); // used to determine image type

        $extension = pathinfo(basename($path), PATHINFO_EXTENSION);

        //type images
        if (in_array(strtolower($extension), $imageTypes)) {
            $optionDefault = array(
                'alt' => basename($path)
            );
            $htmlAttributes = array_merge($optionDefault, $htmlAttributes);

            $url = PATH_IMAGE_FILE.$path;

            if (!is_file($url)) {
                debug('Image not found!');
                return null;
            }

            list($w, $h, $type) = getimagesize($url);
            $r = $w / $h;
            $dst_r = $dst_w / $dst_h;

            if ($r > $dst_r) {
                $src_w = $h * $dst_r;
                $src_h = $h;
                $src_x = ($w - $src_w) / 2;
                $src_y = 0;
            } else {
                $src_w = $w;
                $src_h = $w / $dst_r;
                $src_x = 0;
                $src_y = ($h - $src_h) / 2;
            }

            $relFile = '../upload/cache_image/'.$dst_w.'-'.$dst_h.'-'.basename($path); // relative file
            $cacheFile = PATH_IMAGE_FILE.'cache_image'.DS.$dst_w.'-'.$dst_h.'-'.basename($path);

            if (file_exists($cacheFile)) {
                if (@filemtime($cacheFile) >= @filemtime($url)) {
                    $cached = true;
                } else {
                    $cached = false;
                }
            } else {
                $cached = false;
            }

            if (!$cached) {
                if (!is_dir(PATH_IMAGE_FILE.'cache_image')) {
                    @mkdir(PATH_IMAGE_FILE.'cache_image', 0777, true);
                }
                $image = call_user_func('imagecreatefrom'.$imageTypes[$type], $url);
                if (function_exists("imagecreatetruecolor")) {
                    $temp = imagecreatetruecolor($dst_w, $dst_h);
                    imagealphablending($temp, true);
                    imagesavealpha($temp, true);
                    imagefill($temp,0,0,0x7fff0000);
                    imagecopyresampled($temp, $image, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
                } else {
                    $temp = imagecreate ($dst_w, $dst_h);
                    imagefill($temp,0,0,0x7fff0000);
                    imagecopyresized($temp, $image, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
                }
                call_user_func("image".$imageTypes[$type], $temp, $cacheFile);
                imagedestroy($image);
                imagedestroy($temp);
            }
            if ($pathImage) {
                return $relFile;
            }


            $imageReturn = $this->Html->image($relFile, $htmlAttributes);
            if ($fancybox) {
                $imageReturn = '<a class="fancybox" href="'.Router::url('/upload/'.$path).'">'.$imageReturn.'</a>';
            }
        } else { // file
            $imageReturn = $this->Html->image('core/hw_default_file.png', array(
                'style' => 'max-width:'.$dst_w.'px; max-height: '.$dst_h.'px'
            ));
        }
        if (isset($htmlAttributes['deleteUrl']) && $htmlAttributes['deleteUrl']) {
            $url = $htmlAttributes['deleteUrl'];
            if (is_array($htmlAttributes['deleteUrl'])) {
                $url = Router::url($htmlAttributes['deleteUrl']);
            }
            $imageReturn .= '<a class="hw-delete-link" href="'.$url.'"><i class="icon-close"></i></a>';
        }

        $imageReturn = '<div class="hw-image">'.$imageReturn.'</div>';

        return $imageReturn;
    }

    public function setting($field)
    {
        $this->Settings = TableRegistry::get('Settings');
        $settings = $this->Settings->find()->first();

        return $settings ? $settings->$field : null;
    }
}
?>