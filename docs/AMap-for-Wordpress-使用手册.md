# AMap for WordPress 使用说明手册

> 高德地图 Elementor 自定义小组件
> 版本：1.0.9
> 更新日期：2026-05-20

---

## 目录

1. [功能概述](#1-功能概述)
2. [安装与激活](#2-安装与激活)
3. [使用指南](#3-使用指南)
4. [控制项说明](#4-控制项说明)
5. [注意事项](#5-注意事项)
6. [开发说明](#6-开发说明)
7. [版本历史](#7-版本历史)

---

## 1. 功能概述

AMap for WordPress 是一款专为 Elementor 页面编辑器设计的自定义小组件，允许用户在网页中快速插入高德地图。

### 核心功能

- 单地图插入（可添加多个实例）
- 经纬度坐标定位
- 自定义信息窗体（标题、内容）
- 自定义标记图标（支持任意图片URL）
- 高德地图导航链接一键跳转
- 地图控件开关（缩放按钮、比例尺、方向键）
- 丰富的样式自定义选项

### 系统要求

- WordPress 5.0+
- Elementor 3.0+
- Code Snippets 插件（用于激活代码）

---

## 2. 安装与激活

### 2.1 文件清单

本插件由三个代码片段文件组成：

| 文件名 | 作用 | 激活方式 |
|--------|------|----------|
| `amap-for-wordpress-v1.0.9.php.txt` | Elementor Widget 注册与控制面板定义 | Code Snippets |
| `amap-for-wordpress-v1.0.9.css.txt` | CSS 样式表（通过 wp_head 输出） | Code Snippets |
| `amap-for-wordpress-v1.0.9.js.txt` | JavaScript 逻辑（通过 wp_footer 输出） | Code Snippets |

### 2.2 激活步骤

1. 将三个 `.txt` 文件重命名为 `.php`（或直接复制内容）
2. 登录 WordPress 后台 → **代码片段** → **添加新的**
3. 将三个文件的内容分别复制粘贴到三个新的代码片段中
4. 每个片段设置：
   - **标题**：自定义（如"AMap for WordPress - PHP"）
   - **适用范围**：选择"仅前台"或"前端和后台"
   - **描述**：可选填写
5. 点击**保存更改并激活**

### 2.3 验证激活

1. 进入任意页面用 Elementor 编辑
2. 在小组件搜索栏输入"高德"或"amap"
3. 应能看到"高德地图 for Elementor"小组件

---

## 3. 使用指南

### 3.1 基础使用

1. 在 Elementor 编辑器中拖入"高德地图 for Elementor"小组件
2. 在内容面板中填写：
   - **API Key**：高德地图 Web API Key（已有默认Key，可自行申请）
   - **经度/纬度**：地图中心点坐标
   - **标题/内容**：信息窗体显示内容
3. 在样式面板中调整外观
4. 保存并预览

### 3.2 获取经纬度

1. 访问 [高德地图坐标拾取器](https://lbs.amap.com/tools/picker)
2. 在地图上点击目标位置
3. 复制显示的经纬度坐标

### 3.3 常用配置示例

**企业位置展示**
```
经度：116.510002
纬度：40.103679
缩放级别：15-17（城市级别）
显示导航链接：是
```

**精确位置展示**
```
经度：116.510002
纬度：40.103679
缩放级别：18-20（街道级别）
```

---

## 4. 控制项说明

### 4.1 API设置

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 高德地图API Key | 文本 | 9a1a87b3309e83e119707ddd46de6ef5 | 高德地图Web API Key，前往 [高德开放平台](https://lbs.amap.com/) 申请 |

### 4.2 地图设置

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 纬度 | 数字 | 40.103679 | 地图中心点纬度 |
| 经度 | 数字 | 116.510002 | 地图中心点经度 |
| 缩放级别 | 滑块 | 15 | 1=世界视图，20=街道级视图 |

### 4.3 地图控件

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 显示缩放按钮 | 开关 | 显示 | 地图右下角的+/-按钮 |
| 显示比例尺 | 开关 | 显示 | 左下角的距离比例尺 |
| 显示方向键 | 开关 | 显示 | 可拖动地图的方向控制 |

### 4.4 信息窗体

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 加载时默认打开 | 开关 | 关闭 | 页面加载时是否自动打开信息窗体 |
| 标题 | 文本 | 地点名称 | 信息窗体顶部标题 |
| 内容 | 多行文本 | 地址信息 | 支持多行，每行自动换行 |

### 4.5 标记图标

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 图标图片URL | 文本 | 高德官方红色水滴图标 | 支持PNG、JPG、SVG等格式 |
| 图标宽度 | 滑块 | 16px | 范围10-80px |
| 图标高度 | 滑块 | 0(=auto) | 设为0则等比缩放 |
| 标记动画 | 开关 | 开启 | 弹跳动画效果 |

### 4.6 导航链接

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 显示导航链接 | 开关 | 显示 | 是否显示底部导航链接 |
| 导航链接文字 | 文本 | 高德地图导航 | 导航链接显示文字 |

### 4.7 样式设置

| 控制项 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| 地图宽度 | 滑块 | 450px | 最大宽度，支持px/em/% |
| 地图高度 | 滑块 | 300px | 固定高度 |
| 圆角 | 滑块 | 0px | 地图容器圆角 |
| 链接颜色 | 颜色 | #409EFF | 导航链接颜色 |
| 链接悬停颜色 | 颜色 | #66b1ff | 鼠标悬停时颜色 |
| 信息窗体背景色 | 颜色 | #FFFFFF | 信息窗体内容区背景 |
| 信息窗体宽度 | 滑块 | 200px | 信息窗体容器宽度 |

---

## 5. 注意事项

### 5.1 API Key 使用

- 默认提供的 API Key 仅供参考，建议申请自己的 Key
- 高德地图 API 有日配额限制，高流量站点需申请付费版
- Key 申请地址：https://lbs.amap.com/

### 5.2 页面性能

- 每个地图实例都会加载高德地图API（v1.3版本）
- 建议一个页面使用不超过5个地图实例
- 地图控件（缩放、比例尺）会占用额外资源

### 5.3 标记图标

- 推荐使用透明背景的PNG或SVG图标
- 图标高度设为0时自动等比缩放
- 自定义图标URL必须是可以直接访问的图片地址

### 5.4 坐标系统

- 高德地图使用 GCJ-02 坐标系（火星坐标系）
- 与 GPS 原始坐标（WGS-84）有偏移，不可混用
- 建议使用高德坐标拾取工具获取精确坐标

### 5.5 信息窗体

- 内容支持多行输入，每行自动转换为一个段落
- 信息窗体宽高设置通过内联样式生效
- 点击标记图标可打开/关闭信息窗体

### 5.6 兼容性问题

- 确保主题没有禁用 jQuery
- 部分主题可能覆盖默认CSS样式
- 建议在多个浏览器中测试显示效果

---

## 6. 开发说明

### 6.1 文件架构

```
三个独立文件（均为PHP语法封装）:
├── amap-for-wordpress-v1.0.9.php.txt   # Widget注册 + 控制面板 + 渲染输出
├── amap-for-wordpress-v1.0.9.css.txt   # CSS样式（注入wp_head）
└── amap-for-wordpress-v1.0.9.js.txt    # JS逻辑（注入wp_footer）
```

### 6.2 PHP 文件结构详解

#### 6.2.1 Hook 注册机制

```php
// 使用init钩子确保WordPress完全加载
add_action( 'init', function() {
    // 检查Elementor是否激活
    if ( ! defined( 'ELEMENTOR_VERSION' ) ) return;
    if ( ! class_exists( '\Elementor\Widget_Base' ) ) return;

    // 在Elementor Widget注册时挂载
    add_action( 'elementor/widgets/register', function( $widgets_manager ) {
        // Widget类定义...
        $widgets_manager->register( new \Amap_For_Wordpress_Widget() );
    }, 999 ); // 高优先级确保后执行
}, 1 );
```

**关键点：**
- `init` 钩子优先级1确保WordPress核心已加载
- `elementor/widgets/register` 钩子优先级999确保后执行
- 类定义在匿名函数内部，自动注册到全局命名空间

#### 6.2.2 Widget 基类方法

```php
class Amap_For_Wordpress_Widget extends \Elementor\Widget_Base {

    // Widget唯一标识符（用于搜索）
    public function get_name() {
        return 'amap-for-wordpress';
    }

    // 显示名称
    public function get_title() {
        return '高德地图 for Elementor';
    }

    // 搜索关键词
    public function get_keywords() {
        return [ '高德地图', 'amap', '地图', 'map', 'gaode', '导航', 'location' ];
    }

    // 图标（使用Elementor内置图标）
    public function get_icon() {
        return 'eicon-map-pin';
    }

    // 所属分类
    public function get_categories() {
        return [ 'basic' ]; // basic=基础组件
    }
}
```

#### 6.2.3 控制面板定义

控制面板在 `register_controls()` 方法中定义：

```php
protected function register_controls() {
    // 创建控制区域
    $this->start_controls_section( 'section_id', [
        'label' => '区域标题',
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT, // 或 TAB_STYLE
    ] );

    // 添加控件
    $this->add_control( 'control_id', [
        'label'       => '控件标题',
        'type'        => \Elementor\Controls_Manager::TEXT, // 控件类型
        'placeholder' => '占位符',
        'default'     => '默认值',
        'condition'   => [ 'other_control' => 'value' ], // 条件显示
    ] );

    // 结束区域
    $this->end_controls_section();
}
```

**常用控件类型：**
- `TEXT`：单行文本输入
- `TEXTAREA`：多行文本输入
- `NUMBER`：数字输入
- `COLOR`：颜色选择器
- `SLIDER`：滑块
- `SWITCHER`：开关
- `SELECT`：下拉选择

#### 6.2.4 渲染输出

`render()` 方法输出HTML和配置数据：

```php
protected function render() {
    $settings = $this->get_settings_for_display();

    // 获取配置值
    $lat = $settings['amap_lat'];
    $lng = $settings['amap_lng'];

    // 输出HTML
    ?>
    <script src="//webapi.amap.com/maps?v=1.3&key=<?php echo $api_key; ?>"></script>
    <div class="amap-container" id="<?php echo $map_id; ?>"></div>

    <script>
    // 通过全局变量传递配置给JS
    window.amapConfigs.push({
        position: [<?php echo $lng; ?>, <?php echo $lat; ?>],
        // ...其他配置
    });
    </script>
    <?php
}
```

**配置传递机制：**
- PHP获取Elementor配置值
- 通过内联`<script>`将配置写入全局数组
- JS从全局数组读取并初始化地图

### 6.3 CSS 文件结构详解

```php
// 挂载到wp_head
add_action( 'wp_head', 'amap_for_wordpress_output_styles', 1 );

function amap_for_wordpress_output_styles() {
    ?>
    <style id="amap-for-wordpress-styles">
    /* CSS规则 */
    .amap-container { ... }
    .info-middle { ... }
    </style>
    <?php
}
```

**CSS选择器说明：**

| 选择器 | 作用 | 说明 |
|--------|------|------|
| `.amap-for-wordpress-widget` | 整个组件容器 | 包含地图和导航链接 |
| `.amap-container` | 地图容器 | 宽度、高度、圆角 |
| `.amap-navigation` | 导航链接容器 | 文字对齐、间距 |
| `.custom-info` | 信息窗体 | 边框、圆角 |
| `div.info-top` | 信息窗体标题栏 | 背景、边框 |
| `div.info-middle` | 信息窗体内容区 | 背景、字体 |
| `.amap-marker.animated` | 标记图标动画 | 弹跳效果 |

### 6.4 JavaScript 文件结构详解

```php
// 挂载到wp_footer
add_action( 'wp_footer', 'amap_for_wordpress_output_scripts', 1 );

function amap_for_wordpress_output_scripts() {
    ?>
    <script>
    (function() {
        'use strict';

        // 全局配置存储
        window.amapConfigs = window.amapConfigs || [];

        // 初始化单个地图
        function initAmap(config) {
            var map = new AMap.Map(config.mapId, {
                center: config.position,
                zoom: config.zoom
            });

            // 创建标记
            var marker = new AMap.Marker({
                position: config.position,
                icon: new AMap.Icon({ image: config.markerUrl })
            });
            map.add(marker);

            // 创建信息窗体
            var infoWindow = new AMap.InfoWindow({
                content: createInfoWindow(config.title, config.content)
            });

            // 点击标记打开信息窗体
            marker.on('click', function() {
                infoWindow.open(map, config.position);
            });
        }

        // 页面加载后初始化所有地图
        function initAllMaps() {
            if (typeof AMap === 'undefined') {
                setTimeout(initAllMaps, 100); // 等待API加载
                return;
            }
            window.amapConfigs.forEach(initAmap);
        }

        initAllMaps();
    })();
    </script>
    <?php
}
```

**关键实现点：**

1. **AMap API 加载检测**：高德地图API通过`<script src="//webapi.amap.com/maps?v=1.3&key=...">`异步加载，需要轮询检测`typeof AMap !== 'undefined'`

2. **多实例支持**：通过`window.amapConfigs`全局数组存储所有配置，页面加载完成后统一初始化

3. **自定义信息窗体**：使用`isCustom: true`创建自定义DOM结构的信息窗体

4. **标记动画**：通过CSS类`.animated`触发动画，使用`setTimeout`延迟添加确保DOM已渲染

### 6.5 扩展开发指南

#### 6.5.1 添加新的控制项

1. 在PHP的`register_controls()`中添加控件定义：

```php
$this->add_control(
    'amap_new_option',
    [
        'label' => '新选项',
        'type'  => \Elementor\Controls_Manager::SWITCHER,
        'default' => 'yes',
    ]
);
```

2. 在`render()`中获取值：

```php
$new_option = $settings['amap_new_option'] === 'yes' ? true : false;
```

3. 在JS配置中传递：

```php
// render()中
?>
<script>
window.amapConfigs.push({
    // ...其他配置
    newOption: <?php echo $new_option ? 'true' : 'false'; ?>
});
</script>
```

4. 在JS中使用：

```javascript
// js中
if (config.newOption) {
    // 执行相关逻辑
}
```

#### 6.5.2 添加新的样式选项

1. 在`register_controls()`中添加样式控件：

```php
$this->add_control(
    'amap_new_style',
    [
        'label'     => '新样式',
        'type'      => \Elementor\Controls_Manager::COLOR,
        'default'   => '#FF0000',
        'selectors' => [
            '{{WRAPPER}} .target-class' => 'color: {{VALUE}};',
        ],
    ]
);
```

`selectors`会自动生成CSS规则，无需额外处理。

#### 6.5.3 修改信息窗体结构

在JS的`createInfoWindow()`函数中修改DOM结构：

```javascript
function createInfoWindow(title, content) {
    var info = document.createElement('div');
    info.className = 'custom-info';

    // 添加自定义元素
    var custom = document.createElement('div');
    custom.className = 'custom-element';
    custom.innerHTML = '自定义内容';
    info.appendChild(custom);

    // ...原有代码

    return info;
}
```

### 6.6 高德地图API参考

#### 核心对象

| 对象 | 说明 |
|------|------|
| `AMap.Map(dom, options)` | 创建地图实例 |
| `AMap.Marker(options)` | 创建标记 |
| `AMap.InfoWindow(options)` | 创建信息窗体 |
| `AMap.Icon(options)` | 创建自定义图标 |
| `AMap.ToolBar` | 缩放和方向控件插件 |
| `AMap.Scale` | 比例尺控件插件 |

#### 常用方法

```javascript
map.setStatus({ dragEnable: true }); // 设置地图状态
map.add(marker);                      // 添加标记
map.addControl(toolBar);              // 添加控件
infoWindow.open(map, position);       // 打开信息窗体
map.clearInfoWindow();                // 关闭信息窗体
```

#### 坐标偏移

高德地图使用GCJ-02坐标系，与WGS-84有偏移。如需转换：
- 使用高德坐标转换API
- 或使用第三方转换库coordTransform

---

## 7. 版本历史

| 版本 | 日期 | 更新内容 |
|------|------|----------|
| v1.0.9 | 2026-05-20 | 新增信息窗体默认打开开关（默认关闭） |
| v1.0.8 | 2026-05-20 | 新增导航链接显示开关 |
| v1.0.7 | 2026-05-20 | 新增地图控件（缩放、比例尺、方向键） |
| v1.0.6 | 2026-05-20 | 图标高度支持auto（等比缩放） |
| v1.0.5 | 2026-05-20 | 新增API Key设置选项 |
| v1.0.4 | 2026-05-20 | 样式优化（信息窗体自适应高度、导航居中等） |
| v1.0.3 | 2026-05-20 | 修复信息窗体样式不生效、导航颜色不生效等问题 |
| v1.0.2 | 2026-05-20 | 新增搜索关键词、导航链接自定义 |
| v1.0.1 | 2026-05-20 | 修复Widget无法在Elementor面板搜索的问题 |
| v1.0.0 | 2026-05-20 | 初始版本 |

---

## 附录

### A. 常用图标推荐

**标记图标（红色系）：**
- 高德官方：`https://a.amap.com/lp-ui/images/poi-marker-default.png`
- 红色气泡：`https://webapi.amap.com/theme/v1.3/markers/n/mark_b.png`

**自定义图标来源：**
- [Font Awesome](https://fontawesome.com/icons)
- [Iconfont](https://www.iconfont.cn/)
- [Flaticon](https://www.flaticon.com/)

### B. 技术支持

如遇问题，请检查：
1. Code Snippets是否全部激活
2. Elementor版本是否兼容
3. 浏览器控制台是否有报错
4. API Key是否有效

---

*文档最后更新：2026-05-20*
