import pandas as pd
from analyzers.orders import OrderAnalyzer
from analyzers.inventory import InventoryAnalyzer

def test_order_summary():
    df = pd.DataFrame({"store": ["jd", "jd", "tm"], "status": ["ok", "ok", "cancel"]})
    r = OrderAnalyzer(df).summary_by_store()
    assert r.loc["jd", "ok"] == 2

def test_inventory_low_stock():
    df = pd.DataFrame({"sku": ["A", "B"], "quantity": [5, 50]})
    r = InventoryAnalyzer(df).low_stock()
    assert len(r) == 1
