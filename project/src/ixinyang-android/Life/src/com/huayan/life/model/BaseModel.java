package com.huayan.life.model;

import java.io.Serializable;

public class BaseModel implements Serializable {

	/**
	 * ��������
	 */
	private static final long serialVersionUID = 1L;

	protected String opeType;// ��������
	protected int requestType;// (����ͳ��������Դ 0web, 1mobile)
	protected int mobile;// (����ͳ���ֻ���Դ 0 ios, 1 android)
	protected int ID;
	protected int page;// ��ǰҳ��
	protected int rows;// ÿҳ����

	public int getPage() {
		return page;
	}

	public void setPage(int page) {
		this.page = page;
	}

	public int getRows() {
		return rows;
	}

	public void setRows(int rows) {
		this.rows = rows;
	}

	public BaseModel() {
		super();
	}

	public int getID() {
		return ID;
	}

	public void setID(int iD) {
		ID = iD;
	}

	public String getOpeType() {
		return opeType;
	}

	public void setOpeType(String opeType) {
		this.opeType = opeType;
	}

	public int getMobile() {
		return mobile;
	}

	public void setMobile(int mobile) {
		this.mobile = mobile;
	}

	public int getRequestType() {
		return requestType;
	}

	public void setRequestType(int requestType) {
		this.requestType = requestType;
	}

}