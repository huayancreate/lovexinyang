package com.huayan.life.model;

import java.io.Serializable;

/**
 * ��������
 * 
 * @author wzz
 * 
 */
public class Codes extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String goodsPassword;// (�������)
	private String status;// ȯ��״̬

	public String getGoodsPassword() {
		return goodsPassword;
	}

	public void setGoodsPassword(String goodsPassword) {
		this.goodsPassword = goodsPassword;
	}

	public String getStatus() {
		return status;
	}

	public void setStatus(String status) {
		this.status = status;
	}

}
