package com.huayan.life.model;

import java.io.Serializable;
import java.util.List;

/**
 * 店铺详情
 * 
 * @author wzz
 * 
 */
public class ShopDetail extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String name;// (店名)
	private List<AlbumImage> imgs;// (图片)
	private String memberRule;// (会员等级规则)
	private int commentNum;// 评价人数
	private float commentScore;// 评价总分
	private String tel;// 店铺电话
	private String address;// 详细地址
	private int evaluationNum;// 本店铺评价数
	private int isBookmark;// (0未收藏 ， 1已收藏)

	public int getIsBookmark() {
		return isBookmark;
	}

	public void setIsBookmark(int isBookmark) {
		this.isBookmark = isBookmark;
	}

	public List<AlbumImage> getImgs() {
		return imgs;
	}

	public void setImgs(List<AlbumImage> imgs) {
		this.imgs = imgs;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getMemberRule() {
		return memberRule;
	}

	public void setMemberRule(String memberRule) {
		this.memberRule = memberRule;
	}

	public int getCommentNum() {
		return commentNum;
	}

	public void setCommentNum(int commentNum) {
		this.commentNum = commentNum;
	}

	public float getCommentScore() {
		return commentScore;
	}

	public void setCommentScore(float commentScore) {
		this.commentScore = commentScore;
	}

	public String getTel() {
		return tel;
	}

	public void setTel(String tel) {
		this.tel = tel;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public int getEvaluationNum() {
		return evaluationNum;
	}

	public void setEvaluationNum(int evaluationNum) {
		this.evaluationNum = evaluationNum;
	}

}
