package com.craftbox.imagesearch;

import android.Manifest;
import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Build;
import android.provider.MediaStore;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageView;
import android.widget.TextView;

import com.craftbox.imagesearch.Custom.CustomDrawableTextview;
import com.craftbox.imagesearch.Custom.GPSTracker;
import com.craftbox.imagesearch.Custom.ImageInputHelper;
import com.craftbox.imagesearch.Custom.Toaster;
import com.craftbox.imagesearch.NetUtils.GlobalElements;
import com.craftbox.imagesearch.NetUtils.RuntimePermissionsActivity;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.IOException;

import butterknife.BindView;
import butterknife.ButterKnife;

public class DashBoardActivity extends RuntimePermissionsActivity implements ImageInputHelper.ImageActionListener {

    private static final int CAMERA_REQUEST = 1888;
    private static int RESULT_LOAD_IMAGE = 1;
    private static boolean f_search=false;
    private static boolean f_add=false;
    private ImageInputHelper imageInputHelper;
    String selectedImagePath;

//    @BindView(R.id.custom_actionbar_back)
//    ImageView back_img;
    @BindView(R.id.custom_actionbar_profile)
    ImageView profile_txt;
    @BindView(R.id.custom_actionbar_title)
    TextView title_txt;

    @BindView(R.id.dashboard_add_image_txt)
    CustomDrawableTextview add_image_txt;
    @BindView(R.id.dashboard_search_image_txt)
    CustomDrawableTextview search_image_txt;

    GPSTracker gps;
    ImageView History_Img;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dash_board);
        ButterKnife.bind(this);
        DashBoardActivity.super.requestAppPermissions(new
                        String[]{android.Manifest.permission.READ_PHONE_STATE, Manifest.permission.CAMERA,android.Manifest.permission.WRITE_EXTERNAL_STORAGE}, R.string.runtime_permissions_txt
                , 20);
        History_Img=(ImageView)findViewById(R.id.custom_actionbar_history);
        imageInputHelper = new ImageInputHelper(this);
        imageInputHelper.setImageActionListener(this);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
            Window window = getWindow();
            window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS);
            window.setStatusBarColor(ContextCompat.getColor(DashBoardActivity.this,R.color.Colorstatusbar));
        }

        f_add=false;
        f_search=false;
//        back_img.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                finish();
//            }
//        });
        profile_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(DashBoardActivity.this,ProfileActivity.class);
                startActivity(i);
            }
        });
        add_image_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                f_add=true;
                f_search=false;
            showCam();
            }
        });
        search_image_txt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                f_search=true;
                f_add=false;
                showCam();

            }
        });
        History_Img.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i=new Intent(DashBoardActivity.this,SearchHistoryActivity.class);
                startActivity(i);
            }
        });

    }

    @Override
    public void onPermissionsGranted(int requestCode) {

    }

    private void showCam() {
        LayoutInflater inflater =
                (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View menuLayout = inflater.inflate(R.layout.add_pic, null);
        final AlertDialog.Builder dg = new AlertDialog.Builder(DashBoardActivity.this);
        dg.setView(menuLayout);
        final AlertDialog dialog=dg.create();
        TextView tvtakepic = (TextView) menuLayout.findViewById(R.id.tvTakephoto);

        TextView tvGallary = (TextView) menuLayout.findViewById(R.id.tvFromGallary);


        tvtakepic.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                dialog.dismiss();
                imageInputHelper.takePhotoWithCamera();
//

            }
        });
        tvGallary.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                dialog.dismiss();
                imageInputHelper.selectImageFromGallery();
