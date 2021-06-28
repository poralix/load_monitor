<?php
#####################################################################
# Load Monitor Plugin for Directadmin (patched version, 2018)       #
#####################################################################
#                                                                   #
# Patched version: 0.2.8 $ Thu Jun 10 14:50:40 +07 2021             #
# Original version: 0.1 (written by Future Vision)                  #
#                                                                   #
#####################################################################
# Author:                                                           #
#                                                                   #
# - Originally written by: Future Vision                            #
# - Patched by: Alex S Grebenschikov (www.poralix.com)              #
#                                                                   #
#####################################################################

$_POST = array();
$_GET = array();

# Parse input data
function parse_input()
{
    global $_POST, $_GET;
    if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')
                && isset($_SERVER['POST']) && $_SERVER['REQUEST_METHOD'])
    {
        parse_str($_SERVER['POST'], $_POST);
    }
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'])
    {
        parse_str($_SERVER['QUERY_STRING'], $_GET);
    }
    if (function_exists('magic_quotes_gpc') && get_magic_quotes_gpc())
    {
        $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
        while (list($key, $val) = each($process))
        {
            foreach ($val as $k => $v)
            {
                unset($process[$key][$k]);
                if (is_array($v))
                {
                    $process[$key][stripslashes($k)] = $v;
                    $process[] = &$process[$key][stripslashes($k)];
                }
                else
                {
                    $process[$key][stripslashes($k)] = stripslashes($v);
                }
            }
        }
        unset($process);
    }
    return true;
}

parse_input();
