package com.huayan.life.model;

import java.io.Serializable;

public class MyLocation implements Serializable {

	/**
	 * 地理位置
	 */
	private static final long serialVersionUID = 1L;

	protected Double longitude;// 经度
	protected Double latitude;// 纬度

	public Double getLongitude() {
		return longitude;
	}

	public void setLongitude(Double longitude) {
		this.longitude = longitude;
	}

	public Double getLatitude() {
		return latitude;
	}

	public void setLatitude(Double latitude) {
		this.latitude = latitude;
	}

}