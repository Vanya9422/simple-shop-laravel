<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
const SUCCESS = 200;
const NOT_FOUND = 404;
const BAD_REQUEST = 400;
const UNAUTHORIZED = 401;
const ERRMESS = 'There was a problem with the system. Please try again later';
const GlobalDateFormat = 'Y-m-d H:i:s';
const StandartDateFormat = 'M d, Y';
const ImagePicsum = 'https://picsum.photos/200';

if (!function_exists('removeImage')) {
    /**
     * @param $path
     * @return bool
     */
    function removeImage($path)
    {
        return file_exists($path) ? unlink($path) : false;
    }
}

if (!function_exists('arraysSum')) {
    /**
     * @param array ...$arrays
     * @return array
     */
    function arraysSum(array ...$arrays)
    {
        return array_map(function (array $array) {
            return array_sum($array);
        }, $arrays);
    }
}


if (!function_exists('getRandomUpperCase')) {
    /**
     * @param int $length
     * @return string
     */
    function getRandomUpperCase($length = 6)
    {
        $random_string = "";
        while (strlen($random_string) < $length && $length > 0) {
            $randnum = mt_rand(0, 61);
            $random_string .= ($randnum < 10) ?
                chr($randnum + 48) : ($randnum < 36 ?
                    chr($randnum + 55) : $randnum + 61);
        }
        return $random_string;
    }
}

if (!function_exists('getRandom')) {
    /**
     * @param int $length
     * @return string
     * @throws Exception
     */
    function getRandom($length = 6)
    {
        $bytes = random_bytes($length);
        return bin2hex($bytes);
    }
}

if (!function_exists('slug_generate')) {
    /**
     * @return string
     */
    function slug_generate()
    {
        return getRandomUpperCase(7) . '-' . getRandomUpperCase(7) . '-' .
            getRandomUpperCase(7) . '-' . getRandomUpperCase(7);
    }
}

if (!function_exists('moveFile')) {
    /*** filesistem => 'root' => storage_path('app/public/'), ***/
    // moveFile('temp' . DIRECTORY_SEPARATOR . $value, $newPath . DIRECTORY_SEPARATOR . $value);
    function moveFile($old, $new)
    {
        Storage::move($old, $new);
    }
}

if (!function_exists('dateCreate')) {
    /**
     * @param $date
     * @return string
     */
    function dateCreate($date)
    {
        return Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}

if (!function_exists('dateHuman')) {
    /**
     * @param $date
     * @return string
     */
    function dateHuman($date)
    {
        return Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
    }
}

if (!function_exists('confirmationBadge')) {
    /**
     * @param $number
     * @param string $text
     * @return string
     */
    function confirmationBadge($number, string $text = 'Confirmed')
    {
        $className = $number ? 'success' : 'warning';
        return "<a href='#' class='badge badge-$className'>$text</a>";
    }
}

if (!function_exists('getPrimaryImage')) {
    /**
     * @param object $images
     * @return string
     */
    function getPrimaryImage($images)
    {
        return collect($images)->where('is_primary', '=', true)->first();
    }
}

if (!function_exists('sendEmail')) {
    /**
     * @param $emailData
     * @param string $template
     */
    function sendEmail($emailData, $template = 'emails.template')
    {
        $emailData = [];
        \Mail::send($template, $emailData, function ($message) use ($emailData) {
            $message->to($emailData['to_email']);
            $message->from($emailData['from_email'], $emailData['from_name']);
            $message->subject($emailData['subject']);
        });
    }
}

if (!function_exists('formatBytesFiles')) {
    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    function formatBytesFiles($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}


