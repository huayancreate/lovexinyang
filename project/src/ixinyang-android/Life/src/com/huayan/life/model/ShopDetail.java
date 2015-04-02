package com.huayan.life.model;

import java.io.Serializable;
import java.util.List;

/**
 * ��������
 * 
 * @author wzz
 * 
 */
public class ShopDetail extends BaseModel implements Serializable {

	private static final long serialVersionUID = 1L;

	private String name;// (����)
	private List<AlbumImage> imgs;// (ͼƬ)
	private String memberRule;// (��Ա�ȼ�����)
	private int commentNum;// ��������
	private float commentScore;// �����ܷ�
	private String tel;// ���̵绰
	private String address;// ��ϸ��ַ
	private int evaluationNum;// ������������
	private int isBookmark;// (0δ�ղ� �� 1���ղ�)

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
