package com.huayan.life.model;

import java.io.Serializable;

/**
 * ��Ȧ
 * 
 * @author wzz
 * 
 */
public class Business extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String name;// ��Ȧ��

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

}
