package com.huayan.life.model;

import java.io.Serializable;

/**
 * @author wzz
 * @date 2014-12-29
 */
public class Regional extends BaseModel implements Serializable {

	/**
	 * ����
	 */
	private static final long serialVersionUID = 1L;

	private int CityID; // ����ID
	private String name;// ������
	private Counties counties;// ����

	public int getCityID() {
		return CityID;
	}

	public void setCityID(int cityID) {
		CityID = cityID;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public Counties getCounties() {
		return counties;
	}

	public void setCounties(Counties counties) {
		this.counties = counties;
	}

}
