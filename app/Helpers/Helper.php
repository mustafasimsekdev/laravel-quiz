<?php

namespace App\Helpers;

class Helper
{
    public static function applClasses(){
        $dataDefault = [
            'defaultLanguage'=>'tr'
        ];

        $allOptions = [
            'defaultLanguage'=>array('tr'=>'tr','en'=>'en')
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($dataDefault, config('custom.custom'));

        //if any options value empty or wrong in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (gettype($data[$key]) === gettype($dataDefault[$key])) {
                if (is_string($data[$key])) {
                    $result = array_search($data[$key], $value);
                    if (empty($result)) {
                        $data[$key] = $dataDefault[$key];
                    }
                }
            } else {
                if (is_string($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_bool($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_null($dataDefault[$key])) {
                    is_string($data[$key]) ? $data[$key] = $dataDefault[$key] : '';
                }
            }
        }

        //  above arrary override through dynamic data
        $layoutClasses = [
            'defaultLanguage'=>$allOptions['defaultLanguage'][$data['defaultLanguage']]
        ];

        // set default language if session hasn't locale value the set default language
        if(!session()->has('locale')){
            app()->setLocale($layoutClasses['defaultLanguage']);
        }
        return $layoutClasses;
    }
}
