package com.craftbox.imagesearch.Adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.craftbox.imagesearch.DashBoardActivity;
import com.craftbox.imagesearch.ImageListActivity;

import com.craftbox.imagesearch.Model.ModelImageList;
import com.craftbox.imagesearch.R;
import com.craftbox.imagesearch.ShowUserDetailAct;
import com.squareup.picasso.Picasso;

import java.io.Serializable;
import java.util.List;

/**
 * Created by om on 22-Mar-17.
 */

public class ImageAdapter extends RecyclerView.Adapter<ImageAdapter.ViewHolder> {
    List<ModelImageList>modelImageLists;
    Context mContext;


    public ImageAdapter(List<ModelImageList> modelImageLists, Context mContext) {
    this.modelImageLists=modelImageLists;
        this.mContext=mContext;
    }


    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v= LayoutInflater.from(parent.getContext()).inflate(R.layout.image_list,parent,false);
        ViewHolder viewHolder=new ViewHolder(v);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, final int position) {
        ModelImageList model=new ModelImageList();
        model=modelImageLists.get(position);
         Picasso.with(mContext).load(model.getImage_path()).into(holder.img_thumbnail);
        holder.TVbtn_match.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(mContext, ShowUserDetailAct.class);
                i.putExtra("model", (Serializable) modelImageLists);
                i.putExtra("pos",position);
                mContext.startActivity(i);
            }
        });
        holder.ImagelistCV.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(mContext, ShowUserDetailAct.class);
                i.putExtra("model", (Serializable) modelImageLists);
                i.putExtra("pos",position);
                mContext.startActivity(i);
            }
        });


    }

    @Override
    public int getItemCount() {
        return modelImageLists.size();//model.size()
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        ImageView img_thumbnail;
        TextView TVbtn_match;
        CardView ImagelistCV;

        public ViewHolder(View v) {
            super(v);
            img_thumbnail = (ImageView) v.findViewById(R.id.img_thumbnail);
            TVbtn_match = (TextView) v.findViewById(R.id.TVbtn_Match);
            ImagelistCV = (CardView) v.findViewById(R.id.ImagelistCV);
        }
    }

}
