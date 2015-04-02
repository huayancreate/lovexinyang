package com.huayan.life.model;

import java.io.Serializable;

public class Category extends BaseModel implements Serializable {

	/**
	 * ���
	 */
	private static final long serialVersionUID = 1L;

	private int categoryType; // (0�������1��Ʒ���2�������)
	private int parentCategoryId;// �����
	private String categoryCode;// ������
	private String categoryGrade;// ���ȼ�
	private String categoryName;// �������

	public int getCategoryType() {
		return categoryType;
	}

	public void setCategoryType(int categoryType) {
		this.categoryType = categoryType;
	}

	public int getParentCategoryId() {
		return parentCategoryId;
	}

	public void setParentCategoryId(int parentCategoryId) {
		this.parentCategoryId = parentCategoryId;
	}

	public String getCategoryCode() {
		return categoryCode;
	}

	public void setCategoryCode(String categoryCode) {
		this.categoryCode = categoryCode;
	}

	public String getCategoryGrade() {
		return categoryGrade;
	}

	public void setCategoryGrade(String categoryGrade) {
		this.categoryGrade = categoryGrade;
	}

	public String getCategoryName() {
		return categoryName;
	}

	public void setCategoryName(String categoryName) {
		this.categoryName = categoryName;
	}

}
