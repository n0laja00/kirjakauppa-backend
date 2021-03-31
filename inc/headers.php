<?php 
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Accept, Content-Type, Access-Control-Allow-Header');
header('Content-type: application/json'); /*En tiedä haittaako toimivuutta */
header('Access-Control-Max-Age: 3600');

if ($_SERVER['REQUEST_METHOD'] === 'options') {
    return 0; 
}; 
