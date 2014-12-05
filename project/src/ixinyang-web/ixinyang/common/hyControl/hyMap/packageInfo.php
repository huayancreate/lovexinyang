<?php 
/**
 * hymap总体描述：
 *	本目录中所作内容如下：
 * 		1、标注地图页面，可以通过鼠标点击某个点，标注出该点对应的经纬度；
 *			还可以在输入框输入要标注的地理位置，点击查询按钮，即可标注出要查询位置的经纬度。
 * 		2、接口说明：
 *          (1)、创建组件 createMap(divId);
 *			(2)、获取经纬度接口 getLngLat();
 *			(3)、绑定事件bind(name,event); name可以为以下类型：
 *			 click：左键单击地图时触发此事件。
 *			 dragging：拖拽地图过程中触发。
 *			 dragend：停止拖拽地图时触发。
 *			 dblclick:鼠标双击地图时会触发此事件。
 *			 rightclick:右键单击地图时触发此事件。
 *			 rightdblclick:右键双击地图时触发此事件。
 *			 maptypechange:地图类型发生变化时触发此事件。
 *      	 addoverlay:当使用Map.addOverlay()方法向地图中添加单个覆盖物时会触发此事件。
 *      	 addcontrol:当使用Map.addControl()方法向地图中添加单个控件时会触发此事件。
 *			 load:调用Map.centerAndZoom()方法时会触发此事件。这表示位置、缩放层级已经确定，但可能还在载入地图图块。
 *		  	本接口中调用的是百度地图的API，绑定的事件还有很多，这里就不一一列举了，
 *			详情参见：http://developer.baidu.com/map/reference/index.php
 * 		3、实际使用实例参看demo.js
*/
?>