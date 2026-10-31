import pandas as pd
from parsers.importer import ImportJob

def test_csv_load():
    df = pd.DataFrame({"sku": ["A1", "A2"], "qty": [1, 2]})
    df.to_csv("/tmp/test_import.csv", index=False)
    job = ImportJob("/tmp/test_import.csv", "order").load()
    assert len(job.df) == 2

def test_validate_missing_column():
    df = pd.DataFrame({"sku": ["A1"]})
    df.to_csv("/tmp/test_v.csv", index=False)
    job = ImportJob("/tmp/test_v.csv", "order").load()
    assert not job.validate(["sku", "price"])

def test_deduplicate():
    df = pd.DataFrame({"sku": ["A1", "A1", "A2"], "qty": [1, 2, 3]})
    df.to_csv("/tmp/test_d.csv", index=False)
    job = ImportJob("/tmp/test_d.csv", "order").load().deduplicate(["sku"])
    assert len(job.df) == 2
