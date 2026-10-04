<?php
/**
 * Snippet Name: Amap for WordPress - JavaScript
 * Description: 高德地图Elementor组件的JavaScript逻辑
 * Version: 1.0.9
 * Author: -
 * Last Updated: 2026-05-20
 * 
 * Version History:
 * v1.0.9 (2026-05-20) - 支持信息窗体默认打开开关，默认关闭
 * v1.0.8 (2026-05-20) - 支持导航链接显示开关
 * v1.0.7 (2026-05-20) - 新增地图控件
 * v1.0.6 (2026-05-20) - 图标高度支持auto
 * v1.0.5 (2026-05-20) - 支持API Key设置
 * v1.0.4 (2026-05-20) - 支持图标宽度和高度设置
 * v1.0.3 (2026-05-20) - 修复问题
 * v1.0.2 (2026-05-20) - 修复标记图标问题
 * v1.0.1 (2026-05-20) - 简化结构
 * v1.0.0 (2026-05-20) - 初始版本
 */

add_action( 'wp_footer', 'amap_for_wordpress_output_scripts', 1 );
add_action( 'elementor/preview/enqueue_scripts', 'amap_for_wordpress_output_scripts', 1 );

function amap_for_wordpress_output_scripts() {
    ?>
    <script id="amap-for-wordpress-script">
    (function () {
        'use strict';

        window.amapConfigs = window.amapConfigs || [];

        function initAmap(config) {
            var mapId           = config.mapId;
            var navId           = config.navId;
            var position        = config.position;
            var zoom            = config.zoom || 15;
            var showZoom        = config.showZoom !== false;
            var showScale       = config.showScale !== false;
            var showToolbar     = config.showToolbar !== false;
            var showInfo        = config.showInfo === true;
            var showNav         = config.showNav !== false;
            var title           = config.title || '';
            var content         = config.content || '';
            var markerUrl       = config.markerUrl || 'https://a.amap.com/lp-ui/images/poi-marker-default.png';
            var markerWidth     = config.markerWidth || 16;
            var markerHeight    = config.markerHeight || 0;
            var markerAnimation = config.markerAnimation !== false;
            var navText         = config.navText || '高德地图导航';

            var mapContainer = document.getElementById(mapId);
            var navContainer = navId ? document.getElementById(navId) : null;
            var widgetWrapper = mapContainer ? mapContainer.closest('.amap-for-wordpress-widget') : null;

            if (!mapContainer) return;
            if (typeof AMap === 'undefined') return;

            var navColor = widgetWrapper ? widgetWrapper.getAttribute('data-nav-color') : '#409EFF';
            var navHoverColor = widgetWrapper ? widgetWrapper.getAttribute('data-nav-hover-color') : '#66b1ff';
            var infoBg = widgetWrapper ? widgetWrapper.getAttribute('data-info-bg') : '#FFFFFF';
            var infoWidth = widgetWrapper ? parseInt(widgetWrapper.getAttribute('data-info-width')) : 200;

            var gdmap = new AMap.Map(mapId, {
                center: position,
                zoom: zoom,
                resizeEnable: true
            });

            gdmap.setStatus({
                dragEnable: true,
                keyboardEnable: false,
                doubleClickZoom: true,
                zoomEnable: true,
                rotateEnable: false
            });

            var plugins = [];
            if (showZoom) {
                plugins.push('AMap.ToolBar');
            }
            if (showScale) {
                plugins.push('AMap.Scale');
            }

            if (plugins.length > 0) {
                gdmap.plugin(plugins, function() {
                    if (showZoom) {
                        gdmap.addControl(new AMap.ToolBar({
                            position: 'RB',
                            offset: new AMap.Pixel(10, 10)
                        }));
                    }
                    if (showScale) {
                        gdmap.addControl(new AMap.Scale({
                            position: 'LB',
                            offset: new AMap.Pixel(10, 10)
                        }));
                    }
                });
            }

            var iconSize, imageSize, offsetY;
            if (markerHeight === 0) {
                iconSize = new AMap.Size(markerWidth, markerWidth);
                imageSize = new AMap.Size(markerWidth, markerWidth);
                offsetY = markerWidth;
            } else {
                iconSize = new AMap.Size(markerWidth, markerHeight);
                imageSize = new AMap.Size(markerWidth, markerHeight);
                offsetY = markerHeight;
            }

            var icon = new AMap.Icon({
                size: iconSize,
                image: markerUrl,
                imageSize: imageSize
            });

            var marker = new AMap.Marker({
                icon: icon,
                position: position,
                offset: new AMap.Pixel(-markerWidth/2, -offsetY)
            });

            if (markerAnimation) {
                setTimeout(function() {
                    var markerDom = document.querySelector('#' + mapId + ' .amap-marker');
                    if (markerDom) {
                        markerDom.classList.add('animated');
                    }
                    var iconDom = document.querySelector('#' + mapId + ' .amap-icon');
                    if (iconDom) {
                        iconDom.classList.add('animated');
                    }
                }, 500);
            }

            gdmap.add(marker);

            var contentArray = [];
            if (content) {
                contentArray = content.split('<br>');
            }

            var gdinfoWindow = new AMap.InfoWindow({
                isCustom: true,
                content: createInfoWindow(title, contentArray, infoBg, infoWidth),
                offset: new AMap.Pixel(10, -offsetY)
            });

            function createInfoWindow(infoTitle, infoContent, bgColor, width) {
                var info = document.createElement('div');
                info.className = 'custom-info content-window-card';
                info.style.width = width + 'px';

                var top = document.createElement('div');
                top.className = 'info-top';

                var titleD = document.createElement('div');
                titleD.innerHTML = infoTitle;

                var closeX = document.createElement('img');
                closeX.src = 'https://webapi.amap.com/images/close2.gif';
                closeX.style.width = '10px';
                closeX.style.height = '10px';
                closeX.onclick = closeInfoWindow;

                top.appendChild(titleD);
                top.appendChild(closeX);
                info.appendChild(top);

                var middle = document.createElement('div');
                middle.className = 'info-middle';
                middle.style.backgroundColor = bgColor;
                middle.style.height = 'auto';

                var contentHtml = '';
                for (var i = 0; i < infoContent.length; i++) {
                    contentHtml += '<p style="margin-bottom:0;">' + infoContent[i] + '</p>';
                }
                middle.innerHTML = contentHtml;

                info.appendChild(middle);

                return info;
            }

            function closeInfoWindow() {
                gdmap.clearInfoWindow();
            }

            if (showInfo) {
                gdinfoWindow.open(gdmap, position);
            }

            marker.on('click', function () {
                gdinfoWindow.open(gdmap, position);
            });

            if (showNav && navContainer) {
                navContainer.style.textAlign = 'center';

                var lngStr = position[0].toFixed(6);
                var latStr = position[1].toFixed(6);
                var dhlink = '<a href="https://uri.amap.com/marker?position=' + lngStr + ',' + latStr + '" target="_blank" style="color:' + navColor + ';">' + navText + '</a>';
                navContainer.innerHTML = dhlink;

                navContainer.addEventListener('mouseover', function() {
                    var link = navContainer.querySelector('a');
                    if (link) link.style.color = navHoverColor;
                });
                navContainer.addEventListener('mouseout', function() {
                    var link = navContainer.querySelector('a');
                    if (link) link.style.color = navColor;
                });
            }
        }

        function initAllMaps() {
            if (typeof AMap === 'undefined') {
                setTimeout(initAllMaps, 100);
                return;
            }
            var configs = window.amapConfigs;
            for (var i = 0; i < configs.length; i++) {
                initAmap(configs[i]);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAllMaps);
        } else {
            initAllMaps();
        }

    })();
    </script>
    <?php
}