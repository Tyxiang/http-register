# HTTP Register

## 1. 概述

- HTTP 服务；
- 路径任意；
- 内容任意；
- POST 写入；
- GET 读取；

## 2. 用途

- 智能设备状态中转；
- Web 开发后端模拟；

## 3. 接口

- [接口定义](doc/interface.md)

## 4. 技术实现

### 4.1. 写入

- 将 url hash 后作为文件名；
- body 内容作为文件内容；
- 写入文件；

### 4.2. 读取

- 将 url hash 后作为文件名；
- 读取文件；
- 返回文件内容；