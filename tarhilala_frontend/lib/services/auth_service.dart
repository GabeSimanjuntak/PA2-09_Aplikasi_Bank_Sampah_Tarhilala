import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class AuthService {
  static const String baseUrl = "http://10.0.2.2:8000/api";

  static Future loginAdmin(String email, String password) async {
    var url = Uri.parse("$baseUrl/admin/login");

    var response = await http.post(url, body: {
      "email": email,
      "password": password,
    });

    print("ADMIN LOGIN RESPONSE: ${response.body}");

    var data = jsonDecode(response.body);

    if (response.statusCode == 200) {
      SharedPreferences prefs = await SharedPreferences.getInstance();

      if (data['token'] != null) {
        await prefs.setString('token', data['token']);
      }

      await prefs.setString('role', 'admin');
    }

    return data;
  }

  static Future loginUser(String email, String password) async {
    var url = Uri.parse("$baseUrl/user/login");

    var response = await http.post(url, body: {
      "email": email,
      "password": password,
    });

    print("USER LOGIN RESPONSE: ${response.body}");

    var data = jsonDecode(response.body);

    if (response.statusCode == 200) {
      SharedPreferences prefs = await SharedPreferences.getInstance();
      await prefs.setString('token', data['token']);
      await prefs.setString('role', 'nasabah');
    }

    return data;
  }

  static Future register(
      String nama,
      String email,
      String telepon,
      String password) async {

    var url = Uri.parse("$baseUrl/user/register");

    var response = await http.post(url, body: {
      "nama": nama,
      "email": email,
      "nomor_telepon": telepon,
      "password": password,
    });

    print("REGISTER RESPONSE: ${response.body}");

    return jsonDecode(response.body);
  }

  static Future<String?> getToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('token');
  }

  static Future<String?> getRole() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('role');
  }

  static Future logout() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.clear();
  }

  static Future authorizedGet(String endpoint) async {
    String? token = await getToken();

    var url = Uri.parse("$baseUrl$endpoint");

    var response = await http.get(
      url,
      headers: {
        "Authorization": "Bearer $token",
        "Accept": "application/json"
      },
    );

    print("GET $endpoint: ${response.body}");

    return jsonDecode(response.body);
  }

  static Future<bool> isLoggedIn() async {
    String? token = await getToken();
    return token != null;
  }
}