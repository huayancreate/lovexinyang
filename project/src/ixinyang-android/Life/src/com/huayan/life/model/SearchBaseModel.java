package com.huayan.life.model;

import java.io.Serializable;

public class SearchBaseModel extends BaseModel implements Serializable {

	/**
	 * 商铺、商品的基础查询数据
	 */
	private static final long serialVersionUID = 1L;

	private String searchString;// 查询字段
	private int regionID;// 区域id
	private int typeID;// 类别id
	private MyLocation location;// 经度，纬度
	private int bussinessID;// 商圈id
	private int orderBy;// (0,1,2,3,4,5,6)

	public String getSearchString() {
		return searchString;
	}

	public void setSearchString(String searchString) {
		this.searchString = searchString;
	}

	public int getRegionID() {
		return regionID;
	}

	public void setRegionID(int regionID) {
		this.regionID = regionID;
	}

	public int getTypeID() {
		return typeID;
	}

	public void setTypeID(int typeID) {
		this.typeID = typeID;
	}

	public MyLocation getLocation() {
		return location;
	}

	public void setLocation(MyLocation location) {
		this.location = location;
	}

	public int getBussinessID() {
		return bussinessID;
	}

	public void setBussinessID(int bussinessID) {
		this.bussinessID = bussinessID;
	}

	public int getOrderBy() {
		return orderBy;
	}

	public void setOrderBy(int orderBy) {
		this.orderBy = orderBy;
	}

}