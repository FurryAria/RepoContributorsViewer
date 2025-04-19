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

### 高级示例
```bash
# 显示登录名和贡献次数
http://yourdomain.com/index.php?repo=FurryAria/RepoContributorsViewer&login=y&contributions=y

# 自定义背景和文本
http://yourdomain.com/index.php?repo=FurryAria/RepoContributorsViewer&text=RepoContributorsViewer - 仓库贡献者查看工具&background=https://example.com/space.jpg
```

## 📂 项目结构
```
GitHubApi/
├── index.php          # 主程序
├── README.md         # 自述文件
└── LICENSE           # MIT 许可证
```

## ⚙️ 依赖要求

- PHP ≥ 5.6（测试环境 PHP8.4.5 Windows）
- cURL 扩展
- 支持 HTTP/HTTPS 的服务器环境

## 📜 许可证

[MIT License](LICENSE) © FurryAria


## 其他

**FurryAria**  
[![GitHub](https://img.shields.io/badge/GitHub-Profile-blue)](https://github.com/FurryAria)


**仓库查看次数**

![](https://w.saobby.com/w/nivjzdhq)
