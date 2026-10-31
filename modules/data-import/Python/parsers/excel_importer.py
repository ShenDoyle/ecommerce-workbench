"""Excel 导入解析器：支持多 sheet、字段映射、校验、去重"""
import pandas as pd
from pathlib import Path
from typing import Optional

class ExcelImporter:
    def __init__(self, file_path: str):
        self.path = Path(file_path)
        self.sheets = pd.read_excel(self.path, sheet_name=None)
        self.active_sheet = list(self.sheets.keys())[0]
        self.df = self.sheets[self.active_sheet]
        self.errors: list = []
        self.warnings: list = []

    def set_sheet(self, name: str):
        if name in self.sheets:
            self.active_sheet = name
            self.df = self.sheets[name]

    def list_sheets(self):
        return list(self.sheets.keys())

    def validate(self, required_columns: list) -> bool:
        missing = [c for c in required_columns if c not in self.df.columns]
        if missing:
            self.errors.append(f"缺少必需列: {missing}")
        return len(self.errors) == 0

    def map_columns(self, mapping: dict):
        """字段映射：{原始列名: 标准列名}"""
        self.df = self.df.rename(columns=mapping)

    def deduplicate(self, keys: list):
        before = len(self.df)
        self.df = self.df.drop_duplicates(subset=keys, keep="last")
        if len(self.df) < before:
            self.warnings.append(f"去重: {before} → {len(self.df)}")

    def get_standardized(self) -> Optional[pd.DataFrame]:
        if self.errors:
            return None
        return self.df.copy()
