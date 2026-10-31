"""订单只读分析"""
import pandas as pd

class OrderAnalyzer:
    def __init__(self, df: pd.DataFrame):
        self.df = df

    def summary_by_store(self, store_col="store", status_col="status"):
        return self.df.groupby([store_col, status_col]).size().unstack(fill_value=0)

    def daily_trend(self, date_col="created_at"):
        self.df[date_col] = pd.to_datetime(self.df[date_col], errors="coerce")
        return self.df.groupby(self.df[date_col].dt.date).size()

    def anomalies(self, amount_col="amount", threshold=3):
        mean = self.df[amount_col].mean()
        std = self.df[amount_col].std()
        outliers = self.df[abs(self.df[amount_col] - mean) > threshold * std]
        return outliers
