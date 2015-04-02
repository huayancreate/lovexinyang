package util;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.io.StreamCorruptedException;

import org.apache.commons.codec.binary.Base64;

import android.content.Context;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;

import com.huayan.life.model.MyLocation;
import com.huayan.life.model.User;

public class ShareUtil {

	public static void saveUser(User user, Context mContext) {
		SharedPreferences preferences = mContext.getSharedPreferences("base64",Context.MODE_PRIVATE);
		// �����ֽ������
		ByteArrayOutputStream baos = new ByteArrayOutputStream();
		try {
			// �������������������װ�ֽ���
			ObjectOutputStream oos = new ObjectOutputStream(baos);
			// ������д���ֽ���
			oos.writeObject(user);
			// ���ֽ��������base64���ַ���
			String user_Base64 = new String(Base64.encodeBase64(baos
					.toByteArray()));
			Editor editor = preferences.edit();
			editor.putString("User", user_Base64);
			editor.commit();
		} catch (IOException e) {
			// TODO Auto-generated
			e.printStackTrace();
		}
	}

	public static User readUser(Context mContext) {
		User mUser = null;
		SharedPreferences preferences = mContext.getSharedPreferences("base64",
				Context.MODE_PRIVATE);
		String productBase64 = preferences.getString("User", "");

		// ��ȡ�ֽ�
		byte[] base64 = Base64.decodeBase64(productBase64.getBytes());

		// ��װ���ֽ���
		ByteArrayInputStream bais = new ByteArrayInputStream(base64);
		try {
			// �ٴη�װ
			ObjectInputStream bis = new ObjectInputStream(bais);
			try {
				// ��ȡ����
				mUser = (User) bis.readObject();
			} catch (ClassNotFoundException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		} catch (StreamCorruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return mUser;
	}

	public static void saveMyLocation(MyLocation loc, Context mContext) {
		SharedPreferences preferences = mContext.getSharedPreferences("base64",Context.MODE_PRIVATE);
		// �����ֽ������
		ByteArrayOutputStream baos = new ByteArrayOutputStream();
		try {
			// �������������������װ�ֽ���
			ObjectOutputStream oos = new ObjectOutputStream(baos);
			// ������д���ֽ���
			oos.writeObject(loc);
			// ���ֽ��������base64���ַ���
			String user_Base64 = new String(Base64.encodeBase64(baos.toByteArray()));
			Editor editor = preferences.edit();
			editor.putString("MyLocation", user_Base64);
			editor.commit();
		} catch (IOException e) {
			// TODO Auto-generated
			e.printStackTrace();
		}
	}

	public static MyLocation readMyLocation(Context mContext) {
		MyLocation loc = null;
		SharedPreferences preferences = mContext.getSharedPreferences("base64",Context.MODE_PRIVATE);
		String productBase64 = preferences.getString("MyLocation", "");

		// ��ȡ�ֽ�
		byte[] base64 = Base64.decodeBase64(productBase64.getBytes());

		// ��װ���ֽ���
		ByteArrayInputStream bais = new ByteArrayInputStream(base64);
		try {
			// �ٴη�װ
			ObjectInputStream bis = new ObjectInputStream(bais);
			try {
				// ��ȡ����
				loc = (MyLocation) bis.readObject();
			} catch (ClassNotFoundException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		} catch (StreamCorruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return loc;
	}
	
}
