package com.huayan.life.model;

import java.io.Serializable;

public class MyLocation implements Serializable {

	/**
	 * ����λ��
	 */
	private static final long serialVersionUID = 1L;

	protected Double longitude;// ����
	protected Double latitude;// γ��

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