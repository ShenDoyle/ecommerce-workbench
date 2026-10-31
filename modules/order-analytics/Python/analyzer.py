"""订单分析器：多店铺汇总/趋势/异常检测/编码映射分析"""
import pandas as pd

class OrderAnalyzer:
    def __init__(self, df: pd.DataFrame):
        self.df = df

    def summary_by_brand(self, brand_col="brand", status_col="status"):
        return self.df.groupby([brand_col, status_col]).size().unstack(fill_value=0)

    def summary_by_store(self, store_col="store", status_col="status"):
        return self.df.groupby([store_col, status_col]).size().unstack(fill_value=0)

    def daily_trend(self, date_col="created_at"):
        dates = pd.to_datetime(self.df[date_col], errors="coerce")
        return self.df.groupby(dates.dt.date).size()

    def amount_stats(self, amount_col="amount"):
        return {"mean": self.df[amount_col].mean(), "median": self.df[amount_col].median(),
                "total": self.df[amount_col].sum(), "count": len(self.df)}

    def anomalies(self, amount_col="amount", threshold=3):
        mean = self.df[amount_col].mean()
        std = self.df[amount_col].std()
        if pd.isna(std) or std == 0:
            return self.df.iloc[0:0]
        return self.df[abs(self.df[amount_col] - mean) > threshold * std]
