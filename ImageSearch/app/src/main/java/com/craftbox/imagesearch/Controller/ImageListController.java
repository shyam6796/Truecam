package com.craftbox.imagesearch.Controller;

import com.craftbox.imagesearch.Model.ModelImageList;
import com.craftbox.imagesearch.NetUtils.JSONParser;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by om on 22-Mar-17.
 */

public class ImageListController {
    public List<ModelImageList> getImageList(JSONObject json){
        List<ModelImageList> modelImageLists=new ArrayList<>();
        try {
            if(json.getInt("ack")==1){
                JSONArray jResultArray =json.getJSONArray("result");
                for(int i=0;i<jResultArray.length();i++){
                    JSONObject jResultObject=jResultArray.getJSONObject(i);
                    ModelImageList model=new ModelImageList();
                    model.setId(jResultObject.getString("id"));
                    model.setDepartment_id(jResultObject.getString("department_id"));
                    model.setName(jResultObject.getString("name"));
                    model.setEmail(jResultObject.getString("email"));
                    model.setMobile(jResultObject.getString("mobile"));
                    model.setBirth_date(jResultObject.getString("birth_date"));
                    model.setBlood_group(jResultObject.getString("blood_group"));
                    model.setGender(jResultObject.getString("gender"));
                    model.setAddress(jResultObject.getString("address"));
                    model.setImage_path(jResultObject.getString("image_path"));
                    modelImageLists.add(model);
                }
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return modelImageLists;
    }
}
