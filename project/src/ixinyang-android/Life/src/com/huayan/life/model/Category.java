package com.huayan.life.model;

import java.io.Serializable;

public class Category extends BaseModel implements Serializable {

	/**
	 * 类别
	 */
	private static final long serialVersionUID = 1L;

	private int categoryType; // (0所有类别，1商品类别，2评价类别)
	private int parentCategoryId;// 父类别
	private String categoryCode;// 类别编码
	private String categoryGrade;// 类别等级
	private String categoryName;// 类别名称

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
