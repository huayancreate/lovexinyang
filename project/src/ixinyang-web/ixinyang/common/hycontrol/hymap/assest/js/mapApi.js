/**
*  @author xuwei <wxu@huayancreate.com>
*  @date   2014-11-20
*  @version 1.0
*/
define([
"./map"
    ],function(map){
    return map;
});

var map;

map.init = function(divId){
    $(divId).append(map);
};

map = function(){
    map = new BMap.Map("map_container");
    return map;
};

var initMap = function(divId){
	$(divId).append(map);
};

var getLocation = function(longitude,latitude){
	// 通过经纬度获取地址
};

var getLongitude = function(){
	getLongitude();
};

var getLatitude=(function(){
    getLatitude();
};