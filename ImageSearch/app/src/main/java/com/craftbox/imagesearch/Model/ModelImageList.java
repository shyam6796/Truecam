package com.craftbox.imagesearch.Model;

import java.io.Serializable;

/**
 * Created by om on 22-Mar-17.
 */

public class ModelImageList implements Serializable {
    String id;
    String department_id;
    String name;
    String  email;
    String mobile;
    String birth_date;
    String blood_group;
    String gender;
    String address;
    String image_path;
    String isDelete;
    String isActive;

    public ModelImageList() {
    }

    public ModelImageList(String id, String department_id, String name, String email, String mobile, String birth_date, String blood_group, String address, String image_path, String isDelete, String isActive,String gender) {
        this.id = id;
        this.department_id = department_id;
        this.name = name;
        this.email = email;
        this.mobile = mobile;
        this.birth_date = birth_date;
        this.blood_group = blood_group;
        this.gender=gender;
        this.address = address;
        this.image_path = image_path;
        this.isDelete = isDelete;
        this.isActive = isActive;
    }

    public String getGender() {
        return gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
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

    public String getImage_path() {
        return image_path;
    }

    public void setImage_path(String image_path) {
        this.image_path = image_path;
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
