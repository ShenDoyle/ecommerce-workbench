"""库存与物流分析器"""
import pandas as pd

class InventoryAnalyzer:
    def __init__(self, df: pd.DataFrame):
        self.df = df

    def low_stock(self, qty_col="quantity", threshold=10):
        return self.df[self.df[qty_col] < threshold]

    def negative_stock(self, qty_col="quantity"):
        return self.df[self.df[qty_col] < 0]

    def by_warehouse(self, wh_col="warehouse", qty_col="quantity"):
        return self.df.groupby(wh_col)[qty_col].sum()
