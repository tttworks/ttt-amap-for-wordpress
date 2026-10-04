<?php
/**
 * Snippet Name: Amap for WordPress - Elementor Widget (PHP)
 * Description: 高德地图Elementor自定义小组件
 * Version: 1.0.9
 * Author: -
 * Last Updated: 2026-05-20
 * 
 * Version History:
 * v1.0.9 (2026-05-20) - 新增信息窗体默认打开开关，默认关闭
 * v1.0.8 (2026-05-20) - 新增导航链接显示开关
 * v1.0.7 (2026-05-20) - 新增地图控件
 * v1.0.6 (2026-05-20) - 图标高度支持auto
 * v1.0.5 (2026-05-20) - 新增API Key设置
 * v1.0.4 (2026-05-20) - 样式优化
 * v1.0.3 (2026-05-20) - 修复问题
 * v1.0.2 (2026-05-20) - 新增功能
 * v1.0.1 (2026-05-20) - 修复Widget无法在Elementor面板搜索的问题
 * v1.0.0 (2026-05-20) - 初始版本
 */

add_action( 'init', function() {
    if ( ! defined( 'ELEMENTOR_VERSION' ) ) return;
    if ( ! class_exists( '\Elementor\Widget_Base' ) ) return;

    add_action( 'elementor/widgets/register', function( $widgets_manager ) {

        class Amap_For_Wordpress_Widget extends \Elementor\Widget_Base {

            public function get_name() {
                return 'amap-for-wordpress';
            }

            public function get_title() {
                return '高德地图 for Elementor';
            }

            public function get_keywords() {
                return [ '高德地图', 'amap', '地图', 'map', 'gaode', '导航', 'location' ];
            }

            public function get_icon() {
                return 'eicon-map-pin';
            }

            public function get_categories() {
                return [ 'basic' ];
            }

            protected function register_controls() {

                $this->start_controls_section(
                    'amap_section_api',
                    [
                        'label' => 'API设置',
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'amap_api_key',
                    [
                        'label'       => '高德地图API Key',
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => '输入您的高德地图Web API Key',
                        'default'     => '9a1a87b3309e83e119707ddd46de6ef5',
                        'description' => '使用您自己的高德地图API Key，前往 <a href="https://lbs.amap.com/" target="_blank">高德开放平台</a> 申请',
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_map',
                    [
                        'label' => '地图设置',
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'amap_lat',
                    [
                        'label'       => '纬度 (Latitude)',
                        'type'        => \Elementor\Controls_Manager::NUMBER,
                        'placeholder' => '40.103679',
                        'default'     => '40.103679',
                    ]
                );

                $this->add_control(
                    'amap_lng',
                    [
                        'label'       => '经度 (Longitude)',
                        'type'        => \Elementor\Controls_Manager::NUMBER,
                        'placeholder' => '116.510002',
                        'default'     => '116.510002',
                    ]
                );

                $this->add_control(
                    'amap_zoom',
                    [
                        'label'   => '缩放级别',
                        'type'    => \Elementor\Controls_Manager::SLIDER,
                        'range'   => [
                            'min' => 1,
                            'max' => 20,
                        ],
                        'default' => [
                            'size' => 15,
                        ],
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_controls',
                    [
                        'label' => '地图控件',
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'amap_show_zoom',
                    [
                        'label'   => '显示缩放按钮',
                        'type'    => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => '显示',
                        'label_off' => '隐藏',
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );

                $this->add_control(
                    'amap_show_scale',
                    [
                        'label'   => '显示比例尺',
                        'type'    => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => '显示',
                        'label_off' => '隐藏',
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );

                $this->add_control(
                    'amap_show_toolbar',
                    [
                        'label'   => '显示方向键',
                        'type'    => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => '显示',
                        'label_off' => '隐藏',
                        'return_value' => 'yes',
                        'default' => 'yes',
                        'description' => '方向键可拖动地图位置',
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_info',
                    [
                        'label' => '信息窗体',
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'amap_show_info',
                    [
                        'label'   => '加载时默认打开',
                        'type'    => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => '开启',
                        'label_off' => '关闭',
                        'return_value' => 'yes',
                        'default' => '',
                        'description' => '关闭后，信息窗体仅在点击标记时打开',
                    ]
                );

                $this->add_control(
                    'amap_title',
                    [
                        'label'       => '标题',
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => '输入信息窗体标题',
                        'default'     => '地点名称',
                    ]
                );

                $this->add_control(
                    'amap_content',
                    [
                        'label'      => '内容',
                        'type'       => \Elementor\Controls_Manager::TEXTAREA,
                        'placeholder' => '输入信息窗体内容，支持换行',
                        'default'    => '地址信息',
                        'rows'       => 3,
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_marker',
                    [
                        'label' => '标记图标',
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'amap_marker_url',
                    [
                        'label'       => '图标图片URL',
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => 'https://example.com/marker.png',
                        'default'     => 'https://a.amap.com/lp-ui/images/poi-marker-default.png',
                    ]
                );

                $this->add_control(
                    'amap_marker_width',
                    [
                        'label'      => '图标宽度',
                        'type'       => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [ 'min' => 10, 'max' => 80 ],
                        ],
                        'default' => [
                            'size' => 16,
                            'unit' => 'px',
                        ],
                    ]
                );

                $this->add_control(
                    'amap_marker_height',
                    [
                        'label'      => '图标高度',
                        'type'       => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [ 'min' => 10, 'max' => 100 ],
                        ],
                        'default' => [
                            'size' => 0,
                            'unit' => 'px',
                        ],
                        'description' => '设为0为自动高度（等比缩放）',
                    ]
                );

                $this->add_control(
                    'amap_marker_animation',
                    [
                        'label'   => '标记动画',
                        'type'    => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => '开启',
                        'label_off' => '关闭',
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_nav',
                    [
                        'label' => '导航链接',
                        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'amap_show_nav',
                    [
                        'label'   => '显示导航链接',
                        'type'    => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => '显示',
                        'label_off' => '隐藏',
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ]
                );

                $this->add_control(
                    'amap_nav_text',
                    [
                        'label'       => '导航链接文字',
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => '高德地图导航',
                        'default'     => '高德地图导航',
                        'condition'   => [
                            'amap_show_nav' => 'yes',
                        ],
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_style_map',
                    [
                        'label' => '地图样式',
                        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    ]
                );

                $this->add_control(
                    'amap_width',
                    [
                        'label'      => '地图宽度',
                        'type'       => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px', 'em', '%' ],
                        'range'      => [
                            'px' => [ 'min' => 200, 'max' => 1200 ],
                            'em' => [ 'min' => 10, 'max' => 80 ],
                            '%'  => [ 'min' => 50, 'max' => 100 ],
                        ],
                        'default' => [
                            'size' => 450,
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .amap-container' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'amap_height',
                    [
                        'label'      => '地图高度',
                        'type'       => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px', 'em' ],
                        'range'      => [
                            'px' => [ 'min' => 100, 'max' => 800 ],
                            'em' => [ 'min' => 10, 'max' => 50 ],
                        ],
                        'default' => [
                            'size' => 300,
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .amap-container' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'amap_border_radius',
                    [
                        'label'      => '圆角',
                        'type'       => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [ 'min' => 0, 'max' => 50 ],
                        ],
                        'default' => [
                            'size' => 0,
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .amap-container' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_style_nav',
                    [
                        'label' => '导航样式',
                        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    ]
                );

                $this->add_control(
                    'amap_nav_color',
                    [
                        'label'     => '链接颜色',
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'default'   => '#409EFF',
                        'condition' => [
                            'amap_show_nav' => 'yes',
                        ],
                    ]
                );

                $this->add_control(
                    'amap_nav_hover_color',
                    [
                        'label'     => '链接悬停颜色',
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'default'   => '#66b1ff',
                        'condition' => [
                            'amap_show_nav' => 'yes',
                        ],
                    ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                    'amap_section_style_info',
                    [
                        'label' => '信息窗体样式',
                        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                    ]
                );

                $this->add_control(
                    'amap_info_bg',
                    [
                        'label'     => '背景色',
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'default'   => '#FFFFFF',
                    ]
                );

                $this->add_control(
                    'amap_info_width',
                    [
                        'label'      => '信息窗体宽度',
                        'type'       => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [ 'min' => 150, 'max' => 400 ],
                        ],
                        'default' => [
                            'size' => 200,
                            'unit' => 'px',
                        ],
                    ]
                );

                $this->end_controls_section();

            }

            protected function render() {
                $settings = $this->get_settings_for_display();

                $map_id      = 'amap_' . uniqid();
                $nav_id      = 'navigation_' . uniqid();
                $api_key     = esc_attr( $settings['amap_api_key'] );
                $zoom        = isset( $settings['amap_zoom']['size'] ) ? intval( $settings['amap_zoom']['size'] ) : 15;
                $lat         = isset( $settings['amap_lat'] ) ? floatval( $settings['amap_lat'] ) : 0;
                $lng         = isset( $settings['amap_lng'] ) ? floatval( $settings['amap_lng'] ) : 0;
                $show_zoom   = $settings['amap_show_zoom'] === 'yes' ? true : false;
                $show_scale  = $settings['amap_show_scale'] === 'yes' ? true : false;
                $show_toolbar = $settings['amap_show_toolbar'] === 'yes' ? true : false;
                $show_info   = $settings['amap_show_info'] === 'yes' ? true : false;
                $show_nav    = $settings['amap_show_nav'] === 'yes' ? true : false;
                $title       = esc_html( $settings['amap_title'] );
                $content     = $settings['amap_content'];
                $content     = wpautop( $content, false );
                $content     = str_replace( [ "\r\n", "\r", "\n" ], '<br>', $content );
                $content     = stripslashes( $content );
                $nav_text    = esc_html( $settings['amap_nav_text'] );
                $marker_url  = esc_url( $settings['amap_marker_url'] );
                $marker_width  = isset( $settings['amap_marker_width']['size'] ) ? intval( $settings['amap_marker_width']['size'] ) : 16;
                $marker_height = isset( $settings['amap_marker_height']['size'] ) ? intval( $settings['amap_marker_height']['size'] ) : 0;
                $marker_animation = $settings['amap_marker_animation'] === 'yes' ? true : false;
                $nav_color      = isset( $settings['amap_nav_color'] ) ? esc_attr( $settings['amap_nav_color'] ) : '#409EFF';
                $nav_hover_color = isset( $settings['amap_nav_hover_color'] ) ? esc_attr( $settings['amap_nav_hover_color'] ) : '#66b1ff';
                $info_bg   = isset( $settings['amap_info_bg'] ) ? esc_attr( $settings['amap_info_bg'] ) : '#FFFFFF';
                $info_width = isset( $settings['amap_info_width']['size'] ) ? intval( $settings['amap_info_width']['size'] ) : 200;

                ?>
                <script src="//webapi.amap.com/maps?v=1.3&key=<?php echo $api_key; ?>"></script>
                <div class="amap-for-wordpress-widget" data-nav-color="<?php echo $nav_color; ?>" data-nav-hover-color="<?php echo $nav_hover_color; ?>" data-info-bg="<?php echo $info_bg; ?>" data-info-width="<?php echo $info_width; ?>">
                    <div id="<?php echo esc_attr( $map_id ); ?>" class="amap-container"></div>
                    <?php if ( $show_nav ) : ?>
                    <p id="<?php echo esc_attr( $nav_id ); ?>" class="amap-navigation"></p>
                    <?php endif; ?>
                </div>

                <script type="text/javascript">
                    (function() {
                        window.amapConfigs = window.amapConfigs || [];
                        window.amapConfigs.push({
                            mapId:           '<?php echo $map_id; ?>',
                            navId:           '<?php echo $show_nav ? $nav_id : ''; ?>',
                            position:        [<?php echo $lng; ?>, <?php echo $lat; ?>],
                            zoom:            <?php echo $zoom; ?>,
                            showZoom:        <?php echo $show_zoom ? 'true' : 'false'; ?>,
                            showScale:       <?php echo $show_scale ? 'true' : 'false'; ?>,
                            showToolbar:     <?php echo $show_toolbar ? 'true' : 'false'; ?>,
                            showInfo:        <?php echo $show_info ? 'true' : 'false'; ?>,
                            showNav:         <?php echo $show_nav ? 'true' : 'false'; ?>,
                            title:           '<?php echo $title; ?>',
                            content:         '<?php echo $content; ?>',
                            markerUrl:       '<?php echo $marker_url; ?>',
                            markerWidth:     <?php echo $marker_width; ?>,
                            markerHeight:    <?php echo $marker_height; ?>,
                            markerAnimation: <?php echo $marker_animation ? 'true' : 'false'; ?>,
                            navText:         '<?php echo $nav_text; ?>'
                        });

                        if (typeof initAmap === 'function') {
                            var configs = window.amapConfigs;
                            for (var i = 0; i < configs.length; i++) {
                                initAmap(configs[i]);
                            }
                        }
                    })();
                </script>
                <?php

            }

            protected function content_template() {
                ?>
                <#
                var mapId = 'amap_' + Math.random().toString(36).substr(2, 9);
                var navId = 'navigation_' + Math.random().toString(36).substr(2, 9);
                #>
                <div class="amap-for-wordpress-widget">
                    <div id="{{ mapId }}" class="amap-container" style="height:300px;background:#f0f0f0;border:2px dashed #ccc;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#999;">地图预览区域</span>
                    </div>
                    <# if (settings.amap_show_nav === 'yes') { #>
                    <p id="{{ navId }}" class="amap-navigation" style="text-align:center;"></p>
                    <# } #>
                </div>
                <?php
            }

        }

        $widgets_manager->register( new \Amap_For_Wordpress_Widget() );

    }, 999 );

}, 1 );