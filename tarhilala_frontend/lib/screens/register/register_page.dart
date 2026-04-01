import 'package:flutter/material.dart';
import '../../services/auth_service.dart';

class RegisterPage extends StatefulWidget {
  @override
  _RegisterPageState createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  TextEditingController nama = TextEditingController();
  TextEditingController email = TextEditingController();
  TextEditingController telepon = TextEditingController();
  TextEditingController password = TextEditingController();

  bool loading = false;

  void register() async {
    setState(() {
      loading = true;
    });

    var response = await AuthService.register(
      nama.text,
      email.text,
      telepon.text,
      password.text,
    );

    setState(() {
      loading = false;
    });

    print(response);

    // ✅ FIX DI SINI (pakai 'data')
    if (response['data'] != null) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text("Register berhasil, silakan login")),
      );

      Navigator.pushReplacementNamed(context, '/login');
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text(response['message'] ?? 'Register gagal')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("Register Nasabah")),
      body: Padding(
        padding: EdgeInsets.all(20),
        child: Column(
          children: [
            TextField(
              controller: nama,
              decoration: InputDecoration(labelText: "Nama"),
            ),
            TextField(
              controller: email,
              decoration: InputDecoration(labelText: "Email"),
            ),
            TextField(
              controller: telepon,
              decoration: InputDecoration(labelText: "Nomor Telepon"),
            ),
            TextField(
              controller: password,
              decoration: InputDecoration(labelText: "Password"),
              obscureText: true,
            ),
            SizedBox(height: 20),

            loading
                ? CircularProgressIndicator()
                : ElevatedButton(
                    onPressed: register,
                    child: Text("Register"),
                  ),
          ],
        ),
      ),
    );
  }
}