package com.craftbox.imagesearch.Model;

/**
 * Created by Craftbox-4 on 3/27/2017.
 */

public class ModelSearchHistory
{
    String id;
    String image_path;
    String match_id;
    String uid;
    String department_id;
    String name;
    String email;
    String mobile;
    String birth_date;
    String gender;
    String blood_group;
    String address;
    String mImage_path;
    String isDelete;
    String isActive;

    public ModelSearchHistory(String id, String image_path, String match_id, String uid, String department_id, String name, String email, String mobile, String birth_date, String gender, String blood_group, String address, String mImage_path, String isDelete, String isActive) {
        this.id = id;
        this.image_path = image_path;
        this.match_id = match_id;
        this.uid = uid;
        this.department_id = department_id;
        this.name = name;
        this.email = email;
        this.mobile = mobile;
        this.birth_date = birth_date;
        this.gender = gender;
        this.blood_group = blood_group;
        this.address = address;
        this.mImage_path = mImage_path;
        this.isDelete = isDelete;
        this.isActive = isActive;
    }

    public ModelSearchHistory() {

    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getImage_path() {
        return image_path;
    }

    public void setImage_path(String image_path) {
        this.image_path = image_path;
    }

    public String getMatch_id() {
        return match_id;
    }

    public void setMatch_id(String match_id) {
        this.match_id = match_id;
    }

    public String getUid() {
        return uid;
    }

    public void setUid(String uid) {
        this.uid = uid;
    }

    public String getDepartment_id() {
        return department_id;
    }

    public void setDepartment_id(String department_id) {
        this.department_id = department_id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

    public String getBirth_date() {
        return birth_date;
    }

    public void setBirth_date(String birth_date) {
        this.birth_date = birth_date;
    }

    public String getGender() {
        return gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }

    public String getBlood_group() {
        return blood_group;
    }

    public void setBlood_group(String blood_group) {
        this.blood_group = blood_group;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getmImage_path() {
        return mImage_path;
    }

    public void setmImage_path(String mImage_path) {
        this.mImage_path = mImage_path;
    }

    public String getIsDelete() {
        return isDelete;
    }

    public void setIsDelete(String isDelete) {
        this.isDelete = isDelete;
    }

    public String getIsActive() {
        return isActive;
    }

    public void setIsActive(String isActive) {
        this.isActive = isActive;
    }

}
