package com.craftbox.imagesearch.NetUtils;

import android.util.Log;
import android.util.Pair;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.List;

public class JSONParser {

    static InputStream is = null;
    static JSONObject jObj = null;
    static String json = "";

    // constructor
    public JSONParser() {

    }

    public static JSONObject makeHttpRequest(String url, String Method, List<Pair<String, String>> params) {
        try {

            if(params.size()>0)
            {
                String parameters="";
                int i=0;
                for (Pair<String, String> entr : params)
                {
                    if(i==0)
                    {
                        parameters=""+entr.first+"="+entr.second;
                    }
                    else
                    {
                        parameters+="&"+entr.first+"="+entr.second;
                    }
                    i++;
                }
                url += "?" + parameters;
            }
            URL myurl=new URL(url);
            HttpURLConnection urlConnection = (HttpURLConnection) myurl.openConnection();
            urlConnection.setRequestMethod(""+Method);
            urlConnection.setDoInput(true);
            urlConnection.connect();
            InputStream is=urlConnection.getInputStream();
            if (is != null) {
                StringBuilder sb = new StringBuilder();
                String line;
                try {
                    BufferedReader reader = new BufferedReader(new InputStreamReader(is));
                    while ((line = reader.readLine()) != null) {
                        sb.append(line);
                    }
                    reader.close();
                } finally {
                    is.close();
                }
                json = sb.toString();
            }
        }catch (Exception e){
            json =null;
        }
        try {
            jObj = new JSONObject(json);
        } catch (Exception e) {
            Log.e("JSON Parser", "Error parsing data " + e.toString());
        }
        return jObj;
    }
}
