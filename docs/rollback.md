# 回滚方案

## 文件回滚
WorkspaceBackup 自动备份 modules/<slug>/ 代码 → 失败自动恢复

## 数据库回滚
migrate:reset --path=<模块迁移路径> → 数据不自动清除（安全默认）

## DDL 半成品
MySQL DDL 非事务——失败后残留表需人工 DROP（upgrade 命令会输出残留表清单）

## 回滚验证
restore 前检查 backup.sha256 → 损坏拒绝恢复
