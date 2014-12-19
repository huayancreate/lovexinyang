package util;

import android.view.View;
import android.view.ViewGroup;
import android.widget.ListAdapter;
import android.widget.ListView;

/**
 * ����listview�ĸ߶�
 * @author wzz
 *
 */
public class Utility {
	 
	 public  static void setListViewHeightBasedOnChildren(ListView listView,int paddingHigh) {   
	        // ��ȡListView��Ӧ��Adapter   
	        ListAdapter listAdapter = listView.getAdapter();   
	        if (listAdapter == null) {   
	            return;   
	        }   
	        int totalHeight = 0;   
	        for (int i = 0, len = listAdapter.getCount(); i < len; i++) {   
	            // listAdapter.getCount()�������������Ŀ   
	            View listItem = listAdapter.getView(i, null, listView);   
	            // ��������View �Ŀ��   
	            listItem.measure(0, 0);    
	            // ͳ������������ܸ߶�   
	            totalHeight += listItem.getMeasuredHeight();    
	        }   
	   
	        ViewGroup.LayoutParams params = listView.getLayoutParams();   
	        params.height = totalHeight+ ((listView.getDividerHeight()+paddingHigh) * (listAdapter.getCount() - 1));   
	        // listView.getDividerHeight()��ȡ�����ָ���ռ�õĸ߶�   
	        // params.height���õ�����ListView������ʾ��Ҫ�ĸ߶�   
	        listView.setLayoutParams(params);   
	    }   
}
