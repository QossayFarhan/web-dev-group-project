<?php

use Model\Shift as ShiftModel;

 class ShiftController extends Controller
{
    public function shiftList()
    {
        $shift = new ShiftModel;
        $result = $shift->getShifts();

        $this->render('Views/shiftList.php', $result);
    }

    public function shiftDetails()
    {
        $success = $_REQUEST['success'] ?? null;
        $day = $_REQUEST['day'];
        $shift = new ShiftModel;
        $result = $shift->getDetails($day);
        $this->render('Views/shiftDetails.php', ['shift' => $result[0], 'success' => $success]);
    }

    public function shiftUpdate()
    {
        $day = $_REQUEST['day'];
        $startTime = $_REQUEST['start_time'];
        $endTime = $_REQUEST['end_time'];
        $breakDuration = $_REQUEST['break_duration'];
        $shift = new ShiftModel;
        $result = $shift->updateDetails($day, $startTime, $endTime, $breakDuration);

        header("Location: /".ROOT_FOLDER_NAME."/shiftDetails?success=update&day=".$day);
    }
}