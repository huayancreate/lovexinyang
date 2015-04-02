package com.huayan.life.model;

import java.io.Serializable;


/**
 * 财务
 * @author wzz
 *
 */
public class Finance extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private Double money;// 余额
	private int type;//0支付宝
	private String url;//跳转到支付宝的地址
	
	public Double getMoney() {
		return money;
	}
	public void setMoney(Double money) {
		this.money = money;
	}
	public int getType() {
		return type;
	}
	public void setType(int type) {
		this.type = type;
	}
	public String getUrl() {
		return url;
	}
	public void setUrl(String url) {
		this.url = url;
	}

}
