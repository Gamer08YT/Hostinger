<?php


class PlatformHandle
{
    function getImg($name)
    {
        if ($name === "javascript") {
            return "assets/img/javascript.png";
        } else if ($name === "java") {
            return "assets/img/java.png";
        }
    }
}