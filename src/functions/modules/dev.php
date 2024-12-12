<?php

/**
 * 変数をコンソールに出力
 *
 * @param void $args
 * @return void
 */
function console($args)
{
    ob_start();
    $var = ob_get_contents();
    ob_end_clean();
    $var = addslashes($var);
    $var = str_replace(array("\r\n", "\r", "\n"), '\n', $var);
    echo '<script>
    if (typeof(window.console) === "undefined") {
        window.console = {
            log: function(){},
        }
    }
    console.log("' . $var . '");
    </script>';
}