# 接口

## 1. 概述

- UTF-8 字符编码；

## 2. 接口

### 2.1. 写入

- 功能描述：写入数据
- 请求方法：`POST`
- 请求 URI：随意
- 请求参数：无
- 请求内容：要写入的数据
- 正常响应：

```json
{
  "success": true
}
```

- 异常响应：

```json
{
  "success": false,
  "message": "..."
}
```

- 其他说明：

1. 写入内容限制在 10k 以下；
1. 数据保存时间为 24h；
1. 以下 URI 不支持写入：

- 空；
- `scan.php`；
- `scan.php?delete`；

### 2.2. 读取

- 功能描述：读取数据
- 请求方法：`GET`
- 请求 URI：写入时的 URI
- 请求参数：无
- 请求内容：无
- 正常响应：写入的数据（Header 为 JSON）
- 异常响应：

```json
{
  "success": false,
  "message": "..."
}
```

### 2.3. 扫描

- 功能描述：扫描数据过期、清理过期数据。过期时间为 24 小时。
- 请求方法：`GET`或`POST`
- 请求 URI：`/scan.php`
- 请求参数：

|  字段  | 类型 | 必选 | 取值范围 | 缺省值 | 说明                      |
| :----: | :--: | :--: | :------: | :----: | ------------------------- |
| delete |  -   | not  | 不需要值 |   无   | 过期删除标志，只 key 即可 |

- 请求内容：无
- 正常响应：

```json
[
  {
    "filename": "ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20dfg2",
    "create-at": "2021-01-12 16:22:29",
    "hours-saved": 0,
    "expired": false,
    "deleted": false
  },
  {
    "filename": "cd7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad",
    "create-at": "2021-01-12 16:22:31",
    "hours-saved": 0,
    "expired": false,
    "deleted": false
  }
]
```

- 异常响应：无
- 应用举例：

1. 扫描 `curl http://service/scan.php`；
1. 扫描并删除过期 `curl http://service/scan.php?delete`；
