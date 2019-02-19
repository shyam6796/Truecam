package com.craftbox.imagesearch.Adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.craftbox.imagesearch.Model.GeneralModel;
import com.craftbox.imagesearch.R;

import java.util.ArrayList;

import butterknife.BindView;
import butterknife.ButterKnife;

/**
 * Created by CRAFT BOX on 10/25/2016.
 */

public class CountryAdapter extends BaseAdapter {

    private Context activity;
    private ArrayList<GeneralModel> data = null;
    private LayoutInflater inflater1 = null;
    String string = null;
    public CountryAdapter(Context act,ArrayList<GeneralModel> da)
    {
        activity = act;
        data = da;
    }

    @Override
    public int getCount() {
        return data.size();
    }

    @Override
    public Object getItem(int position) {
        return position;
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View view, ViewGroup parent) {
        ViewHolder holder;
        if (view != null) {
            holder = (ViewHolder) view.getTag();
        }
        else
        {
            inflater1 = (LayoutInflater)parent.getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = inflater1.inflate(R.layout.single_item_country,null);
            holder = new ViewHolder(view);
            view.setTag(holder);
        }
        holder.name.setText(""+data.get(position).getName());
        return view;
    }

    static class ViewHolder {
        @BindView(R.id.single_item_country_name_txt) TextView name;

        public ViewHolder(View view) {
            ButterKnife.bind(this, view);
        }
    }
}
