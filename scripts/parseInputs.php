<?php

$_GET = Array();
$QUERY_STRING=getenv('QUERY_STRING');
if ($QUERY_STRING != "")
{
            parse_str(unhtmlentities($QUERY_STRING), $get_array);
            foreach ($get_array as $key => $value)
            {
                        $_GET[urldecode($key)] = urldecode($value);
            }
}

$_POST = Array();
$POST_STRING=getenv('POST');
if ($POST_STRING != "")
{
            parse_str(unhtmlentities($POST_STRING), $post_array);
            foreach ($post_array as $key => $value)
            {
                        $_POST[urldecode($key)] = urldecode($value);
            }
}

