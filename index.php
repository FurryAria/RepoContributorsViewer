<?php
// 允许跨域访问
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// 动态获取仓库链接
$repo = isset($_GET['repo']) ? $_GET['repo'] : 'FurryAria/img'; // 默认值为 'nasa/osal'
$url = "https://api.github.com/repos/{$repo}/contributors";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Aria-Contributors-Viewer'); // 关键修复点
$response = curl_exec($ch);

// 新增状态码检查
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode !== 200) {
    die("API请求失败，状态码：$httpCode 响应内容：" . $response);
}

curl_close($ch);

// 增强的错误处理
if ($response === false) {
    die('无法获取数据：' . curl_error($ch));
}

$contributors = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON解析错误: ' . json_last_error_msg());
}
if (empty($contributors)) {
    die('贡献者列表为空');
}

// 新增：解析 URL 参数
$parseLogin = isset($_GET['login']) && $_GET['login'] === 'y';
$parseHtmlUrl = isset($_GET['html_url']) && $_GET['html_url'] === 'y';
$parseContributions = isset($_GET['contributions']) && $_GET['contributions'] === 'y';

// 新增：获取自定义文本参数
$customText = isset($_GET['text']) ? htmlspecialchars($_GET['text']) : '';

// 新增：获取背景图片参数
$background = isset($_GET['background']) ? htmlspecialchars($_GET['background']) : '';
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-widdth, initial-scale=1.0">
    <title>仓库贡献者</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        body {
            padding: 2rem;
            background: var(--bg);
            /* 新增：动态设置背景图片 */
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

        /* 新增：自定义超链接样式 */
        .contributor-login a {
            color: #007bff; /* 更符合网页风格的蓝色 */
            text-decoration: none; /* 移除下划线 */
            transition: color 0.3s ease; /* 添加平滑过渡效果 */
        }

        .contributor-login a:hover {
            color: #0056b3; /* 鼠标悬停时的颜色变化 */
        }

        /* 新增：自定义文本样式 */
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
                <img class="contributor-avatar" src="https://down.npee.cn/?<?php echo htmlspecialchars($contributor['avatar_url']); ?>"
                    alt="<?php echo htmlspecialchars($contributor['login']); ?>'s avatar">
                <?php if ($parseLogin): ?>
                    <div class="contributor-name"><?php echo htmlspecialchars($contributor['login']); ?></div>
                <?php endif; ?>
                <?php if ($parseHtmlUrl): ?>
                    <div class="contributor-login">
                        <a href="<?php echo htmlspecialchars($contributor['html_url']); ?>" target="_blank">
                            @<?php echo htmlspecialchars($contributor['login']); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($parseContributions): ?>
                    <div class="contributor-contributions">贡献: <?php echo $contributor['contributions']; ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 新增：自定义文本 -->
    <?php if (!empty($customText)): ?>
        <div class="custom-text">
            <?php echo $customText; ?>
        </div>
    <?php endif; ?>

    <!--使用人数统计www-->
    <img src="https://w.saobby.com/w/vpc1lxus">
</body>

</html>