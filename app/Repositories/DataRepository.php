<?php
namespace App\Repositories;

use PHPHtmlParser\Dom;

class DataRepository
{
    public function getData($url, $selector)
    {
        $baseUrl = 'https://www.appliancesdelivered.ie/search';
        $dom = new Dom();
        $dom->load($baseUrl.$url);
        return $dom->find($selector);
    }

    public function hasChanged($current, $new)
    {
        foreach($new as $key => $value) {
            if ($current->{$key} != str_replace(array('€', '&euro;', ','), '', $new[$key])) {
                $current->{$key} = $new[$key];
                $current->save();
            }
        }
    }

}