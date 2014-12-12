package com.huayan.life.model;

import java.io.Serializable;

public class CusUserIndividualCenter implements Serializable {

	/**
	 * 用户个人中心
	 */
	private static final long serialVersionUID = 1L;
	
	 private int id;
	 private int  userAccountId; //用户账号ID
	 private String birthday;//生日
	 private String validity;//是否有效 0 无效、1 有效
	 private String phone;//手机号
	  private int  memberGrade;//系统会员等级
	  private Double consumptionAmount;//消费金额
	  private String interest;//兴趣
	  private String sex;//性别  0：女  1：男
	  private String userName;//用户姓名
	  private String  userAccount; //用户账号、账户
	  private String email;//电子邮箱
	  private Double spareAmount;//余款
	  private String profession;//职业
	  private String registrationDate;//注册日期
	
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
