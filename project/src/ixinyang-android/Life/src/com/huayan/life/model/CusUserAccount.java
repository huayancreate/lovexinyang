package com.huayan.life.model;

import java.io.Serializable;

public class CusUserAccount implements Serializable {

	/**
	 * 用户账号
	 */
	private static final long serialVersionUID = 1L;

		private int id;
		private String  validity;//是否有效  0 无效  1  有效
		private String userPassWord;// 用户登录密码
		private String userAccount;// 用户登录名
		private String registrationDate;//注册日期
		
		public int getId() {
			return id;
		}
		public void setId(int id) {
			this.id = id;
		}
		public String getValidity() {
			return validity;
		}
		public void setValidity(String validity) {
			this.validity = validity;
		}
		public String getUserPassWord() {
			return userPassWord;
		}
		public void setUserPassWord(String userPassWord) {
			this.userPassWord = userPassWord;
		}
		public String getUserAccount() {
			return userAccount;
		}
		public void setUserAccount(String userAccount) {
			this.userAccount = userAccount;
		}
		public String getRegistrationDate() {
			return registrationDate;
		}
		public void setRegistrationDate(String registrationDate) {
			this.registrationDate = registrationDate;
		}

	
}
