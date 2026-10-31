# 架构
基于 Benchyard 模块体系。电商工作台为独立 workbench（type=workbench），各功能模块为挂靠插件（type=plugin, host=ecommerce）。
数据层：MySQL（服务器端）+ Python 后台任务（文件解析/标准化/校验/分析/模拟）+ 文件存储（本地导入）。
