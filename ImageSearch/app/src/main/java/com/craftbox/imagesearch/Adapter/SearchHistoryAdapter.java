package com.craftbox.imagesearch.Adapter;

import android.content.Context;
import android.graphics.PorterDuff;
import android.support.v4.view.ViewPager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.craftbox.imagesearch.Model.ModelSearchHistory;
import com.craftbox.imagesearch.R;
import com.squareup.picasso.Picasso;

import java.util.List;

/**
 * Created by Craftbox-4 on 3/27/2017.
 */

public class SearchHistoryAdapter extends RecyclerView.Adapter<SearchHistoryAdapter.ViewHolder> {

    List<ModelSearchHistory>modelSearchHistories;
    Context mContext;

    public SearchHistoryAdapter(List<ModelSearchHistory> modelSearchHistories, Context mContext) {
        this.modelSearchHistories = modelSearchHistories;
        this.mContext = mContext;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater inflater=(LayoutInflater)mContext.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view=inflater.inflate(R.layout.search_history_list,parent,false);
        ViewHolder viewHolder=new ViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        ModelSearchHistory model=modelSearchHistories.get(position);
        holder.SearchHistoryNameTV.setText(model.getName());
        Picasso.with(mContext).load(model.getImage_path()).into(holder.SearchHistoryImg);

    }

    @Override
    public int getItemCount() {
        return modelSearchHistories.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
    ImageView SearchHistoryImg;
        TextView SearchHistoryNameTV;
        public ViewHolder(View v) {
        super(v);
            SearchHistoryImg=(ImageView)v.findViewById(R.id.SearchHistoryImg);
            SearchHistoryNameTV=(TextView) v.findViewById(R.id.SearchHistoryNameTV);

    }
}

}
