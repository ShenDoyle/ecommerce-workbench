"""任务模拟执行（禁止真实业务操作）"""
from enum import Enum
from datetime import datetime

class TaskStatus(str, Enum):
    PENDING = "pending"
    SIMULATING = "simulating"
    COMPLETED = "completed"
    FAILED = "failed"

class TaskSimulator:
    def __init__(self):
        self.executions: list = []

    def create(self, task_type: str, params: dict) -> dict:
        record = {"id": len(self.executions) + 1, "type": task_type,
                  "params": params, "status": TaskStatus.PENDING.value,
                  "created_at": datetime.utcnow().isoformat()}
        self.executions.append(record)
        return record

    def simulate(self, task_id: int) -> dict:
        for e in self.executions:
            if e["id"] == task_id:
                e["status"] = TaskStatus.SIMULATING.value
                e["simulated_at"] = datetime.utcnow().isoformat()
                e["result"] = f"模拟执行完成: {e['type']}"
                e["status"] = TaskStatus.COMPLETED.value
                return e
        raise ValueError(f"任务 {task_id} 不存在")

    def list_all(self) -> list:
        return self.executions
