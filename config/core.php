<?php
use Cake\Routing\Router;

/**
 * All functions that not related to cakephp should be here
 */
class Core 
{
    public static function randomCode()
    {
        return mt_rand(1111111111, 9999999999) . time() . mt_rand(1111111111, 9999999999);
    }

    public static function uploadFile($file, $model, $path = null)
    {
        if (!$path) {
            $path = PATH_IMAGE_FILE;
        }
        $path .= $model.DS;
        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = time().rand(0, 1000).'.'.$extension;

        if (@move_uploaded_file($file['tmp_name'], $path.$newName))
        {
            return $newName;
        };
        return null;
    }
    public static function generateSlug($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(_| )/", '-', $str);
        $str = preg_replace("/(:|,|!|;|\"|\'|\/|\?|\]|\[|)/", '', $str);
        $str = preg_replace("/(\)|\(|)/", '', $str);
        return strtolower($str);
    }
    public static function generateUrl($params, $fullBase = false) {
        $url = '#';
        $slug = null;
        $slug = Core::generateSlug($params['name']);

        if ($slug) {
            $url = Router::url([
                'controller' => $params['controller'],
                'action' => $params['action'],
                'slug' => $slug,
                'id' => $params['id']
            ], $fullBase);
        }
        return $url;
    }
}

?>