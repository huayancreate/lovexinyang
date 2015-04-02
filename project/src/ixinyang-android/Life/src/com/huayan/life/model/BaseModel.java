package com.huayan.life.model;

import java.io.Serializable;

public class BaseModel implements Serializable {

	/**
	 * 基础数据
	 */
	private static final long serialVersionUID = 1L;

	protected String opeType;// 操作类型
	protected int requestType;// (用于统计请求来源 0web, 1mobile)
	protected int mobile;// (用于统计手机来源 0 ios, 1 android)
	protected int ID;
	protected int page;// 当前页数
	protected int rows;// 每页数量

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