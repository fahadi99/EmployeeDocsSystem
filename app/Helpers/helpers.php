<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function getAssetsURLs($part = '')
{
    return url('assets/'.$part);
}

function d($data, $exit = true) {
    echo "<pre>";
    print_r($data);

    if($exit)
        exit;
}

function getPaginationFrom($page, $perPage) {
    return (($page - 1) * $perPage) + 1;
}

function getPaginationTo($page, $perPage, $total) {
    $r = ($page * $perPage);
    return $r > $total ? $total : $r;
}


function getComplateDate($date) {
    if($date) {
        return date('d M, Y g:i a', strtotime($date));
    }
}

function getDocumentTypeImage ($image, $returnPath = true) {
    $dir = 'images/';
    if ($image == '' || !File::exists($dir . $image) ) {
        $path = url("images/no-image.png");
        $rtn = false;
    } else {
        $path = url($dir . $image);
        $rtn = true;
    }

    return $returnPath ? $path : $rtn;
}

function titleFilter($title)
{
    return str_replace('_', ' ', ucfirst($title));
}

function getBasicDateFormat($date, $format = 'jS \of F Y') {
    return date($format, strtotime($date));
}

function getBasicTimeFormat($date, $format = 'h:i A') {
    return date($format, strtotime($date));
}

function getBasicDateTimeFormat($date, $format = 'jS M Y h:i A') {
    return date($format, strtotime($date));
}

function getRemainingTime($dated, $rtnMin = false, $currentTime = false ) {
    if($currentTime === false)
        $currentTime = time();

    $meetingRemainingTime = floor((strtotime($dated) - $currentTime) / (60));


    if($rtnMin === false)
        return getMeetingDuration($meetingRemainingTime );
    else
        return $meetingRemainingTime;

}

function getBasicMYSQLFormat($date) {
    return date("Y-m-d H:i:s", strtotime($date));
}


function getMeetingDuration($duration) {
    $rtn = "";
    $hours = floor($duration / 60);


    if($hours > 0) {
        $rtn .= $hours . " hours";
        $min = $duration - ($hours * 60);
        if($min > 0)
            $rtn .= " and " . floor($min) . " minutes";


    } else {
        $rtn .= $duration . " minutes";
    }


    return $rtn;
}

function getMeetingFinishTime($time, $min) {
    $time = strtotime('+' .$min. ' minutes', strtotime($time));
    return date('jS \of F Y h:i A', $time);
}

function getDirectionLink($latitude, $longitude) {
    //return 'https://www.google.pl/maps/dir//' . $latitude . ',' . $longitude;
    //return "https://www.google.com/maps?saddr=My+Location&daddr=" . $latitude . ",". $longitude;
    return "http://www.google.com/maps/place/" . $latitude . "," . $longitude;
}

function getMeetingStatuses () {
    return [0 => ['pending', 'Pending'], 1 => ['coming', 'Coming'], 2 => ['maybe', 'Maybe' ], 3 => ['notcoming', 'Not Coming']];
}

function getMeetingStatusesId ($status) {

    foreach(getMeetingStatuses() as $key=>$value) {
        if($status == $value[0]) {
            return $key;
        }
    }
    return false;
}


function ErrorMessageForCheckLoginUser() {

    $withMessage = [
        'Status' => 404,
        'hasPopup' => true,
        'messageTitle' => "Permission denied",
        'messageData' => "You don't have permission to access that page",
    ];

    $now = Carbon::now()->getTimestamp(); //

    return redirect()->route('login', ['t' => $now]);
}

function ErrorMessage($type=403, $rtnType = 'redirect') {
    switch($type) {
        case 403:
            $withMessage = [
                'Status' => 403,
                'hasPopup' => true,
                'messageTitle' => "Permission denied",
                'messageData' => "You don't have permission to access that page",
            ];
            if($rtnType == 'redirect')
                return redirect('/403')->with($withMessage);
            break;
        case 404:
            $withMessage = [
                'Status' => 404,
                'hasPopup' => true,
                'messageTitle' => "Page not found",
                'messageData' => "Opps, Something went wrong",
            ];
            if($rtnType == 'redirect')
                return redirect('/404')->with($withMessage);
            break;
        case 'login':
            $withMessage = [
                'Status' => 404,
                'hasPopup' => true,
                'messageTitle' => "Session Expired",
                'messageData' => "Login again to proceed.",
            ];
            if($rtnType == 'redirect')
                return redirect('/login')->with($withMessage);
            break;
    }

    return response()->json($withMessage);
}

function ErrorMessageJson($messageData = false) {
    if($messageData === false)
        $messageData = 'You don\'t have permission to access that page';
    return response()->json(['status' => 403,'message' => $messageData ]);
}

function getMeetingStatusesWord ($statusId) {
    return getMeetingStatuses()[$statusId][1];
}

function getMeetingJoinURL($code) {
    return URL::to('web/link/' . $code . '?action=join_meeting');
}

