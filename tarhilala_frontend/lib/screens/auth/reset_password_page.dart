import 'package:flutter/material.dart';
import '../../services/auth_service.dart';

class ResetPasswordPage extends StatefulWidget {
  @override
  _ResetPasswordPageState createState() => _ResetPasswordPageState();
}

class _ResetPasswordPageState extends State<ResetPasswordPage> {
  TextEditingController pass1 = TextEditingController();
  TextEditingController pass2 = TextEditingController();

  bool loading = false;
  late String email;

  @override
  void didChangeDependencies() {
    super.didChangeDependencies();
    email = ModalRoute.of(context)!.settings.arguments as String;
  }

  void showCustomSnackBar(String message, {bool isError = true}) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Row(
          children: [
            Icon(
              isError ? Icons.error_outline : Icons.check_circle_outline,
              color: Colors.white,
              size: 24,
            ),
            SizedBox(width: 12),
            Expanded(
              child: Text(
                message,
                style: TextStyle(fontSize: 14, fontWeight: FontWeight.w500),
              ),
            ),
          ],
        ),
        backgroundColor:
            isError ? Colors.red.shade700 : Colors.green.shade700,
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        elevation: 6,
        duration: Duration(seconds: 3),
        margin: EdgeInsets.all(16),
        padding: EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      ),
    );
  }

  void resetPassword() async {
    if (pass1.text.isEmpty || pass2.text.isEmpty) {
      showCustomSnackBar("Password wajib diisi");
      return;
    }

    if (pass1.text.length < 6) {
      showCustomSnackBar("Password minimal 6 karakter");
      return;
    }

    if (pass1.text != pass2.text) {
      showCustomSnackBar("Password tidak sama");
      return;
    }

    setState(() => loading = true);

    var response = await AuthService.resetPassword(email, pass1.text);

    setState(() => loading = false);

    if (response['success'] == true) {
      showCustomSnackBar("Password berhasil direset", isError: false);

      Future.delayed(Duration(milliseconds: 1500), () {
        Navigator.pushNamedAndRemoveUntil(context, '/login', (route) => false);
      });
    } else {
      String message = response['message'] ?? "Gagal reset password";
      if (response['errors'] != null) {
        message = response['errors'].toString();
      }
      showCustomSnackBar(message);
    }
  }

  // 👇 Sudah tanpa suffixIcon (tanpa logo mata)
  Widget inputField(controller, hint, {bool obscure = false}) {
    return Container(
      margin: EdgeInsets.only(bottom: 18),
      decoration: BoxDecoration(
        color: Color(0xFFEDEDED),
        borderRadius: BorderRadius.circular(30),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.06),
            blurRadius: 10,
            offset: Offset(0, 5),
          ),
        ],
      ),
      child: TextField(
        controller: controller,
        obscureText: obscure,
        decoration: InputDecoration(
          hintText: hint,
          hintStyle: TextStyle(color: Colors.grey),
          border: InputBorder.none,
          contentPadding: EdgeInsets.symmetric(horizontal: 22, vertical: 18),
          prefixIcon: Icon(
            Icons.lock_outline,
            color: Colors.grey.shade600,
          ),
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xFFBFC9D6),

      body: SingleChildScrollView(
        child: Column(
          children: [
            ClipPath(
              clipper: WaveClipper(),
              child: Container(
                height: 210,
                color: Color(0xFF1F4F8C),
              ),
            ),

            Transform.translate(
              offset: Offset(0, -50),
              child: Padding(
                padding: EdgeInsets.symmetric(horizontal: 25),
                child: Column(
                  children: [
                    Transform.translate(
                      offset: Offset(0, 60),
                      child: Image.asset(
                        "assets/images/logo_tarhilala.png",
                        width: 220,
                      ),
                    ),

                    SizedBox(height: 6),

                    Text(
                      "Reset Password",
                      style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                      ),
                    ),

                    SizedBox(height: 4),

                    Text(
                      "Create your new password",
                      style: TextStyle(
                        fontSize: 13,
                        color: Colors.black54,
                      ),
                    ),

                    SizedBox(height: 8),

                    Container(
                      padding:
                          EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                      decoration: BoxDecoration(
                        color: Color(0xFF1F4F8C).withOpacity(0.1),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        email,
                        style: TextStyle(
                          color: Color(0xFF1F4F8C),
                          fontSize: 12,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                    ),

                    SizedBox(height: 25),

                    inputField(pass1, "New Password", obscure: true),
                    inputField(pass2, "Confirm New Password", obscure: true),

                    SizedBox(height: 10),

                    loading
                        ? CircularProgressIndicator()
                        : SizedBox(
                            width: double.infinity,
                            height: 55,
                            child: ElevatedButton(
                              onPressed: resetPassword,
                              style: ElevatedButton.styleFrom(
                                backgroundColor: Color(0xFF1F4F8C),
                                elevation: 6,
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(30),
                                ),
                              ),
                              child: Text(
                                "Reset Password",
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  color: Colors.white,
                                  fontSize: 16,
                                ),
                              ),
                            ),
                          ),

                    SizedBox(height: 10),

                    TextButton(
                      onPressed: () => Navigator.pop(context),
                      child: Text(
                        "Back to OTP Verification",
                        style: TextStyle(
                          color: Colors.blue,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}

class WaveClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    Path path = Path();

    path.lineTo(0, size.height - 60);

    path.quadraticBezierTo(
      size.width * 0.2,
      size.height - 120,
      size.width * 0.4,
      size.height - 60,
    );

    path.quadraticBezierTo(
      size.width * 0.6,
      size.height - 180,
      size.width * 0.75,
      size.height - 70,
    );

    path.quadraticBezierTo(
      size.width * 0.9,
      size.height - 130,
      size.width,
      size.height - 60,
    );

    path.lineTo(size.width, 0);
    path.close();

    return path;
  }

  @override
  bool shouldReclip(CustomClipper<Path> oldClipper) => false;
}