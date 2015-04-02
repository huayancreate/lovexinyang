package com.huayan.life.model;

import java.io.Serializable;

public class User extends BaseModel implements Serializable {

	/**
	 * �û��˺�
	 */
	private static final long serialVersionUID = 1L;

	private String username;// �û���¼��
	private String password;// �û���¼���루���ܣ�
	private String phoneCaptcha;// �ֻ�ע����
	private String realname;// �ǳ�
	private String phoneNumber;// �ֻ�����
	private String newPhoneNumber;//�°󶨵��ֻ�����
	private String payPasword;//֧�����루MD5���ܣ�
	private String newPassword;//������
	private String oldPassword;//������
	private String comfirmPassword;//ȷ��֧������
	private String token;//�����֤
	private String headIcon;//�û�ͷ��
	
	public String getHeadIcon() {
		return headIcon;
	}
	public void setHeadIcon(String headIcon) {
		this.headIcon = headIcon;
	}
	public String getToken() {
		return token;
	}
	public void setToken(String token) {
		this.token = token;
	}
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getPhoneCaptcha() {
		return phoneCaptcha;
	}
	public void setPhoneCaptcha(String phoneCaptcha) {
		this.phoneCaptcha = phoneCaptcha;
	}
	public String getRealname() {
		return realname;
	}
	public void setRealname(String realname) {
		this.realname = realname;
	}
	public String getPhoneNumber() {
		return phoneNumber;
	}
	public void setPhoneNumber(String phoneNumber) {
		this.phoneNumber = phoneNumber;
	}
	public String getNewPhoneNumber() {
		return newPhoneNumber;
	}
	public void setNewPhoneNumber(String newPhoneNumber) {
		this.newPhoneNumber = newPhoneNumber;
	}
	public String getPayPasword() {
		return payPasword;
	}
	public void setPayPasword(String payPasword) {
		this.payPasword = payPasword;
	}
	public String getNewPassword() {
		return newPassword;
	}
	public void setNewPassword(String newPassword) {
		this.newPassword = newPassword;
	}
	public String getOldPassword() {
		return oldPassword;
	}
	public void setOldPassword(String oldPassword) {
		this.oldPassword = oldPassword;
	}
	public String getComfirmPassword() {
		return comfirmPassword;
	}
	public void setComfirmPassword(String comfirmPassword) {
		this.comfirmPassword = comfirmPassword;
	}
	
}