function getPersonRibbon( $isAdmin) {

        switch ($isAdmin) {
            case 1:
                $rtn = "<span class=\"ribbon-inner bg-primary\"></span><strong>User</strong>";
                break;
            case 2:
                $rtn = "<span class=\"ribbon-inner bg-info\"></span><strong>Admin</strong>";
                break;
            case 3:
                $rtn = "<span class=\"ribbon-inner bg-danger\"></span><strong>Root</strong>";
                break;
            default:
                $rtn = '';
        }
    return $rtn;
}

function getPersonImage($image, $returnPath = true) {
    $dir = \App\Models\Person::getProfileImageDir();
    if ($image == '' || !File::exists($dir . $image) ) {
        $path = url("images/no-image.png");
        $rtn = false;
    } else {
        $path = url($dir . $image);
        $rtn = true;
    }

    return $returnPath ? $path : $rtn;
}


function getDomainImage($image, $returnPath = true) {
    $dir = \App\Models\Domain::getDomainImageDir();
    if ($image == '' || !File::exists($dir . $image) ) {
        $path = url("images/no-image.png");
        $rtn = false;
    } else {
        $path = url($dir . $image);
        $rtn = true;
    }

    return $returnPath ? $path : $rtn;
}

function getProjectPermissions($memberId) {
    return \App\Models\Project::getProjectPermissions($memberId);
}
function checkPersonPermission($per, $perString = false) {

   if(auth()->user()->person_type == 3 )
        return true;

    $per = is_array($per)
        ? $per[0] . "-" . $per[1] . '-' .$per[2]
        : $per;

    if($perString === false)
        $perString = session()->get('rights');
    $per = '|' . $per . '|';
    //d($perString);
    return Str::of($perString)->contains($per);
}

function checkPersonPermissionExit($per, $perString = false) {
    checkPersonPermission($per, $perString) ? true : exit;
}


function makeSlug($str) {
    return Str::slug($str, '-');
}


function getSpaceTypes($id = false) {
    $spaceType = [
        '0' => 'Default',
        '1' => 'Transfer & Record',
    ];

    if($id === false)
        return $spaceType;
    else
        return $spaceType[$id];
}

function DefaultSpace() {

        $spaceType = '0';

        return $spaceType;

}




function getStatus($id = false) {
    $status = [
        '1' => ['Active', 'success'],
        '2' => ['Archived', 'warning'],
        '3' => ['Deleted', 'danger']
    ];

    if($id === false)
        return $status;
    else
        return $status[$id];
}

function generateHash($str) {
    return hash('sha256', $str);
}

function getFileLogo($ext) {
    switch($ext) {
        case 'jpg':
            return "jpg.svg";
            break;
        case 'png':
            return "png.svg";
            break;
        case 'gif':
            return "gif.svg";
            break;

        case 'pdf':
            return "pdf.svg";
            break;
        case 'doc':
            return "doc.svg";
            break;
        case 'docx':
            return "dox.svg";
            break;
        case 'csv':
            return "csv.svg";
            break;
        default:
            return "folder.svg";
    }
}

function getDefaultText($description) {
    return "No " . $description . " Provided";
}

function getFileTypes() {
    return [
        'text' => 'text',
        'email' => 'email',
        'tel' => 'tel',
        'password' => 'password',
        'textarea' => 'textarea',
        'date' => 'date',
        'time' => 'time',
        'number' => 'number',
        'month' => 'month',
        'range' => 'range',
    ];
}

function getShareDocumentPermissionStrings() {
    return [
        'Assignees' => 'assignees',
        'Comments' => 'comments',
        'Files' => 'files',
    ];
}

function getShareDocumentDurations() {
    return [
        'Hour' => 'hour',
        'Day' => 'day',
        'Month' => 'month',
    ];
}

function getRequiredSpan() {
    return '<span class="required text-danger">*</span>';
}

function getImageMime() {
    return [
        'image/jpeg',
        'image/gif',
        'image/png',
        'image/tiff',
    ];
}

function checkImage($mimetype) {
    return in_array($mimetype, getImageMime());
}

function getViewType() {
    return [
        'view',
        'view-watermark',
        'download',
    ];
}

function validateViewType($viewtype) {
    return in_array($viewtype, getViewType());
}

function checkFileDisability($search_include) {
    return ($search_include == '' || $search_include == 'files') ? false : true;
}

function get_move_file_id() {
    return session('file_id', false);
}

function get_excel_date_to_MYSQL($date) {
    if($date) {
        $dayval = $date;
        $date = new \DateTime('1899-12-31');
        $date->modify("+$dayval day -1 day");
        return $date->format('Y-m-d');
    } else {
        return null;
    }
}

function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

function genSSH512($datetime)
{
    $salt = \Str::random(12);
    $value = base64_encode(hash('sha512', $datetime.$salt, true).$salt);
    //only allowing alpha numberic through a generated string
    $result = preg_replace("/[^a-zA-Z0-9]+/", "", $value);
    return  $result ;
}
