package com.huayan.life.model;

public class Notice extends BaseModel {

	private static final long serialVersionUID = 1L;
	private String content;// ��Ϣ����
	private String time;// ʱ��
	private int type;// ���1��Ʒ��2�̼ң�0ϵͳ��Ϣ��

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
