<?php
/**
 * Created by PhpStorm.
 * User: krasn
 * Date: 06.06.2017
 * Time: 11:16
 */

namespace vendor\core\components;


class Cache
{
    /**
     * @param $folder
     * @param $key
     * @param $data
     * @param int $time
     * @return bool
     */
    public function setCache($folder, $key, $data, $time=3600)
    {
        $folder = ROOT_FOLDER . '/cache/'.$folder;
        if ( !is_dir( $folder ) ) {
            mkdir( $folder );
        }
        $content['data'] = $data;
        $content['end_time'] = time() + $time;

        if(file_put_contents($folder.'/'.md5($key).'.txt', serialize($content))){
            return true;
        }

        return false;
    }

    /**
     * @param $folder
     * @param $key
     * @return bool
     */
    public function getCache($folder, $key)
    {
        $file = ROOT_FOLDER . '/cache/'.$folder.'/'.md5($key).'.txt';
        if ( file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if ($content['end_time']>=time()){
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    /**
     * @param $folder
     * @param $key
     * @return bool
     */
    public function deleteCache($folder, $key)
    {
        $file = ROOT_FOLDER . '/cache/'.$folder.'/'.md5($key).'.txt';
        if ( file_exists($file)) {
            unlink($file);
            return true;
        }
        return false;
    }

    /**
     * @param $folder
     * @return bool
     */
    public function deleteCacheFolder($folder)
    {
        $folder = ROOT_FOLDER . '/cache/'.$folder;
        $files = array_diff(scandir($folder), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$folder/$file")) ? $this->deleteCacheFolder("$folder/$file") : unlink("$folder/$file");
        }
        return rmdir($folder);
    }



}