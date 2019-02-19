package com.craftbox.imagesearch.NetUtils;

import android.util.Pair;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by FriendFill on 23-Jul-16.
 */
public class UserFunction {
    // URL of the PHP API

    //private static String service_url = "http://24.24.24.60/TMB/service/";
//    private static String service_url = "http://bulkbox.in/bustracking/service/";

    //TODO:LIVE SERVICE
    public static String service_url = "http://bulkbox.in/smartsearch/service/";


    //TODO:LOCALSERVICE
// public static String service_url = "http://24.24.24.215/imagematcher/service/";

    private String secure_field = "key";
    private String secure_value = "1226";

    // constructor
    public UserFunction() {
    }

//    bulkbox.in/imagematcher/service/service_user.php?key=1226&s=44&match_id=2&inserted_id=3
    public JSONObject MatchImage(String match_id,String inserted_id){
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "44"));
        params.add(new Pair<>("match_id", match_id));
        params.add(new Pair<>("inserted_id", inserted_id));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }

    public JSONObject UserLogin(String email, String password, String imei, String refreshedToken) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "27"));
        params.add(new Pair<>("email", email));
        params.add(new Pair<>("password", password));
        params.add(new Pair<>("imei", imei));
        params.add(new Pair<>("refresh_token", refreshedToken));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }

    public JSONObject UserSignup(String name, String email, String password, String mobile, String imei, String refreshedToken) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "26"));
        params.add(new Pair<>("name", name));
        params.add(new Pair<>("email", email));
        params.add(new Pair<>("password", password));
        params.add(new Pair<>("phone", mobile));
        params.add(new Pair<>("imei", imei));
        params.add(new Pair<>("refresh_token", refreshedToken));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }


    public JSONObject UserUpdate(String id, String name, String email, String address, String locality, String city, String state,
                                 String pin_code, String phone, String country_slug) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "28"));
        params.add(new Pair<>("uid", id));
        params.add(new Pair<>("name", name));
        params.add(new Pair<>("email", email));
        params.add(new Pair<>("address", address));
        params.add(new Pair<>("locality", locality));
        params.add(new Pair<>("city", city));
        params.add(new Pair<>("state", state));
        params.add(new Pair<>("pincode", pin_code));
        params.add(new Pair<>("phone", phone));
        params.add(new Pair<>("country", country_slug));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }

    public JSONObject GetImageList() {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "41"));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    } public JSONObject SearchHistory(String id) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "45"));
        params.add(new Pair<>("uid", id));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }

    public JSONObject GetDepartmentList() {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "42"));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }


    public JSONObject GetBusList(String uid, String ul, String ll) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "29"));
        params.add(new Pair<>("uid", uid));
        params.add(new Pair<>("ul", ul));
        params.add(new Pair<>("ll", ll));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_bus.php", "POST", params);
        return json;
    }

    public JSONObject GetBusStop(String uid, String ul, String ll) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "30"));
        params.add(new Pair<>("uid", uid));
        params.add(new Pair<>("ul", ul));
        params.add(new Pair<>("ll", ll));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_busstop.php", "POST", params);
        return json;
    }

    public JSONObject GetBusList_By_bustop(String bsid, String ul, String ll) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "31"));
        params.add(new Pair<>("bsid", bsid));
        params.add(new Pair<>("ul", ul));
        params.add(new Pair<>("ll", ll));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_busstop.php", "POST", params);
        return json;
    }

    public JSONObject GetBusLocation(String bid) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "35"));
        params.add(new Pair<>("bid", "" + bid));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_bus.php", "POST", params);
        return json;
    }

    public JSONObject findAccount(String email) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "35"));
        params.add(new Pair<>("email", email));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }

    public JSONObject checkSecurity(String email, String code) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "36"));
        params.add(new Pair<>("email", email));
        params.add(new Pair<>("otp", code));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }

    public JSONObject changeForgetPassword(String email, String newPassword) {
        JSONParser jsonParser = new JSONParser();
        List<Pair<String, String>> params = new ArrayList<>();
        params.add(new Pair<>(secure_field, secure_value));
        params.add(new Pair<>("s", "37"));
        params.add(new Pair<>("email", email));
        params.add(new Pair<>("new_password", newPassword));
        JSONObject json = jsonParser.makeHttpRequest(service_url + "service_user.php", "POST", params);
        return json;
    }
}
