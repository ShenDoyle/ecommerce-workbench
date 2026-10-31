"""文件导入解析器：CSV/XLSX → 标准化 DataFrame → 校验 → 入库"""
import pandas as pd
from pathlib import Path

class ImportJob:
    def __init__(self, file_path: str, import_type: str):
        self.path = Path(file_path)
        self.type = import_type
        self.df = None
        self.errors = []
        self.warnings = []

    def load(self):
        if self.path.suffix == ".csv":
            self.df = pd.read_csv(self.path)
        elif self.path.suffix in (".xlsx", ".xls"):
            self.df = pd.read_excel(self.path)
        else:
            raise ValueError(f"不支持的文件类型: {self.path.suffix}")
        return self

    def validate(self, required_columns: list):
        missing = [c for c in required_columns if c not in self.df.columns]
        if missing:
            self.errors.append(f"缺少必需列: {missing}")
        return len(self.errors) == 0

    def deduplicate(self, keys: list):
        before = len(self.df)
        self.df = self.df.drop_duplicates(subset=keys, keep="last")
        if len(self.df) < before:
            self.warnings.append(f"去重: {before} → {len(self.df)}")
        return self
