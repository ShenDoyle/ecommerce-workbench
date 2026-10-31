"""电商工作台 Python 后台服务入口（文件解析/标准化/校验/分析/模拟）"""
import sys
from parsers.importer import ImportJob
from analyzers.orders import OrderAnalyzer
from analyzers.inventory import InventoryAnalyzer
from simulation.tasks import TaskSimulator

if __name__ == "__main__":
    print("ecommerce-workbench backend service")
