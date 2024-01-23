<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ZoomHelper;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\Meeting_invitation;
use App\MeetingZoom;
use App\WebLink;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuestLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }


    function web_link(Request $request, $code) {

        $withMessage = [];

        $status = $request->has('status') ? $request->status : false;

        $action = $request->has('action') ? $request->action : false;

        $webLink = WebLink::getLink($code);

        if($webLink) {
            $person = Person::getPerson($webLink->person_id);

            $meeting = Meeting::getMeetingDetailByPerson($webLink->type_id, $person->id);
            if($person && $meeting) {
                if($status !== false) {

                    $status = getMeetingStatusesId($status);

                    $r = Meeting_invitation::changeStatus($status, $person->id, $webLink->type_id);
                    if($r) {
                        $withMessage = [
                            'hasPopup' => true,
                            'messageType' => 'success',
                            'messageTitle' => $meeting->title . " [Status Updated]",
                            'messageData' => "Your meeting invitation  has been updated successfully to " . getMeetingStatusesWord($status) .
                                              ". You can change the status later from meeting detail page.",
                            ];
                    }
                }


                if($action !== false) {
                    if($action == 'join_meeting') {
                        if($meeting) {

                            if($meeting->location == 1) {
                                $currentTime = time();

                                $meetingTime = strtotime($meeting->dated);
                                $meetingRemainingTime = ($meetingTime - $currentTime) / (60);


                                if($meetingRemainingTime >= config('settings.meetings.min_before_can_join')) {
                                    $withMessage = [
                                        'hasPopup' => true,
                                        'messageType' => 'warning',
                                        'messageTitle' => "It's too early to join meeting",
                                        'messageData' => "The meeting \"". $meeting->title ."\" will take place on " .
                                            getBasicDateFormat($meeting->dated) .", starting at " . getBasicTimeFormat($meeting->dated) .
                                            " and expected to finish in " . getMeetingDuration($meeting->duration) .
                                            ". There is still " . getRemainingTime($meeting->dated) . " left",
                                    ];

                                } else if($meetingRemainingTime + $meeting->duration + config('settings.meetings.min_grace_time') > 0) {

                                    $meetingZoom = MeetingZoom::getByMeetingId($meeting->meeting_id);



                                    if($meetingZoom) {

                                        $id = $meetingZoom->zoom_meeting_id;
                                        //$zoomID = $meetingZoom->;

                                        $additional['zoom_account_id'] = $meetingZoom->id;
                                        $additional['ZOOM_Host_UserId'] = $meetingZoom->email;
                                        $additional['ZOOM_JWT_Token'] = $meetingZoom->accessToken;
                                        $data = ZoomHelper::getMeeting($meetingZoom->zoom_meeting_id, $additional);

                                        // @Todo we need to log information in some table that who and when someone joined.

                                        if($meeting->host_id == $person->id)
                                            return Redirect::to($data->start_url);
                                        else
                                            return Redirect::to($data->join_url);


                                    } else {
                                        $withMessage = [
                                            'hasPopup' => true,
                                            'messageType' => 'danger',
                                            'messageTitle' => "Something went wrong",
                                            'messageData' => "There is some issue at server side, Try again, if issue remain kindly drop an email to " . config('settings.emails.error_email')
                                        ];
                                    }


                                } else {
                                    $withMessage = [
                                        'hasPopup' => true,
                                        'messageType' => 'danger',
                                        'messageTitle' => "It's too late to join the meeting",
                                        'messageData' => "The meeting \"". $meeting->title ."\" expired. It took place on " .
                                            getBasicDateFormat($meeting->dated) .", started at " . getBasicTimeFormat($meeting->dated) .
                                            " and finished at " .  getMeetingFinishTime($meeting->dated, $meeting->duration) . " +-" . config('settings.meetings.min_grace_time') . " mintntes"
                                    ];
                                }
                            }
                        }
                    }

                }

                if($person->is_guest == 1) {
                    Auth::logout();
                    Auth::loginUsingId($person->id);
                    return $this->goToType($webLink->type, $webLink->type_id)->with($withMessage);
                } else {
                    if(Auth::user() === null) {
                        return $this->goToLogin()->with($withMessage);
                    } else {
                        if(Auth::user()->id == $person->id) {
                            return $this->goToType($webLink->type, $webLink->type_id)->with($withMessage);
                        } else {
                            Auth::logout();
                            return $this->goToLogin()->with($withMessage);
                        }
                    }
                }
            } else {
                redirect('unauthorized');
            }
        }
        return redirect('expired');
    }

    function goToType($type, $type_id) {
        if($type == 1)
            return redirect('meetings/' . $type_id);
        return redirect('unauthorized');
    }

    function goToLogin() {
        return redirect('login');
    }
}
