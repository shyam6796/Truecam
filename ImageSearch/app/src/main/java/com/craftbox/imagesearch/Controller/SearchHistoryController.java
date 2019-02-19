package com.craftbox.imagesearch.Controller;

import com.craftbox.imagesearch.Model.ModelSearchHistory;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Craftbox-4 on 3/27/2017.
 */
/*"result": [

    {
        "id": "8",
        "image_path": "http://24.24.24.215/imagematcher/images/user/main/fa8b1d.jpg",
        "match_id": "3",
        "uid": "3",
        "matching_result": {
            "id": "3",
            "department_id": "3",
            "name": "Hardip",
            "email": "hardipgol@gmail.com",
            "mobile": "2147483647",
            "birth_date": "2017-03-17",
            "gender": "",
            "blood_group": "",
            "address": "",
            "image_path": "http://24.24.24.215/imagematcher/images/user/main/",
            "isDelete": "0",
            "isActive": "1"
        }
    }

],*/
public class SearchHistoryController {
    public List<ModelSearchHistory>getHistory(JSONObject json){
        List<ModelSearchHistory>modelSearchHistories=new ArrayList<>();
        try {
            if(json.getString("ack").equals("1")){
                JSONArray jResultArray=json.getJSONArray("result");
                for(int i=0;i<jResultArray.length();i++){
                    JSONObject jResultObject=jResultArray.getJSONObject(i);
                    ModelSearchHistory model=new ModelSearchHistory();
                    model.setImage_path(jResultObject.getString("image_path"));

                    try {
                        JSONObject jMatchObject=jResultObject.getJSONObject("matching_result");

                        if(jMatchObject!=null&&!jMatchObject.equals("")) {
                            model.setName(jMatchObject.getString("name"));
                        }

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                    modelSearchHistories.add(model);

                }
            }

        }catch (Exception e){
            e.printStackTrace();
        }
        return modelSearchHistories;
    }
}
