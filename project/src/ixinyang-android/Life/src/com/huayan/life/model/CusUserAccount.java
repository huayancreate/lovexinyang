package com.huayan.life.model;

import java.io.Serializable;

public class CusUserAccount implements Serializable {

	/**
	 * �û��˺�
	 */
	private static final long serialVersionUID = 1L;

		private int id;
		private String  validity;//�Ƿ���Ч  0 ��Ч  1  ��Ч
		private String userPassWord;// �û���¼����
		private String userAccount;// �û���¼��
		private String registrationDate;//ע������
		
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