//
            }
        });
        dialog.show();

    }
    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        imageInputHelper.onActivityResult(requestCode, resultCode, data);

    }

    @Override
    public void onImageSelectedFromGallery(Uri uri, File imageFile) {
        imageInputHelper.requestCropImage(uri,1000,1000,  1, 1);
    }

    @Override
    public void onImageTakenFromCamera(Uri uri, File imageFile) {
        selectedImagePath =""+uri;
        if (f_add==true) {
            if (selectedImagePath != null) {
                GlobalElements.finalFile=imageFile;
                Intent i = new Intent(DashBoardActivity.this, UpdateDetailActivity.class);
                i.putExtra("img", selectedImagePath);
                startActivity(i);
            } else  {
                Toaster.show(DashBoardActivity.this, "Image Not Found", false, Toaster.DANGER);
            }
        }
        else  if(f_search==true) {
            if (selectedImagePath != null) {
                GlobalElements.finalFile=imageFile;
                Intent i = new Intent(DashBoardActivity.this, ImageListActivity.class);
                i.putExtra("img", selectedImagePath);
                startActivity(i);
            } else  {
                Toaster.show(DashBoardActivity.this, "Image Not Found", false, Toaster.DANGER);
            }
        }
    }

    @Override
    public void onImageCropped(Uri uri, File imageFile) {
        try {
           selectedImagePath =""+uri;
            if (f_add==true) {
                if (selectedImagePath != null) {
                    GlobalElements.finalFile=imageFile;
                    Intent i = new Intent(DashBoardActivity.this, UpdateDetailActivity.class);
                    i.putExtra("img", selectedImagePath);
                    startActivity(i);
                } else  {
                    Toaster.show(DashBoardActivity.this, "Image Not Found", false, Toaster.DANGER);
                }
            }
            else  if(f_search==true) {
                if (selectedImagePath != null) {
                    GlobalElements.finalFile=imageFile;
                    Intent i = new Intent(DashBoardActivity.this, ImageListActivity.class);
                    i.putExtra("img", selectedImagePath);
                    startActivity(i);
                } else  {
                    Toaster.show(DashBoardActivity.this, "Image Not Found", false, Toaster.DANGER);
                }
            }
            Bitmap bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), uri);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
//    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
//        if (f_add==true) {
//            if (requestCode == CAMERA_REQUEST && resultCode == Activity.RESULT_OK) {
//                Bitmap photo = (Bitmap) data.getExtras().get("data");
//                String tempUri = getImageUri(getApplicationContext(), photo);
//
//                // CALL THIS METHOD TO GET THE ACTUAL PATH
//
//                Intent i=new Intent(DashBoardActivity.this,UpdateDetailActivity.class);
//                i.putExtra("img",tempUri);
//                startActivity(i);
//    //            imgPicture.setImageBitmap(photo);
//
//
//            }
//            if (requestCode == RESULT_LOAD_IMAGE && resultCode == RESULT_OK && null != data) {
//                Bitmap bm = null;
//                if (data != null) {
//                    try {
//                        bm = MediaStore.Images.Media.getBitmap(getApplicationContext().getContentResolver(), data.getData());
//                        String tempUri = getImageUri(getApplicationContext(), bm);
//                        Intent i=new Intent(DashBoardActivity.this,UpdateDetailActivity.class);
//                        i.putExtra("img",tempUri);
//                        startActivity(i);
//                    } catch (IOException e) {
//                        e.printStackTrace();
//                    }
//                }
//    //            imgPicture.setImageBitmap(bm);
//
//            }
//        } else if(f_search==true) {
//            if (requestCode == CAMERA_REQUEST && resultCode == Activity.RESULT_OK) {
//                Bitmap photo = (Bitmap) data.getExtras().get("data");
//                //            imgPicture.setImageBitmap(photo);
//                String tempUri = getImageUri(getApplicationContext(), photo);
//                Intent i=new Intent(DashBoardActivity.this,ImageListActivity.class);
//
//                i.putExtra("img",tempUri);
//                startActivity(i);
//
//
//            }
//            if (requestCode == RESULT_LOAD_IMAGE && resultCode == RESULT_OK && null != data) {
//                Bitmap bm = null;
//                if (data != null) {
//                    try {
//                        bm = MediaStore.Images.Media.getBitmap(getApplicationContext().getContentResolver(), data.getData());
//                        String tempUri = getImageUri(getApplicationContext(), bm);
//                        Intent i=new Intent(DashBoardActivity.this,ImageListActivity.class);
//                        i.putExtra("img",tempUri);
//                        startActivity(i);
//                    } catch (IOException e) {
//                        e.printStackTrace();
//                    }
//                }
//                //            imgPicture.setImageBitmap(bm);
//
//            }
//
//        }
//        else{
//
//        }
//
//
//    }
//    public String getImageUri(Context inContext, Bitmap inImage) {
//        ByteArrayOutputStream bytes = new ByteArrayOutputStream();
//        inImage.compress(Bitmap.CompressFormat.JPEG, 100, bytes);
//        String path = MediaStore.Images.Media.insertImage(inContext.getContentResolver(), inImage, "Title", null);
////        byte [] b=bytes.toByteArray();
////        String temp= Base64.encodeToString(b, Base64.DEFAULT);
//        return path;
//    }



}
