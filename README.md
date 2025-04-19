# RepoContributorsViewer
RepoContributorsViewer - 仓库贡献者查看工具（PHP）

# GitHub 仓库贡献者查看器

一个基于 PHP 的网页工具，动态获取并展示 GitHub 仓库贡献者信息，支持多种自定义显示选项。

![GitHub](https://img.shields.io/badge/license-MIT-blue)

## ✨ 功能特性

- **动态数据获取**：通过 GitHub API 实时获取仓库贡献者信息
- **自定义显示选项**：
  - 显示登录名（`login`）
  - 显示 GitHub 主页链接（`html_url`）
  - 显示贡献次数（`contributions`）
- **个性化设置**：
  - 自定义背景图片
  - 底部自定义文本
  - 头像代理支持（防止原始链接失效）
- **跨域支持**：可轻松嵌入其他网页
- **响应式设计**：适配不同屏幕尺寸

## 🚀 快速开始

### 基础使用
```bash
http://yourdomain.com/index.php?repo=FurryAria/RepoContributorsViewer
```

### 直接在线使用
```bash
https://something.hellofurry.cn/RepoContributorsViewer.php?repo=用户/仓库名&login=y&html_url=y&contributions=y&text=RepoContributorsViewer%20-%20%E4%BB%93%E5%BA%93%E8%B4%A1%E7%8C%AE%E8%80%85%E6%9F%A5%E7%9C%8B%E5%B7%A5%E5%85%B7
```

## 示例
```bash
https://something.hellofurry.cn/RepoContributorsViewer.php?repo=FurryAria/RepoContributorsViewer&login=y&html_url=y&contributions=y&text=RepoContributorsViewer%20-%20%E4%BB%93%E5%BA%93%E8%B4%A1%E7%8C%AE%E8%80%85%E6%9F%A5%E7%9C%8B%E5%B7%A5%E5%85%B7
```

### 参数说明
| 参数 | 类型 | 说明 | 示例 |
|------|------|------|------|
| `repo` | string | 仓库路径（用户/仓库名） | `?repo=FurryAria/img` |
| `login` | y/n | 显示登录名 | `?login=y` |
| `html_url` | y/n | 显示主页链接 | `?html_url=y` |
| `contributions` | y/n | 显示贡献次数 | `?contributions=y` |
| `text` | string | 底部自定义文本（可选） | `?text=欢迎访问` |
| `background` | URL | 背景图片地址（可选） | `?background=https://example.com/bg.jpg` |
| `avatar_proxy` | y/local/自定义镜像/空白（空白为用户直接加载GitHub原头像链接） | 头像代理模式 | `?avatar_proxy=y` |

### 高级示例
```bash
# 显示登录名和贡献次数，并启用公共镜像代理（请勿滥用！）
http://yourdomain.com/index.php?repo=FurryAria/RepoContributorsViewer&login=y&contributions=y&avatar_proxy=y

# 自定义背景、文本及本地PHP头像代理（本地PHP代理通过 avatar_proxy.php 文件作为代理返回头像内容（注：如果大量请求且服务器禁止搭建镜像网站服务器可能会被封禁！）
http://yourdomain.com/index.php?repo=FurryAria/RepoContributorsViewer&text=RepoContributorsViewer - 仓库贡献者查看工具&background=https://example.com/space.jpg&avatar_proxy=local

# 使用自定义镜像链接（需用单引号包裹）
http://yourdomain.com/index.php?repo=FurryAria/RepoContributorsViewer&avatar_proxy='https://mirror.example.com/?'
```

## 📂 项目结构
```
GitHubApi/
├── index.php          # 主程序
├── avatar_proxy.php   # 本地头像代理脚本
├── index_local.php    # 无任何代理的网页，强制用户本地加载GitHub头像
├── README.md          # 自述文件
└── LICENSE            # MIT 许可证
```

## ⚙️ 依赖要求

- PHP ≥ 5.6（测试环境 PHP8.4.5 Windows）
- cURL 扩展
- 支持 HTTP/HTTPS 的服务器环境


## 📜 更新日志

### [1.1.0] - 2025-4-20
- **新增功能**：
  - ✨ 支持头像代理配置 (`avatar_proxy`)，可选模式：
    - `y`: 使用公共镜像代理 (`https://down.npee.cn/?`)
    - `local`: 通过本地 `avatar_proxy.php` 代理（高风险场景需谨慎）
    - 自定义镜像：使用单引号包裹镜像地址 (如 `'https://mirror.example.com/?url='`)

### [1.0.0] - 2025-4-19
- 初始版本发布
  - ✅ 动态获取 GitHub 仓库贡献者数据
  - ⚙️ 支持基础参数：`login`/`html_url`/`contributions`
  - 🎨 自定义背景图片与底部文本

## 📜 许可证

[MIT License](LICENSE) © FurryAria

---

## 其他

**FurryAria**  
[![GitHub](https://img.shields.io/badge/GitHub-Profile-blue)](https://github.com/FurryAria)

**仓库查看次数**


![](https://w.saobby.com/w/nivjzdhq)
