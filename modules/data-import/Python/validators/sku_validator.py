"""SKU 校验器：BJ码/JD码/组合装 BOM"""
import re

BJ_PATTERN = re.compile(r'^LPJBJ\d{3}$')
JD_PATTERN = re.compile(r'^LPJJD\d{3}$')

def validate_bj_code(code: str) -> bool:
    return bool(BJ_PATTERN.match(code))

def validate_jd_code(code: str) -> bool:
    return bool(JD_PATTERN.match(code))

def validate_bom(bom_dict: dict) -> list:
    """BOM 校验：{bj_code: qty} 全部为合法 BJ 码且数量 > 0"""
    errors = []
    for code, qty in bom_dict.items():
        if not validate_bj_code(code):
            errors.append(f"BJ码格式错误: {code}")
        if not isinstance(qty, (int, float)) or qty <= 0:
            errors.append(f"数量非法: {code}={qty}")
    return errors
