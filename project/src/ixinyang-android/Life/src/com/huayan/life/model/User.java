package com.huayan.life.model;

import java.io.Serializable;

public class User extends BaseModel implements Serializable {

	/**
	 * 用户账号
	 */
	private static final long serialVersionUID = 1L;

	private String username;// 用户登录名
	private String password;// 用户登录密码（加密）
	private String phoneCaptcha;// 手机注册码
	private String realname;// 昵称
	private String phoneNumber;// 手机号码
	private String newPhoneNumber;//新绑定的手机号码
	private String payPasword;//支付密码（MD5加密）
	private String newPassword;//新密码
	private String oldPassword;//旧密码
	private String comfirmPassword;//确认支付密码
	private String token;//身份验证
	private String headIcon;//用户头像
	
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
