<?php


class api
{
    function needValue()
    {
        die($this->response(false, "NEED_VALUES"));
    }

    function response($status, $msg)
    {
        if ($status === true) {
            $status = "success";
        } else {
            $status = "error";
        }
        $response = array("status" => $status, "value" => $msg);
        return json_encode($response);
    }
}