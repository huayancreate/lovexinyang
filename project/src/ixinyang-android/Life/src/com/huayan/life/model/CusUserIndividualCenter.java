package com.huayan.life.model;

import java.io.Serializable;

public class CusUserIndividualCenter implements Serializable {

	/**
	 * �û���������
	 */
	private static final long serialVersionUID = 1L;
	
	 private int id;
	 private int  userAccountId; //�û��˺�ID
	 private String birthday;//����
	 private String validity;//�Ƿ���Ч 0 ��Ч��1 ��Ч
	 private String phone;//�ֻ���
	  private int  memberGrade;//ϵͳ��Ա�ȼ�
	  private Double consumptionAmount;//���ѽ��
	  private String interest;//��Ȥ
	  private String sex;//�Ա�  0��Ů  1����
	  private String userName;//�û�����
	  private String  userAccount; //�û��˺š��˻�
	  private String email;//��������
	  private Double spareAmount;//���
	  private String profession;//ְҵ
	  private String registrationDate;//ע������
	
	  public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public int getUserAccountId() {
		return userAccountId;
	}
	public void setUserAccountId(int userAccountId) {
		this.userAccountId = userAccountId;
	}
	public String getBirthday() {
		return birthday;
	}
	public void setBirthday(String birthday) {
		this.birthday = birthday;
	}
	public String getValidity() {
		return validity;
	}
	public void setValidity(String validity) {
		this.validity = validity;
	}
	public String getPhone() {
		return phone;
	}
	public void setPhone(String phone) {
		this.phone = phone;
	}
	public int getMemberGrade() {
		return memberGrade;
	}
	public void setMemberGrade(int memberGrade) {
		this.memberGrade = memberGrade;
	}
	public Double getConsumptionAmount() {
		return consumptionAmount;
	}
	public void setConsumptionAmount(Double consumptionAmount) {
		this.consumptionAmount = consumptionAmount;
	}
	public String getInterest() {
		return interest;
	}
	public void setInterest(String interest) {
		this.interest = interest;
	}
	public String getSex() {
		return sex;
	}
	public void setSex(String sex) {
		this.sex = sex;
	}
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getUserAccount() {
		return userAccount;
	}
	public void setUserAccount(String userAccount) {
		this.userAccount = userAccount;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public Double getSpareAmount() {
		return spareAmount;
	}
	public void setSpareAmount(Double spareAmount) {
		this.spareAmount = spareAmount;
	}
	public String getProfession() {
		return profession;
	}
	public void setProfession(String profession) {
		this.profession = profession;
	}
	public String getRegistrationDate() {
		return registrationDate;
	}
	public void setRegistrationDate(String registrationDate) {
		this.registrationDate = registrationDate;
	}

}
