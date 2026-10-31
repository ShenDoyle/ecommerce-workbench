# 安装指南

## 前置条件
- Benchyard 基座 ≥ 1.0.0（feat/module-status-rbac 分支起）
- MySQL 8.0（隔离库或专用库）
- Python 3.11+（服务器端）
- PHP 8.3+

## 安装顺序
1. brand-store（品牌与店铺管理）
2. data-import（文件导入）
3. product-catalog（商品与编码）
4. ecommerce（工作台本体，requires 前三项）
5. order-analytics / inventory-logistics / task-center / system-admin（按需）

## 安装方式
控制台「模块管理」→ URL 安装 → GitHub Release zip 链接
或本地安装 → modules/ 目录放代码 → workspace:install

## Python 后台服务
cd backend/python-services && pip install -r requirements.txt
python main.py（或由调度器调用）

## 回滚
workspace:uninstall <slug> --force → 自动恢复备份 → 注册表清理
