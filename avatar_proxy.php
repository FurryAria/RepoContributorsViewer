<?php
// avatar_proxy.php

// 安全校验：只允许从 index.php 发起的请求
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'index.php') === false) {
    header('HTTP/1.1 403 Forbidden');
    die('Forbidden');
}

// 获取 URL 参数
$url = isset($_GET['url']) ? $_GET['url'] : '';

// 简单的 URL 校验：只允许 http 和 https 协议
if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL) || !in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https'])) {
    header('HTTP/1.1 400 Bad Request');
    die('Invalid URL');
}

// 发起请求获取头像内容
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Aria-Contributors-Viewer'); 
$response = curl_exec($ch);

// 检查请求是否成功
if ($response === false) {
    header('HTTP/1.1 500 Internal Server Error');
    die('Failed to fetch avatar');
}

// 获取响应头信息
$headers = curl_getinfo($ch);
curl_close($ch);

// 设置正确的 Content-Type
header('Content-Type: ' . $headers['content_type']);
header('Cache-Control: max-age=86400'); // 缓存一天

// 输出头像内容
echo $response;
?>