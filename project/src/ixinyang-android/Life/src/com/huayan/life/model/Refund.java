package com.huayan.life.model;

import java.io.Serializable;

/**
 * �˿�
 * 
 * @author wzz
 * 
 */
public class Refund extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private int type;// 0���������,( 1������֧����)0֧����
	private String reason;// �˿�ԭ��(0,1,2,3,4,5,6,7����)

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
