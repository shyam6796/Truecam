package com.craftbox.imagesearch.Custom;

/**
 * Created by CRAFT BOX on 8/16/2016.
 */
public interface DrawableClickListener {
    public static enum DrawablePosition { TOP, BOTTOM, LEFT, RIGHT };
    public void onClick(DrawablePosition target);
}
