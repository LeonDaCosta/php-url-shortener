<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
echo '{
    "enpoints" : [
        {
            "url" : "/encode/",
            "method" : "POST",
        },
        {
            "url" : "/decode/",
            "method" : "POST",
        },
    ]
}'
?>