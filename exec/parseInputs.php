<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2 $ Wed Apr 25 00:34:10 +07 2018               #
# Original version: 0.1 (written by Future Vision)                  #
#                                                                   #
#####################################################################
# Author:                                                           #
#                                                                   #
# - Originally written by: Future Vision                            #
# - Patched by: Alex S Grebenschikov (www.poralix.com)              #
#                                                                   #
#####################################################################

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

