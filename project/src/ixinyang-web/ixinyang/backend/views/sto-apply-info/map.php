<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>采集坐标 </title>

       <style>
            #preview{
                border: 1px solid #bfd2e1;
                width: 490px;
                height: 368px;
                font-family: Arial, Helvetica, sans-serif,"宋体";
            }
            #map_container{
                height: 368px;
            }
            #float_search_bar{
                z-index: 2012;
                position: absolute;
                width: 490px;
                height: 31px;
                background: url("http://dev.baidu.com/wiki/static/map/tuan/images/search_bar.png") repeat-x;
                background-position: 0 -21px;
                padding: 3px 0 0 10px;
            }
            #float_search_bar label, #float_search_bar span{
                color: #0787cb;
                font-size: 14px;
            }
            #float_search_bar input{
                width: 180px;
                height: 25px;
                margin-top: 1px;
            }
            #float_search_bar input:focus{
                outline: none;
            }
            #float_search_bar button{
                border: 0;
                color: white;
                width: 77px;
                height: 20px;
                background: url("http://dev.baidu.com/wiki/static/map/tuan/images/search_bar.png") no-repeat;
                background-position: 0 0;
                margin-right: 5px;
                cursor: pointer;
            }
        </style>
   </head>
   
   <body>
   <div id="preview">
        <div id="float_search_bar">
            <label>区域：</label>
            <input type="text" id="keyword" />
            <button id="search_button">查找</button>
            <span>点击地图或标注获取坐标</span>
        </div>
        <div id="map_container"></div>
    </div>
    <div id="result" style="margin-top: 4px;"></div>
    
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
    <script type="text/javascript">
        function getUrlParas(){
            var hash = location.hash,
                para = {},
                tParas = hash.substr(1).split("&");
            for(var p in tParas){
                if(tParas.hasOwnProperty(p)){
                    var obj = tParas[p].split("=");
                    para[obj[0]] = obj[1];
                }
            }
            return para;
        }
        var para = getUrlParas(),
            center = para.address?decodeURIComponent(para.address) : "百度大厦",
            city = para.city?decodeURIComponent(para.city) : "北京市";
    
        document.getElementById("keyword").value = center;
    
        var marker_trick = false;
        var map = new BMap.Map("map_container");
        map.enableScrollWheelZoom();
    
        var marker = new BMap.Marker(new BMap.Point(116.404, 39.915), {
            enableMassClear: false,
            raiseOnDrag: true
		 });
        marker.enableDragging();
        map.addOverlay(marker);
    
        map.addEventListener("click", function(e){
            if(!(e.overlay)){
                map.clearOverlays();
                marker.show();
                marker.setPosition(e.point);
                setResult(e.point.lng, e.point.lat);
            }
        });
        marker.addEventListener("dragend", function(e){
            setResult(e.point.lng, e.point.lat);
        });
    
        var local = new BMap.LocalSearch(map, {
            renderOptions:{map: map},
			 pageCapacity: 1
        });
        local.setSearchCompleteCallback(function(results){
            if(local.getStatus() !== BMAP_STATUS_SUCCESS){
                alert("无结果");
            } else {
			     marker.hide();
			 }
        });
        local.setMarkersSetCallback(function(pois){
            for(var i=pois.length; i--; ){
                var marker = pois[i].marker;
                marker.addEventListener("click", function(e){
                    marker_trick = true;
                    var pos = this.getPosition();
                    setResult(pos.lng, pos.lat);
                });
            }
        });
    
        window.onload = function(){
            local.search(center);
            document.getElementById("search_button").onclick = function(){
                local.search(document.getElementById("keyword").value);
            };
            document.getElementById("keyword").onkeyup = function(e){
                var me = this;
                e = e || window.event;
                var keycode = e.keyCode;
                if(keycode === 13){
                    local.search(document.getElementById("keyword").value);
                }
            };
        };
        function a(){
            document.getElementById("float_search_bar").style.display = "none";
        }
        
        /*
         * setResult : 定义得到标注经纬度后的操作
         * 请修改此函数以满足您的需求
         * lng: 标注的经度
         * lat: 标注的纬度
         */
        function setResult(lng, lat){
            document.getElementById("result").innerHTML = lng + ", " + lat;
        }
   </script>
    </body>
</html>