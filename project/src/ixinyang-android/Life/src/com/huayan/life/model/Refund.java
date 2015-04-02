package com.huayan.life.model;

import java.io.Serializable;

/**
 * 退款
 * 
 * @author wzz
 * 
 */
public class Refund extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int type;// 0、返回余额,( 1、返回支付宝)0支付宝
	private String reason;// 退款原因(0,1,2,3,4,5,6,7类型)

	public int getType() {
		return type;
	}

	public void setType(int type) {
		this.type = type;
	}

	public String getReason() {
		return reason;
	}

	public void setReason(String reason) {
		this.reason = reason;
	}

}
