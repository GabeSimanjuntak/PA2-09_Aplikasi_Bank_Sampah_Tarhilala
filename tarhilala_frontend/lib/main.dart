import 'package:flutter/material.dart';

import 'screens/splash/splash_screen.dart';
import 'screens/login/login_page.dart';
import 'screens/register/register_page.dart';
import 'screens/admin/dashboard_page.dart';
import 'screens/user/dashboard_page.dart';
import 'screens/auth/forgot_password_page.dart';
import 'screens/auth/otp_verification_page.dart';
import 'screens/auth/reset_password_page.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,

      routes: {
        '/login': (context) => LoginPage(),
        '/register': (context) => RegisterPage(),
        '/admin': (context) => AdminDashboardPage(),
        '/user': (context) => UserDashboardPage(),
        '/forgot': (context) => ForgotPasswordPage(),
        '/otp': (context) => OtpVerificationPage(),
        '/reset': (context) => ResetPasswordPage(),

      },

      home: const SplashScreen(),
    );
  }
}