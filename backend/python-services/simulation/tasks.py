"""任务模拟执行（禁止真实业务操作）"""
from enum import Enum

class TaskStatus(str, Enum):
    PENDING = "pending"
    SIMULATING = "simulating"
    COMPLETED = "completed"
    FAILED = "failed"

class TaskSimulator:
    def __init__(self):
        self.executions = []

    def simulate(self, task_type: str, params: dict):
        record = {"type": task_type, "params": params, "status": TaskStatus.SIMULATING, "result": None}
        self.executions.append(record)
        return record
