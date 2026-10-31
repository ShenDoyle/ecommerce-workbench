from validators.sku_validator import validate_bj_code, validate_jd_code, validate_bom

def test_bj_valid():
    assert validate_bj_code("LPJBJ001")
    assert not validate_bj_code("INVALID")

def test_jd_valid():
    assert validate_jd_code("LPJJD001")
    assert not validate_jd_code("BAD")

def test_bom_valid():
    assert validate_bom({"LPJBJ001": 2}) == []
    assert len(validate_bom({"BAD": 0})) == 2
