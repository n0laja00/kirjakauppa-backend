<?php
header('Access-Control_allow_origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true'); 
header('Access-Control-Allow-methods: POST, GET, OPTIONS, DELETE');
header('Access-Control-Allow-Headers: Accept, content-Type, Access-Control-Allow-Header'); 
header('Content-type: application/json');
header('Access-Control-Max-Age: 3600');

if ($_server['REQUEST_METHOD'] === 'options') {
    return 0;
}
