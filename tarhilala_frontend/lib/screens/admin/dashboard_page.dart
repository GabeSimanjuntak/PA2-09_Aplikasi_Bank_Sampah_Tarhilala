import 'package:flutter/material.dart';
import '../../services/auth_service.dart';

class AdminDashboardPage extends StatelessWidget {
  void logout(BuildContext context) async {
    await AuthService.logout();
    Navigator.pushNamedAndRemoveUntil(
        context, '/login', (route) => false);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Dashboard Admin"),
        automaticallyImplyLeading: false,
      ),
      body: Center(
        child: ElevatedButton(
          onPressed: () => logout(context),
          child: Text("Logout"),
        ),
      ),
    );
  }
}