<?php
// 允许跨域访问
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 动态获取仓库链接
function getSanitizedInput($input, $default = '') {
    if (PHP_VERSION_ID >= 80100) {
        return filter_input(INPUT_GET, $input, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? $default;
    } else {
        return filter_input(INPUT_GET, $input, FILTER_SANITIZE_STRING) ?? $default;
    }
}

// 使用封装函数
$repo = getSanitizedInput('repo', 'FurryAria/img');
$url = "https://api.github.com/repos/{$repo}/contributors";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Aria-Contributors-Viewer'); 
$response = curl_exec($ch);

// 新增状态码检查
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode !== 200) {
    die("API请求失败，状态码：$httpCode 响应内容：" . $response);
}

curl_close($ch);

// 增强的错误处理
try {
    if ($response === false) {
        throw new Exception('无法获取数据：' . curl_error($ch));
    }

    if (empty($response)) {
        throw new Exception('响应数据为空');
    }

    $contributors = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('JSON解析错误: ' . json_last_error_msg());
    }
    if (empty($contributors)) {
        throw new Exception('贡献者列表为空');
    }

    // 关闭 cURL 句柄
    curl_close($ch);
} catch (Exception $e) {
    // 处理异常，记录日志或返回错误信息
    error_log($e->getMessage());
    // 可以根据需要返回错误信息或进行其他处理
    die('发生错误，请稍后重试');
}

// 新增：解析 URL 参数
$parse_login = filter_input(INPUT_GET, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS) === 'y';
$parse_html_url = filter_input(INPUT_GET, 'html_url', FILTER_SANITIZE_FULL_SPECIAL_CHARS) === 'y';
$parse_contributions = filter_input(INPUT_GET, 'contributions', FILTER_SANITIZE_FULL_SPECIAL_CHARS) === 'y';

// 新增：获取自定义文本参数
$custom_text = filter_input(INPUT_GET, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

// 新增：获取背景图片参数
$background = filter_input(INPUT_GET, 'background', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

// 新增：解析 avatar_proxy 参数
$avatar_proxy = filter_input(INPUT_GET, 'avatar_proxy', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';

// 新增：处理 avatar_proxy 参数逻辑
function getAvatarPrefix($avatar_proxy) {
    return ''; // 关闭镜像功能，始终返回空字符串
}

$avatar_prefix = getAvatarPrefix($avatar_proxy);

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>仓库贡献者</title>
    <link rel="stylesheet" href="css/index.css"><!-- 注：由于是直接用的个人主页的css，所以可能会有大量无用样式，但是懒得改了qwq -->
    <style>
        body {
            padding: 2rem;
            background: var(--bg);
            background-image: <?php echo !empty($background) ? "url('$background')" : "none"; ?>;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .contributors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .contributor-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease-out, box-shadow 0.3s ease;
        }

        .contributor-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .contributor-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .contributor-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .contributor-login {
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .contributor-contributions {
            font-size: 0.9rem;
            color: #6B7280;
        }

        .contributor-login a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contributor-login a:hover {
            color: #0056b3;
        }

        .custom-text {
            margin-top: 2rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
            font-size: 1rem;
            color: #333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="contributors-grid">
        <?php foreach ($contributors as $contributor): ?>
            <div class="contributor-card">
                <img class="contributor-avatar" src="<?php echo $avatar_prefix . htmlspecialchars($contributor['avatar_url']); ?>"
                    alt="<?php echo htmlspecialchars($contributor['login']); ?>'s avatar">
                <?php if ($parse_login): ?>
                    <div class="contributor-name"><?php echo htmlspecialchars($contributor['login']); ?></div>
                <?php endif; ?>
                <?php if ($parse_html_url): ?>
                    <div class="contributor-login">
                        <a href="<?php echo htmlspecialchars($contributor['html_url']); ?>" target="_blank">
                            @<?php echo htmlspecialchars($contributor['login']); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($parse_contributions): ?>
                    <div class="contributor-contributions">贡献: <?php echo $contributor['contributions']; ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($custom_text)): ?>
        <div class="custom-text">
            <?php echo $custom_text; ?>
        </div>
    <?php endif; ?>

    <!--使用人数统计www-->
    <img src="https://w.saobby.com/w/vpc1lxus">
</body>

</html>
