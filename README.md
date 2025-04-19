# RepoContributorsViewer - GitHub 仓库贡献者查看工具

![GitHub](https://img.shields.io/badge/license-MIT-blue)

## 📖 项目简介

RepoContributorsViewer 是一个基于 PHP 的网页工具，用于动态获取并展示 GitHub 仓库的贡献者信息，支持多种自定义显示选项。

## ✨ 核心功能

- **实时数据获取**：通过 GitHub API 获取最新仓库贡献者信息
- **灵活显示选项**：
  - 显示贡献者登录名（`login`）
  - 显示 GitHub 主页链接（`html_url`）
  - 显示贡献次数统计（`contributions`）
- **个性化定制**：
  - 自定义背景图片
  - 底部信息文本自定义
- **响应式布局**：适配各种设备屏幕

## 🚀 快速使用指南

### 基础调用方式
```bash
https://yourdomain.com/RepoContributorsViewer.php?repo=用户名/仓库名
```

### 在线演示示例
```bash
https://something.hellofurry.cn/RepoContributorsViewer.php?repo=FurryAria/RepoContributorsViewer&login=y&html_url=y&contributions=y&text=RepoContributorsViewer%20-%20%E4%BB%93%E5%BA%93%E8%B4%A1%E7%8C%AE%E8%80%85%E6%9F%A5%E7%9C%8B%E5%B7%A5%E5%85%B7
```

### 完整参数说明

| 参数 | 类型 | 说明 | 示例值 |
|------|------|------|------|
| `repo` | 必填 | 仓库路径（格式：用户名/仓库名） | `FurryAria/img` |
| `login` | 可选 | 是否显示登录名（y/n） | `y` |
| `html_url` | 可选 | 是否显示主页链接（y/n） | `y` |
| `contributions` | 可选 | 是否显示贡献次数（y/n） | `y` |
| `text` | 可选 | 底部自定义文本（URL编码） | `欢迎使用` |
| `background` | 可选 | 背景图片URL地址 | `https://example.com/bg.jpg` |

### 典型使用场景

1. **基本贡献者查看**：
```bash
https://yourdomain.com/RepoContributorsViewer.php?repo=用户/仓库名
```

2. **显示详细贡献信息**：
```bash
https://yourdomain.com/RepoContributorsViewer.php?repo=用户/仓库名&login=y&contributions=y
```

3. **完全自定义展示**：
```bash
https://yourdomain.com/RepoContributorsViewer.php?repo=用户/仓库名&login=y&html_url=y&contributions=y&text=自定义文本&background=https://example.com/bg.jpg
```

### 嵌入到其他网页

使用 `<iframe>` 标签即可嵌入：
```html
<iframe src="https://yourdomain.com/RepoContributorsViewer.php?repo=用户/仓库名" width="100%" height="500px"></iframe>
```

## 📂 项目结构

```
/
├── RepoContributorsViewer.php    # 主程序文件
├── README.md                    # 项目文档
└── LICENSE                      # MIT 许可证文件
```

## ⚙️ 运行环境要求

- PHP ≥ 5.6（推荐 PHP 7.4+）
- cURL 扩展
- 支持 HTTPS 的服务器环境

## 📜 许可证协议

本项目采用 [MIT 许可证](LICENSE) © FurryAria

## 📊 项目访问量统计

![访问统计](https://w.saobby.com/w/nivjzdhq

