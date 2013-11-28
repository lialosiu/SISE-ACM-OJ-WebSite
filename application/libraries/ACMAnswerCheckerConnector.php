<?php

class ACMAnswerCheckerConnector {
    public static function CheckPendingAnswer() {
        $fp = @fsockopen("127.0.0.1", 8384, $errno, $errstr, 30);
        if (!$fp) {
            return false;
        } else {
            fwrite($fp, "CheckPendingAnswer");
            fwrite($fp, "\n");
            fclose($fp);
            return true;
        }
    }

}