import 'package:flutter/material.dart';
import '../../services/auth_service.dart';

class UserDashboardPage extends StatelessWidget {
  void logout(BuildContext context) async {
    await AuthService.logout();
    Navigator.pushNamedAndRemoveUntil(
        context, '/login', (route) => false);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Dashboard User"),
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