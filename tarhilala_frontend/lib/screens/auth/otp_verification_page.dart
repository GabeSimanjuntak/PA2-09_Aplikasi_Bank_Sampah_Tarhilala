import 'package:flutter/material.dart';
import '../../services/auth_service.dart';

class OtpVerificationPage extends StatefulWidget {
  @override
  _OtpVerificationPageState createState() => _OtpVerificationPageState();
}

class _OtpVerificationPageState extends State<OtpVerificationPage> {
  TextEditingController otpController = TextEditingController();
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
        backgroundColor: isError ? Colors.red.shade700 : Colors.green.shade700,
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

  void verifyOtp() async {
    if (otpController.text.isEmpty) {
      showCustomSnackBar("Masukkan kode OTP");
      return;
    }

    if (otpController.text.length < 4) {
      showCustomSnackBar("Kode OTP minimal 4 digit");
      return;
    }

    setState(() => loading = true);

    var response = await AuthService.verifyOtp(email, otpController.text);

    setState(() => loading = false);

    if (response['success'] == true) {
      showCustomSnackBar("OTP berhasil diverifikasi", isError: false);

      Future.delayed(Duration(milliseconds: 1500), () {
        Navigator.pushNamed(context, '/reset', arguments: email);
      });
    } else {
      String message = response['message'] ?? "Kode OTP salah";
      if (response['errors'] != null) {
        message = response['errors'].toString();
      }
      showCustomSnackBar(message);
    }
  }

  Widget inputField(controller, hint) {
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
        keyboardType: TextInputType.number,
        maxLength: 6,
        decoration: InputDecoration(
          hintText: hint,
          hintStyle: TextStyle(color: Colors.grey),
          border: InputBorder.none,
          contentPadding: EdgeInsets.symmetric(horizontal: 22, vertical: 18),
          prefixIcon: Icon(Icons.pin_outlined, color: Colors.grey.shade600),
          counterText: "",
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
            /// WAVE DIPERKECIL SUPAYA LOGO TURUN
            ClipPath(
              clipper: WaveClipper(),
              child: Container(
                height: 120,
                color: Color(0xFF1F4F8C),
              ),
            ),

            /// TURUNKAN LOGO LEBIH DEKAT KE TEKS
Transform.translate(
  offset: Offset(0, -50), // SAMA dengan Register
  child: Padding(
    padding: EdgeInsets.symmetric(horizontal: 25),
    child: Column(
      children: [

        // posisi logo disamakan PERSIS dengan Register
        Transform.translate(
          offset: Offset(0, 60), // SAMA dengan Register
          child: Image.asset(
            "assets/images/logo_tarhilala.png",
            width: 220, // SAMA dengan Register
          ),
        ),

        SizedBox(height: 6), // SAMA dengan Register

        Text(
          "OTP Verification",
          style: TextStyle(
            fontSize: 24,    // Sesuaikan agar sama dengan Register text
            fontWeight: FontWeight.bold,
          ),
        ),

        SizedBox(height: 4), // SAMA dengan Register

        Text(
          "Enter the OTP sent to",
          style: TextStyle(
            fontSize: 13,
            color: Colors.black54,
          ),
        ),

        SizedBox(height: 3),

        Text(
          email,
          style: TextStyle(
            fontSize: 14,
            color: Colors.black87,
            fontWeight: FontWeight.bold,
          ),
        ),

        SizedBox(height: 25),

                    inputField(otpController, "Enter OTP Code"),

                    SizedBox(height: 10),

                    loading
                        ? CircularProgressIndicator()
                        : SizedBox(
                            width: double.infinity,
                            height: 55,
                            child: ElevatedButton(
                              onPressed: verifyOtp,
                              style: ElevatedButton.styleFrom(
                                backgroundColor: Color(0xFF1F4F8C),
                                elevation: 6,
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(30),
                                ),
                              ),
                              child: Text(
                                "Verify OTP",
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
                        "Back to Forgot Password",
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

    path.lineTo(0, size.height - 30);

    path.quadraticBezierTo(
        size.width * 0.25, size.height - 60, size.width * 0.5, size.height - 30);

    path.quadraticBezierTo(
        size.width * 0.75, size.height, size.width, size.height - 30);

    path.lineTo(size.width, 0);
    path.close();
    return path;
  }

  @override
  bool shouldReclip(CustomClipper<Path> oldClipper) => false;
}