package com.huayan.life.Activity;

import java.util.HashMap;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.os.Bundle;
import android.os.Handler;
import android.os.Handler.Callback;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;
import cn.sharesdk.framework.AbstractWeibo;
import cn.sharesdk.framework.WeiboActionListener;
import cn.sharesdk.sina.weibo.SinaWeibo;
import cn.sharesdk.tencent.qzone.QZone;

public class LoginActivity extends BaseActivity implements Callback,
		OnClickListener, WeiboActionListener {

	EditText et_username, et_userpwd;
	Button btn_login, btnRegView, txtQuickRegView;
	// private DBOperation mDBHelper;
	// private User myUser;
	// private ShareUtil share;
	int userID;
	// ����handler����
	private Handler handler;
	// �����ӿ�Runnable
	private Runnable updateThread;

	LinearLayout ll_AreaLayout, ll_LoginLayout;
	boolean tag = true;
	ImageView img_qq, img_sina;

	// ����Handler����
	private Handler mHandler;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login);
		et_username = (EditText) findViewById(R.id.et_username);
		et_userpwd = (EditText) findViewById(R.id.et_userpwd);
		btn_login = (Button) findViewById(R.id.btn_login);
		btnRegView = (Button) findViewById(R.id.btn_reg);
		btnRegView.setOnClickListener(this);
		txtQuickRegView = (Button) findViewById(R.id.txt_quick_login_page);
		txtQuickRegView.setOnClickListener(this);
		((ImageButton) findViewById(R.id.ib_return)).setOnClickListener(this);
		btn_login.setOnClickListener(this);

		ll_AreaLayout = (LinearLayout) findViewById(R.id.ll_bottom_lg);
		ll_LoginLayout = (LinearLayout) findViewById(R.id.ll_login);
		img_sina = (ImageView) findViewById(R.id.img_sina);
		img_qq = (ImageView) findViewById(R.id.img_qq);
		ll_AreaLayout.setOnClickListener(this);
		img_sina.setOnClickListener(this);
		img_qq.setOnClickListener(this);

		// ��ʼ��ShareSDK
		AbstractWeibo.initSDK(this);
		// ʵ����Handler����������Ϣ�ص������ӿ�
		mHandler = new Handler(this);

		// ��ȡƽ̨�б�
		AbstractWeibo[] weibos = AbstractWeibo.getWeiboList(this);

		for (int i = 0; i < weibos.length; i++) {
			if (!weibos[i].isValid()) {
				continue;
			}
			// �õ���Ȩ�û����û�����
			String userName = weibos[i].getDb().get("nickname");
			if (userName == null || userName.length() <= 0
					|| "null".equals(userName)) {
				// ���ƽ̨�Ѿ���Ȩȴû���õ��ʺ����ƣ����Զ���ȡ�û����ϣ��Ի�ȡ����
				userName = getWeiboName(weibos[i]);
				// ����ƽ̨�¼�����
				weibos[i].setWeiboActionListener(this);
				// ��ʾ�û����ϣ�null��ʾ��ʾ�Լ�������
				weibos[i].showUser(null);
			}
		}

	}

	/**
	 * �õ���Ȩ�û����û�����
	 */
	private String getWeiboName(AbstractWeibo weibo) {
		if (weibo == null) {
			return null;
		}

		String name = weibo.getName();
		if (name == null) {
			return null;
		}
		int res = 0;
		if (SinaWeibo.NAME.equals(name)) {
			res = R.string.sinaweibo;
		} else if (QZone.NAME.equals(name)) {
			res = R.string.qzone;
		}
		if (res == 0) {
			return name;
		}
		return this.getResources().getString(res);
	}

	/**
	 * �����Ȩ
	 */
	private AbstractWeibo getWeibo(int vid) {
		String name = null;
		switch (vid) {
		// ��������΢������Ȩҳ��
		case R.id.img_sina:
			name = SinaWeibo.NAME;
			break;
		// ����QQ����Ȩҳ��
		case R.id.img_qq:
			name = QZone.NAME;
			break;
		}

		if (name != null) {
			return AbstractWeibo.getWeibo(this, name);
		}
		return null;
	}


	/**
	 * 
	 * ��֤��¼�ʺ�
	 */
	private boolean loginPro() {
		// String username = et_username.getText().toString().trim();
		// String password = et_userpwd.getText().toString().trim();
		// User user = new User(username, password);
		// myUser = mDBHelper.select(user);
		// if (myUser != null) {
		// userID = myUser.getUserId();
		// return true;
		// }
		return true;
	}

	/**
	 * save User
	 */
	private void saveUser() {
		// User mUser = new User();
		// mUser.setUserName(userName.getText().toString().trim());
		// mUser.setUserPassword(userPass.getText().toString().trim());
		// mUser.setUserId(userID);
		// share = new ShareUtil();
		// share.saveUser(mUser, this);
	}

	/**
	 * 
	 * ����Ϊ��
	 */
	private boolean validate() {
		String username = et_username.getText().toString().trim();
		String password = et_userpwd.getText().toString().trim();
		if ("".equals(username)) {
			showDialog("�������û���!");
			return false;
		}
		if ("".equals(password)) {
			showDialog("�������û�����!");
			return false;
		}
		return true;
	}

	private void showDialog(String mess) {
		new AlertDialog.Builder(LoginActivity.this).setTitle("��ܰ��ʾ")
				.setIcon(android.R.drawable.ic_dialog_info).setMessage(mess)
				.setNegativeButton("ȷ��", new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int which) {
						dialog.dismiss();
					}
				}).show();
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.btn_reg:
			jumpToActivity(LoginActivity.this, RegisterActivity.class);
			break;
		case R.id.txt_quick_login_page:
			jumpToActivity(LoginActivity.this, RegisterActivity.class);
			break;
		case R.id.ib_return:
			finish();
			break;
		case R.id.btn_login:
			handler = new Handler();
			// �����ӿ�Runnable �߳�
			updateThread = new Runnable() {
				public void run() {
					if (!validate()) {
						return;
					}
					if (loginPro() == true) {
						saveUser();
						jumpToActivity(LoginActivity.this, MainActivity.class);
						return;
					}
					showDialog("�û����������������������!");
				}
			};
			handler.post(updateThread);
			break;
		case R.id.ll_bottom_lg:
			if (tag) {
				ll_LoginLayout.setVisibility(View.VISIBLE);
				tag = false;
			} else {
				ll_LoginLayout.setVisibility(View.GONE);
				tag = true;
			}
			break;
		case R.id.img_qq:
			AbstractWeibo weibo = getWeibo(v.getId());
			if (weibo == null) {
				return;
			}
			if (weibo.isValid()) {
				weibo.removeAccount();
				return;
			}
			weibo.setWeiboActionListener(this);
			weibo.showUser(null);
			break;
		case R.id.img_sina:
			AbstractWeibo weibo1 = getWeibo(v.getId());
			if (weibo1 == null) {
				return;
			}

			if (weibo1.isValid()) {
				weibo1.removeAccount();
				return;
			}
			weibo1.setWeiboActionListener(this);
			weibo1.showUser(null);
			break;

		}
	}

	@Override
	public boolean handleMessage(Message msg) {
		AbstractWeibo weibo = (AbstractWeibo) msg.obj;
		String text = actionToString(msg.arg2);

		switch (msg.arg1) {
		case 1: { // �ɹ�
			text = weibo.getName() + " completed at " + text;
			Toast.makeText(this, text, Toast.LENGTH_SHORT).show();
		}
			break;
		case 2: { // ʧ��
			text = weibo.getName() + " caught error at " + text;
			Toast.makeText(this, text, Toast.LENGTH_SHORT).show();
			return false;
		}
		case 3: { // ȡ��
			text = weibo.getName() + " canceled at " + text;
			Toast.makeText(this, text, Toast.LENGTH_SHORT).show();
			return false;
		}
		}
		String userName = weibo.getDb().get("nickname"); // getAuthedUserName();
		if (userName == null || userName.length() <= 0
				|| "null".equals(userName)) {
			userName = getWeiboName(weibo);
		}
		return false;
	}

	public static String actionToString(int action) {
		switch (action) {
		case AbstractWeibo.ACTION_AUTHORIZING:
			return "ACTION_AUTHORIZING";
		case AbstractWeibo.ACTION_GETTING_FRIEND_LIST:
			return "ACTION_GETTING_FRIEND_LIST";
		case AbstractWeibo.ACTION_FOLLOWING_USER:
			return "ACTION_FOLLOWING_USER";
		case AbstractWeibo.ACTION_SENDING_DIRECT_MESSAGE:
			return "ACTION_SENDING_DIRECT_MESSAGE";
		case AbstractWeibo.ACTION_TIMELINE:
			return "ACTION_TIMELINE";
		case AbstractWeibo.ACTION_USER_INFOR:
			return "ACTION_USER_INFOR";
		case AbstractWeibo.ACTION_SHARE:
			return "ACTION_SHARE";
		default: {
			return "UNKNOWN";
		}
		}
	}

	/**
	 * ȡ����Ȩ�Ļص�
	 */
	@Override
	public void onCancel(AbstractWeibo weibo, int action) {
		Message msg = new Message();
		msg.arg1 = 3;
		msg.arg2 = action;
		msg.obj = weibo;
		mHandler.sendMessage(msg);
	}

	/**
	 * ��Ȩ�ɹ��Ļص� weibo - �ص���ƽ̨ action - ���������� res - ���������ͨ��res����
	 */
	@Override
	public void onComplete(AbstractWeibo weibo, int action,
			HashMap<String, Object> res) {
		Message msg = new Message();
		msg.arg1 = 1;
		msg.arg2 = action;
		msg.obj = weibo;
		mHandler.sendMessage(msg);
	}

	/**
	 * ��Ȩʧ�ܵĻص�
	 */
	@Override
	public void onError(AbstractWeibo weibo, int action, Throwable t) {
		t.printStackTrace();

		Message msg = new Message();
		msg.arg1 = 2;
		msg.arg2 = action;
		msg.obj = weibo;
		mHandler.sendMessage(msg);
	}

	protected void onDestroy() {
		// ����ShareSDK��ͳ�ƹ��ܲ��ͷ���Դ
		AbstractWeibo.stopSDK(this);
		super.onDestroy();
	}

}