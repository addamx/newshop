<?php

//加密cookie 防伪造cookie
function che()
{
    return jm(cookie('username') . cookie('userid') . C('COO_KIE')) === cookie('key');
}

function testt()
{
    echo 'xx';
}
