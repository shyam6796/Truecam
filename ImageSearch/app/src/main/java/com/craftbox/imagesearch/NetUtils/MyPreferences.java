package com.craftbox.imagesearch.NetUtils;

import android.content.Context;
import android.content.SharedPreferences;

import com.craftbox.imagesearch.Custom.AESCrypt;


/**
 * Created by CRAFT BOX on 1/23/2017.
 */

public class MyPreferences {

    Context context;

    public MyPreferences(Context context)
    {
        this.context=context;
    }

    public String GetPreferences(String key)
    {
        String value= null;
        try {
            SharedPreferences channel=context.getSharedPreferences(""+GlobalElements.PreferenceName, Context.MODE_PRIVATE);
            value = AESCrypt.decrypt(""+GlobalElements.EncraptionKey,channel.getString(""+key,"").toString());
        } catch (Exception  e) {
            e.printStackTrace();
            value = "";
            return  value;
        }

        return value;
    }

    public void SetPreferences(String key,String value)
    {
        try {
            SharedPreferences sharedpreferences = context.getSharedPreferences(""+GlobalElements.PreferenceName, Context.MODE_PRIVATE);
            SharedPreferences.Editor editor = sharedpreferences.edit();
            editor.putString(""+key, AESCrypt.encrypt(""+GlobalElements.EncraptionKey, value));
            editor.commit();
        } catch (Exception  e) {
            e.printStackTrace();
        }
    }
}
