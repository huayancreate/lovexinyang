package com.huayan.life.model;

public class Notice extends BaseModel {

	private static final long serialVersionUID = 1L;
	private String content;// 消息内容
	private String time;// 时间
	private int type;// 类别（1商品，2商家，0系统消息）

	public String getContent() {
		return content;
	}

	public void setContent(String content) {
		this.content = content;
	}

	public String getTime() {
		return time;
	}

	public void setTime(String time) {
		this.time = time;
	}

	public int getType() {
		return type;
	}

	public void setType(int type) {
		this.type = type;
	}

}
