package com.huayan.life.model;

import java.io.Serializable;

/**
 * ����
 * 
 * @author wzz
 * 
 */
public class Counties extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String name;// ��������
	private Business business;// ��Ȧ

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public Business getBusiness() {
		return business;
	}

	public void setBusiness(Business business) {
		this.business = business;
	}

}
