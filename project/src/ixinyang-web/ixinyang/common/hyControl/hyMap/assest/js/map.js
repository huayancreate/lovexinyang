var longitude;
var latitude;

function getLongitude()
{
    return longitude;
}

function getLatitude()
{
    return latitude;
}

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
                longitude = e.point.lng;
                latitude = e.point.lat;
            }
        });
        marker.addEventListener("dragend", function(e){
            longitude = e.point.lng;
            latitude = e.point.lat;
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
                    longitude = pos.lng;
                    latitude = pos.lat;
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
            document.getElementById("result").innerHTML = "经度："+lng + "，纬度：" + lat;
        }