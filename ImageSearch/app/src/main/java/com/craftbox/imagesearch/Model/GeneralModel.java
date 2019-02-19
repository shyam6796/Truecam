package com.craftbox.imagesearch.Model;

import java.io.Serializable;

/**
 * Created by CRAFT BOX on 2/20/2017.
 */

public class GeneralModel implements Serializable{
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    int id;
    String name;

    public GeneralModel()
    {

    }
}
