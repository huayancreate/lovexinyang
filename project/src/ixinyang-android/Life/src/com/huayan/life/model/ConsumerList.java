package com.huayan.life.model;

import java.io.Serializable;

/**
 * ���Ѽ�¼
 * @author wzz
 *
 */
public class ConsumerList  extends BaseModel implements Serializable {
	private static final long serialVersionUID = 1L;

	private String  branchShopName; // (�ֵ��������)
	private String time;//  (����ʱ��)
	private Double money;// (���ѽ��)
	
	public String getBranchShopName() {
		return branchShopName;
	}
	public void setBranchShopName(String branchShopName) {
		this.branchShopName = branchShopName;
	}
	public String getTime() {
		return time;
	}
	public void setTime(String time) {
		this.time = time;
	}
	public Double getMoney() {
		return money;
	}
	public void setMoney(Double money) {
		this.money = money;
	}

}
