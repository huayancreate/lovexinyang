package com.huayan.life.model;

import java.io.Serializable;

/**
 * 消费记录
 * @author wzz
 *
 */
public class ConsumerList  extends BaseModel implements Serializable {
	private static final long serialVersionUID = 1L;

	private String  branchShopName; // (分店店铺名称)
	private String time;//  (消费时间)
	private Double money;// (消费金额)
	
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
