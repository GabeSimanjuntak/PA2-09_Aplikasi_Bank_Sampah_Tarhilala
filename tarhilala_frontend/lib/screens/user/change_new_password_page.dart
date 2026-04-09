import 'package:flutter/material.dart';
import '../../../services/auth_service.dart';

class ChangeNewPasswordPage extends StatefulWidget {
  final String email;
  const ChangeNewPasswordPage({super.key, required this.email});

  @override
  State<ChangeNewPasswordPage> createState() => _ChangeNewPasswordPageState();
}

class _ChangeNewPasswordPageState extends State<ChangeNewPasswordPage> {
  final passwordController = TextEditingController();
  final confirmController = TextEditingController();

  bool isLoading = false;
  bool isPasswordVisible = false;
  bool isConfirmVisible = false;

  void showCustomSnackBar(String message, {bool isError = false}) {
    ScaffoldMessenger.of(context).clearSnackBars();
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        behavior: SnackBarBehavior.floating,
        backgroundColor: isError ? Colors.red.shade700 : Colors.green.shade700,
        margin: const EdgeInsets.all(16),
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        duration: const Duration(seconds: 3),
        elevation: 6,
        content: Row(
          children: [
            Icon(
              isError ? Icons.error_outline : Icons.check_circle_outline,
              color: Colors.white,
              size: 20,
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Text(
                message,
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 14,
                  fontWeight: FontWeight.w500,
                ),
              ),
            )
          ],
        ),
      ),
    );
  }

  void resetPassword() async {
    if (passwordController.text.isEmpty || confirmController.text.isEmpty) {
      showCustomSnackBar("Password tidak boleh kosong", isError: true);
      return;
    }

    if (passwordController.text != confirmController.text) {
      showCustomSnackBar("Password tidak sama", isError: true);
      return;
    }

    if (passwordController.text.length < 6) {
      showCustomSnackBar("Password minimal 6 karakter", isError: true);
      return;
    }

    setState(() => isLoading = true);

    var res = await AuthService.resetPassword(
      widget.email,
      passwordController.text,
    );

    setState(() => isLoading = false);

    if (res["success"]) {
      showCustomSnackBar("Password berhasil diubah");

      Future.delayed(const Duration(seconds: 2), () {
        Navigator.popUntil(context, (route) => route.isFirst);
      });
    } else {
      showCustomSnackBar(res["message"], isError: true);
    }
  }

  Widget passwordField(String hint, TextEditingController controller,
      {bool isVisible = false, VoidCallback? onToggle}) {
    return TextField(
      controller: controller,
      obscureText: !isVisible,
      style: const TextStyle(fontSize: 15),
      decoration: InputDecoration(
        hintText: hint,
        hintStyle: TextStyle(color: Colors.grey.shade400),
        filled: true,
        fillColor: Colors.white,
        contentPadding:
            const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(30),
          borderSide: BorderSide.none,
        ),
        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(30),
          borderSide: BorderSide(color: Colors.grey.shade300),
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(30),
          borderSide: BorderSide(color: Colors.blue.shade800, width: 1.5),
        ),
        suffixIcon: onToggle != null
            ? IconButton(
                icon: Icon(
                  isVisible ? Icons.visibility_off : Icons.visibility,
                  color: Colors.grey.shade600,
                  size: 20,
                ),
                onPressed: onToggle,
              )
            : null,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey.shade200,
      body: Column(
        children: [
          // ================= HEADER =================
          Container(
            width: double.infinity,
            padding: const EdgeInsets.only(top: 60, bottom: 40),
            decoration: BoxDecoration(
              color: Colors.blue.shade800,
              borderRadius: const BorderRadius.vertical(
                bottom: Radius.circular(40),
              ),
            ),
            child: Column(
              children: [
                Stack(
                  clipBehavior: Clip.none,
                  alignment: Alignment.center,
                  children: [
                    Container(
                      width: 350,
                      height: 70,
                      decoration: BoxDecoration(
                        color: Colors.white,
                        borderRadius: BorderRadius.circular(20),
                        boxShadow: [
                          BoxShadow(
                            color: Colors.black.withOpacity(0.15),
                            blurRadius: 6,
                            offset: const Offset(0, 3),
                          )
                        ],
                      ),
                    ),
                    Positioned(
                      top: -20,
                      child: Image.asset(
                        "assets/images/logo_tarhilala.png",
                        height: 130,
                        fit: BoxFit.contain,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),

          const SizedBox(height: 25),

          // ================= BACK BUTTON =================
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 20),
            child: GestureDetector(
              onTap: () {
                Navigator.pop(context);
              },
              child: Container(
                padding: const EdgeInsets.all(15),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(15),
                ),
                child: const Row(
                  children: [
                    Icon(Icons.arrow_back),
                    SizedBox(width: 10),
                    Text(
                      "Password Baru",
                      style: TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.w500,
                      ),
                    )
                  ],
                ),
              ),
            ),
          ),

          const SizedBox(height: 50),

          // ================= FORM =================
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 30),
            child: Column(
              children: [
                const Text(
                  "Masukkan Password Baru",
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.w500,
                    color: Colors.black87,
                  ),
                ),

                const SizedBox(height: 20),

                passwordField(
                  "Password Baru",
                  passwordController,
                  isVisible: isPasswordVisible,
                  onToggle: () {
                    setState(() {
                      isPasswordVisible = !isPasswordVisible;
                    });
                  },
                ),

                const SizedBox(height: 15),

                passwordField(
                  "Konfirmasi Password",
                  confirmController,
                  isVisible: isConfirmVisible,
                  onToggle: () {
                    setState(() {
                      isConfirmVisible = !isConfirmVisible;
                    });
                  },
                ),

                const SizedBox(height: 10),

                // Password requirement hint
                Align(
                  alignment: Alignment.centerLeft,
                  child: Text(
                    "• Password minimal 6 karakter",
                    style: TextStyle(
                      fontSize: 12,
                      color: Colors.grey.shade500,
                    ),
                  ),
                ),

                const SizedBox(height: 35),

                SizedBox(
                  width: double.infinity,
                  height: 50,
                  child: ElevatedButton(
                    onPressed: isLoading ? null : resetPassword,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.blue.shade800,
                      foregroundColor: Colors.white,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30),
                      ),
                      elevation: 4,
                      disabledBackgroundColor: Colors.blue.shade300,
                    ),
                    child: isLoading
                        ? const CircularProgressIndicator(
                            color: Colors.white,
                            strokeWidth: 2.5,
                          )
                        : const Text(
                            "Simpan",
                            style: TextStyle(
                              fontSize: 16,
                              fontWeight: FontWeight.w600,
                              color: Colors.white,
                            ),
                          ),
                  ),
                )
              ],
            ),
          )
        ],
      ),
    );
  }
}