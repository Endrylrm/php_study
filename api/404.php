<?php

http_response_code(404);
header('Content-Type: application/json; charset=utf-8');
echo json_encode(["error" => "404 - route not found!"]);
